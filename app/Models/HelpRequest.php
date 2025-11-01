<?php
// app/Models/HelpRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HelpRequest extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'category', 
        'urgency', 'location', 'status', 'resolved_by',
        'resolved_at', 'solution_notes'
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_COMPLETED = 'completed';

    /**
     * Scope for active help requests (not resolved/completed)
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [self::STATUS_ACTIVE, self::STATUS_IN_PROGRESS]);
    }

    /**
     * Scope for resolved help requests
     */
    public function scopeResolved(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    /**
     * Scope for completed help requests (with reviews)
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for ordering by recent first
     */
    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Mark help request as resolved
     */
    public function markAsResolved($resolvedBy = null, $solutionNotes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_RESOLVED,
            'resolved_by' => $resolvedBy,
            'resolved_at' => now(),
            'solution_notes' => $solutionNotes
        ]);
    }

    /**
     * Check if help request is resolved
     */
    public function isResolved(): bool
    {
        return $this->status === self::STATUS_RESOLVED;
    }

    /**
     * Check if help request is active
     */
    public function isActive(): bool
    {
        return in_array($this->status, [self::STATUS_ACTIVE, self::STATUS_IN_PROGRESS]);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function offers()
    {
        return $this->hasMany(HelpOffer::class);
    }

    public function reviews()
    {
        return $this->hasOne(HelpReview::class);
    }

    /**
     * Get accepted offer
     */
    public function acceptedOffer()
    {
        return $this->hasOne(HelpOffer::class)->where('status', 'accepted');
    }
}