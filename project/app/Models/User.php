<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image',
        'title',
        'description',
        'status',
        'oauth_type',
        'oauth_id'
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
        'password'          => 'hashed',
    ];
    
    /*private mixed $settings;

    public function __construct()
    {
        $this->settings = cache('settings');
    }

    public function getImageAttribute($value): string
    {
        if (empty($value)) {
            if (!empty($this->settings) && !empty($this->settings->image_default_author)) {
                return asset($this->settings->image_default_author);
            }
            return '';
        }
        return $value;
    }*/

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    public function articleComments(): HasMany
    {
        return $this->hasMany(ArticleComments::class, 'user_id', 'id');
    }

    public function hasLogs(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id', 'id');
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'user_id', 'id');
    }
}
