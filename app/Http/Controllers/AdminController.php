<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Service;
use App\Models\HomeContent;
use App\Models\User;
use App\Models\Appointment;
use App\Models\BlockedTime;

class AdminController extends Controller
{
    // Status Constants
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_PROCESSED = 4;
    
    // Constructor removed - middleware is handled in routes
    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        // Optimize with single queries and caching
        $stats = [
            'unread_contacts' => Contact::where('status', 'unread')->count(),
            'total_contacts' => Contact::count(),
            'recent_contacts' => Contact::where('created_at', '>=', now()->subDays(7))->count(),
            'total_blogs' => Blog::count(),
            'total_services' => Service::count(),
            'active_sliders' => 0, // Slider removed
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
            'upcoming_appointments' => Appointment::where('appointment_date', '>', now())->count(),
            'active_blocked_times' => BlockedTime::where('blocked_date', '>=', today())->where('is_active', true)->count(),
            'total_blocked_times' => BlockedTime::count(),
        ];

        // Optimize recent contacts query
        $recent_contacts = Contact::select('id', 'name', 'contact_email', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }

    /**
     * Show all contacts
     */
    public function contacts(Request $request)
    {
        $query = Contact::select('id', 'name', 'contact_email', 'subject', 'status', 'created_at');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show a specific contact
     */
    public function showContact(Contact $contact)
    {
        // Mark as read when viewed
        if ($contact->status === 'unread') {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Update contact status
     */
    public function updateContactStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:unread,read,resolved,archived'
        ]);

        $contact->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Contact status updated successfully.');
    }

    /**
     * Bulk update contact statuses
     */
    public function bulkUpdateContactStatus(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required|array|min:1',
            'contact_ids.*' => 'exists:contacts,id',
            'status' => 'required|in:unread,read,resolved,archived'
        ]);

        $updatedCount = Contact::whereIn('id', $request->contact_ids)
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', "Updated {$updatedCount} contact(s) successfully.");
    }

    /**
     * Forward contact information via email
     */
    public function forwardContact(Request $request, Contact $contact)
    {
        $request->validate([
            'recipient_email' => 'required|email|max:255',
            'message' => 'nullable|string|max:1000'
        ]);

        try {
            // Forward the contact information
            $contact->forwardTo($request->recipient_email);
            
            // Send email with contact details
            Mail::to($request->recipient_email)->send(new \App\Mail\ContactForwardMail($contact, $request->recipient_email));

            return redirect()->back()->with('success', "Contact information forwarded to {$request->recipient_email} successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to forward contact. Please try again.');
        }
    }

    /**
     * Bulk forward contacts
     */
    public function bulkForwardContacts(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required|array|min:1',
            'contact_ids.*' => 'exists:contacts,id',
            'recipient_email' => 'required|email|max:255'
        ]);

        $contacts = Contact::whereIn('id', $request->contact_ids)->get();
        $forwardedCount = 0;

        try {
            foreach ($contacts as $contact) {
                $contact->forwardTo($request->recipient_email);
                Mail::to($request->recipient_email)->send(new \App\Mail\ContactForwardMail($contact, $request->recipient_email));
                $forwardedCount++;
            }

            return redirect()->back()->with('success', "Forwarded {$forwardedCount} contact(s) to {$request->recipient_email} successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to forward contacts. Please try again.');
        }
    }

    /**
     * Archive contact
     */
    public function archiveContact(Contact $contact)
    {
        $contact->markAsArchived();
        return redirect()->back()->with('success', 'Contact archived successfully.');
    }

    /**
     * Unarchive contact
     */
    public function unarchiveContact(Contact $contact)
    {
        $contact->markAsUnarchived();
        return redirect()->back()->with('success', 'Contact unarchived successfully.');
    }

    /**
     * Bulk archive contacts
     */
    public function bulkArchiveContacts(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required|array|min:1',
            'contact_ids.*' => 'exists:contacts,id'
        ]);

        $archivedCount = Contact::whereIn('id', $request->contact_ids)
            ->update(['status' => 'archived']);

        return redirect()->back()->with('success', "Archived {$archivedCount} contact(s) successfully.");
    }

    /**
     * Bulk unarchive contacts
     */
    public function bulkUnarchiveContacts(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required|array|min:1',
            'contact_ids.*' => 'exists:contacts,id'
        ]);

        $unarchivedCount = Contact::whereIn('id', $request->contact_ids)
            ->update(['status' => 'read']);

        return redirect()->back()->with('success', "Unarchived {$unarchivedCount} contact(s) successfully.");
    }


    /**
     * Content management dashboard
     */
    public function content()
    {
        $content_stats = [
            'blogs' => Blog::count(),
            'services' => Service::count(),
            'sliders' => 0, // Slider removed
            'pages' => \App\Models\Page::count(),
        ];

        return view('admin.content.index', compact('content_stats'));
    }

    /**
     * Settings management
     */
    public function settings()
    {
        $settings = HomeContent::all()->pluck('meta_value', 'meta_key');
        
        // Define default settings with organized structure
        $defaultSettings = [
            // SEO Settings
            'meta_title' => 'Bansal Immigration Consultants - Your Future, Our Priority',
            'meta_description' => 'Expert Australian immigration consultants providing visa services, migration advice, and pathway guidance for students, skilled workers, and families.',
            'meta_keywords' => 'immigration, visa, Australia, consultant, migration, student visa, skilled visa',
            'og_title' => 'Bansal Immigration Consultants',
            'og_description' => 'Professional immigration services for Australia',
            'og_image' => '',
            
            // Website Settings
            'site_name' => 'Bansal Immigration Consultants',
            'site_tagline' => 'Your Future, Our Priority',
            'contact_email' => 'info@bansalimmigration.com',
            'contact_phone' => '+61 123 456 789',
            'contact_address' => '123 Main Street, Sydney NSW 2000, Australia',
            'office_hours' => 'Monday - Friday: 9:00 AM - 6:00 PM',
            
            // Social Media
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'youtube_url' => '',
            
            // Homepage Settings
            'sliderstatus' => '1',
            'meet_link' => '/contact',
            'hero_title' => 'Your Future, Our Priority',
            'hero_subtitle' => 'Professional Immigration Services for Australia',
            
            // Contact & Communication
            'contact_form_email' => 'info@bansalimmigration.com',
            'appointment_email' => 'appointments@bansalimmigration.com',
            'support_email' => 'support@bansalimmigration.com',
            
            // Security & Features
            'recaptcha_enabled' => '1',
            'maintenance_mode' => '0',
            'analytics_code' => '',
            'google_tag_manager' => '',
            
            // Business Information
            'business_registration' => '',
            'mara_number' => '',
            'abn_number' => '',
            'business_description' => 'Professional immigration consultancy services',
            
            // Footer Settings
            'footer_copyright' => '© ' . date('Y') . ' Bansal Immigration Consultants. All rights reserved.',
            'footer_description' => 'Your trusted partner for Australian immigration services.',
        ];
        
        // Merge with existing settings
        $allSettings = array_merge($defaultSettings, $settings->toArray());
        
        return view('admin.settings', compact('allSettings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $validatedData = $request->validate([
            // SEO Settings
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            
            // Website Settings
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'office_hours' => 'nullable|string|max:255',
            
            // Social Media
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            
            // Homepage Settings
            'sliderstatus' => 'required|in:0,1',
            'meet_link' => 'required|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            
            // Contact & Communication
            'contact_form_email' => 'required|email|max:255',
            'appointment_email' => 'required|email|max:255',
            'support_email' => 'required|email|max:255',
            
            // Security & Features
            'recaptcha_enabled' => 'required|in:0,1',
            'maintenance_mode' => 'required|in:0,1',
            'analytics_code' => 'nullable|string|max:1000',
            'google_tag_manager' => 'nullable|string|max:1000',
            
            // Business Information
            'business_registration' => 'nullable|string|max:255',
            'mara_number' => 'nullable|string|max:255',
            'abn_number' => 'nullable|string|max:255',
            'business_description' => 'nullable|string|max:500',
            
            // Footer Settings
            'footer_copyright' => 'nullable|string|max:255',
            'footer_description' => 'nullable|string|max:500',
        ]);

        // Update or create each setting
        foreach ($validatedData as $key => $value) {
            HomeContent::updateOrCreate(
                ['meta_key' => $key],
                [
                    'meta_value' => $value,
                    'meta_description' => $this->getSettingDescription($key)
                ]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    
    /**
     * Get setting description for help text
     */
    private function getSettingDescription($key)
    {
        $descriptions = [
            'meta_title' => 'The main title that appears in search engine results and browser tabs',
            'meta_description' => 'Brief description that appears in search engine results',
            'meta_keywords' => 'Keywords relevant to your business for SEO purposes',
            'og_title' => 'Title for social media sharing (Facebook, Twitter, etc.)',
            'og_description' => 'Description for social media sharing',
            'og_image' => 'Image URL for social media sharing',
            'site_name' => 'Official name of your business',
            'site_tagline' => 'Short tagline or motto for your business',
            'contact_email' => 'Primary contact email address',
            'contact_phone' => 'Primary contact phone number',
            'contact_address' => 'Physical office address',
            'office_hours' => 'Business operating hours',
            'facebook_url' => 'Facebook page URL',
            'twitter_url' => 'Twitter profile URL',
            'instagram_url' => 'Instagram profile URL',
            'linkedin_url' => 'LinkedIn company page URL',
            'youtube_url' => 'YouTube channel URL',
            'sliderstatus' => 'Enable or disable homepage slider',
            'meet_link' => 'URL for the main call-to-action button',
            'hero_title' => 'Main headline on homepage',
            'hero_subtitle' => 'Subtitle on homepage',
            'contact_form_email' => 'Email address for contact form submissions',
            'appointment_email' => 'Email address for appointment bookings',
            'support_email' => 'Email address for customer support',
            'recaptcha_enabled' => 'Enable Google reCAPTCHA for forms',
            'maintenance_mode' => 'Enable maintenance mode to temporarily disable site',
            'analytics_code' => 'Google Analytics tracking code',
            'google_tag_manager' => 'Google Tag Manager code',
            'business_registration' => 'Business registration number',
            'mara_number' => 'MARA registration number',
            'abn_number' => 'Australian Business Number',
            'business_description' => 'Brief description of your business services',
            'footer_copyright' => 'Copyright text for website footer',
            'footer_description' => 'Description text for website footer',
        ];
        
        return $descriptions[$key] ?? 'Setting description';
    }
    
    /**
     * Display all users
     */
    public function users(Request $request)
    {
        $query = User::select('id', 'name', 'email', 'company_name', 'role', 'status', 'created_at');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form to create new user
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,user'],
            'status' => ['required', 'in:0,1'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Show form to edit user
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,user'],
            'status' => ['required', 'in:0,1'],
        ]);

        $data = $request->only(['name', 'email', 'phone', 'company_name', 'role', 'status']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting the current user
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
