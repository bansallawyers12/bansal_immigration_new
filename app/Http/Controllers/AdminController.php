<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Slider;
use App\Models\HomeContent;
use App\Models\User;

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
        $stats = [
            'unread_contacts' => Contact::unread()->count(),
            'total_contacts' => Contact::count(),
            'recent_enquiries' => Enquiry::recent(7)->count(),
            'total_blogs' => Blog::count(),
            'total_services' => Service::count(),
            'active_sliders' => Slider::active()->count(),
        ];

        $recent_contacts = Contact::with([])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }

    /**
     * Show all contacts
     */
    public function contacts(Request $request)
    {
        $query = Contact::query();

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
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
     * Show all enquiries
     */
    public function enquiries()
    {
        $enquiries = Enquiry::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    /**
     * Content management dashboard
     */
    public function content()
    {
        $content_stats = [
            'blogs' => Blog::count(),
            'services' => Service::count(),
            'sliders' => Slider::count(),
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
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'sliderstatus' => 'required|in:0,1',
            'meet_link' => 'required|string|max:255',
        ]);

        foreach ($request->only(['meta_title', 'meta_description', 'sliderstatus', 'meet_link']) as $key => $value) {
            HomeContent::updateOrCreate(
                ['meta_key' => $key],
                ['meta_value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    
    /**
     * Display all users
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
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
