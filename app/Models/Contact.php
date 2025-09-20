<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
        'subject',
        'message',
        'status',
        'forwarded_to',
        'forwarded_at',
        'form_source',
        'form_variant',
        'ip_address',
    ];

    protected $casts = [
        'forwarded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor for email attribute that maps to contact_email
     */
    public function getEmailAttribute()
    {
        return $this->contact_email;
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for read contacts
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Mark contact as read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark contact as resolved
     */
    public function markAsResolved()
    {
        $this->update(['status' => 'resolved']);
    }

    /**
     * Forward contact to a team member
     */
    public function forwardTo($email)
    {
        $this->update([
            'forwarded_to' => $email,
            'forwarded_at' => now(),
        ]);
    }

    /**
     * Mark contact as archived
     */
    public function markAsArchived()
    {
        $this->update(['status' => 'archived']);
    }

    /**
     * Mark contact as unarchived (back to read)
     */
    public function markAsUnarchived()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Scope for archived contacts
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Scope for non-archived contacts
     */
    public function scopeNotArchived($query)
    {
        return $query->where('status', '!=', 'archived');
    }

    /**
     * Scope for resolved contacts
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'unread' => 'bg-red-100 text-red-800',
            'read' => 'bg-yellow-100 text-yellow-800',
            'resolved' => 'bg-green-100 text-green-800',
            'archived' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get formatted creation date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M j, Y');
    }

    /**
     * Get formatted creation time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->created_at->format('g:i A');
    }
}
