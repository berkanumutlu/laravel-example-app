<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ArticleComments extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id", "created_at", "updated_at", "deleted_at"];

    public function article(): HasOne
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function parent(): HasOne
    {
        return $this->hasOne(ArticleComments::class, 'id', 'parent_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeUser($query, $user_id)
    {
        if (!empty($user_id)) {
            return $query->where('user_id', $user_id);
        } elseif (isset($user_id) && empty($user_id)) {
            return $query->where('user_id', null);
        }
    }

    public function scopeCreatedAt($query, $date)
    {
        if (!is_null($date)) {
            //return $query->whereDate('created_at', 'LIKE', $date);
            return $query->where('created_at', '>=', $date)
                ->where('created_at', '<=', Carbon::parse($date)->addDays());
        }
    }

    public function scopeComment($query, $comment)
    {
        if (!is_null($comment)) {
            return $query->where('comment', 'LIKE', '%'.$comment.'%');
        }
    }

    public function scopeIPAddress($query, $ip_address)
    {
        if (!is_null($ip_address)) {
            return $query->where('ip_address', $ip_address);
        }
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->format('d M Y H:i');
    }
}
