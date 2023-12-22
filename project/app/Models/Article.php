<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeTitle($query, $title)
    {
        if (!is_null($title)) {
            return $query->where('title', 'LIKE', '%'.$title.'%');
        }
    }

    public function scopeSlug($query, $slug)
    {
        if (!is_null($slug)) {
            return $query->where('slug', 'LIKE', '%'.$slug.'%');
        }
    }

    public function scopeBody($query, $body)
    {
        if (!is_null($body)) {
            return $query->where('body', 'LIKE', '%'.$body.'%');
        }
    }

    public function scopeCategory($query, $category_id)
    {
        if (!is_null($category_id)) {
            return $query->where('category_id', $category_id);
        }
    }

    public function scopeTag($query, $tag)
    {
        if (!is_null($tag)) {
            return $query->where('tags', 'LIKE', '%'.$tag.'%');
        }
    }

    public function scopePublishDate($query, $publish_date)
    {
        if (!is_null($publish_date)) {
            $publish_date = Carbon::parse($publish_date)->format('Y-m-d H:i:s');
            return $query->where('publish_date', '>=', $publish_date);
        }
    }

    public function getTagsAttribute($value): array
    {
        return explode(',', $value);
    }

    public function getPublishDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d M Y');
    }
}
