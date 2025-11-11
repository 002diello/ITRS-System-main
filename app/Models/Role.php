<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the users that have this role.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope a query to only include active roles.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if this is the admin role.
     */
    public function isAdmin(): bool
    {
        return $this->slug === 'admin';
    }

    /**
     * Check if this is the HOD role.
     */
    public function isHod(): bool
    {
        return $this->slug === 'hod';
    }

    /**
     * Check if this is the HOD IT role.
     */
    public function isHodIt(): bool
    {
        return $this->slug === 'hod-it';
    }

    /**
     * Check if this is the IT Staff role.
     */
    public function isItStaff(): bool
    {
        return $this->slug === 'it-staff';
    }

    /**
     * Check if this is a regular user role.
     */
    public function isRegularUser(): bool
    {
        return $this->slug === 'user';
    }
}
