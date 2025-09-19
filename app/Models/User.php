<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'company_name',
        'company_website',
        'company_fax',
        'country',
        'state',
        'city',
        'address',
        'zip',
        'profile_img',
        'status',
        'is_archived',
        'archived_on',
        'client_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'archived_on' => 'date',
            'status' => 'integer',
            'is_archived' => 'boolean',
        ];
    }
    
    /**
     * Check if user is active.
     */
    public function isActive(): bool
    {
        return $this->status === 1 && !$this->is_archived;
    }
    
    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Scope for active users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('is_archived', 0);
    }
    
    /**
     * Scope for admin users.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin')->active();
    }
}
