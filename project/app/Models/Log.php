<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class Log extends Model
{
    protected $guarded = [];

    /*protected $casts = [
        'data' => 'array'
    ];*/

    protected $dateFormat = 'Y-m-d H:i:s';

    public const ACTIONS = [
        'create',
        'update',
        'delete',
        'force_delete',
        'restore',
        'approve',
        'reset',
        'login',
        'logout',
        'change_password',
        'password_changed_send_mail',
        'create_password_reset_token',
        'reset_password',
        'reset_password_changed',
        'reset_password_send_mail'
    ];

    public const MODELS = [
        Article::class,
        ArticleComments::class,
        Category::class,
        User::class,
        Settings::class
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeCreationDate($query, $date)
    {
        if (!is_null($date)) {
            return $query->whereDate('created_at', Carbon::parse($date)->format('Y-m-d'));
        }
    }
}
