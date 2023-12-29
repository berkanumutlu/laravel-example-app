<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ArticleComments extends BaseModel
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

    public function children(): HasMany
    {
        return $this->hasMany(ArticleComments::class, 'parent_id', 'id')
            ->where('status', 1)->withTrashed();
    }

    public function scopeUser($query, $value = null)
    {
        if (!empty($value)) {
            return $query->where('user_id', $value);
        } elseif (isset($value)) {
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
