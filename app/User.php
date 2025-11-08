<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verification_token',
        'email_verification_token_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verification_token_expires_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the posts for the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get published posts for the user
     */
    public function publishedPosts()
    {
        return $this->hasMany(Post::class)->where('status', 'published');
    }

    /**
     * Check if user's email is verified
     */
    public function isEmailVerified()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Generate email verification token
     */
    public function generateEmailVerificationToken()
    {
        $this->email_verification_token = \Str::random(60);
        $this->email_verification_token_expires_at = now()->addHours(24);
        $this->save();
        
        return $this->email_verification_token;
    }

    /**
     * Verify email with token
     */
    public function verifyEmail($token)
    {
        if ($this->email_verification_token === $token && 
            $this->email_verification_token_expires_at && 
            $this->email_verification_token_expires_at->isFuture()) {
            
            $this->email_verified_at = now();
            $this->email_verification_token = null;
            $this->email_verification_token_expires_at = null;
            $this->save();
            
            return true;
        }
        
        return false;
    }

    /**
     * Check if verification token is valid
     */
    public function isVerificationTokenValid($token)
    {
        return $this->email_verification_token === $token && 
               $this->email_verification_token_expires_at && 
               $this->email_verification_token_expires_at->isFuture();
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the projects created by the user
     */
    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    /**
     * Get the projects the user is working on
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_developers')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
