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
}
