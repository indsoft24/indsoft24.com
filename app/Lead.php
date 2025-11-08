<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'message',
        'source',
        'status',
        'is_read',
        'ip_address',
        'user_agent',
        'spam_score',
        'is_spam',
        'notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_spam' => 'boolean',
        'spam_score' => 'integer',
    ];

    /**
     * Scope for unread leads
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for new leads
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope for non-spam leads
     */
    public function scopeNotSpam($query)
    {
        return $query->where('is_spam', false);
    }
}
