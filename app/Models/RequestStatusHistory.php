<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestStatusHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'request_id',
        'status',
        'comments',
        'changed_by',
        'changed_at',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'changed_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Get the request that owns the status history.
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * Get the user who changed the status.
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * Get the status as a formatted string.
     */
    public function getStatusTextAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    /**
     * Scope a query to only include status changes for a specific request.
     */
    public function scopeForRequest($query, $requestId)
    {
        return $query->where('request_id', $requestId);
    }

    /**
     * Scope a query to only include status changes by a specific user.
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('changed_by', $userId);
    }

    /**
     * Scope a query to only include status changes after a specific date.
     */
    public function scopeAfter($query, $date)
    {
        return $query->where('changed_at', '>=', $date);
    }

    /**
     * Scope a query to only include status changes before a specific date.
     */
    public function scopeBefore($query, $date)
    {
        return $query->where('changed_at', '<=', $date);
    }

    /**
     * Get the metadata as an array.
     */
    public function getMetadataAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Set the metadata attribute.
     */
    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = is_array($value) ? json_encode($value) : $value;
    }
}
