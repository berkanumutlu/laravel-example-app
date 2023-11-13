<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Articles extends BaseModel
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

    public function scopeTitle($query, $value)
    {
        if (!is_null($value)) {
            return $query->where("title", "LIKE", "%".$value."%");
        }
    }

    public function scopeSlug($query, $slug)
    {
        if (!is_null($slug)) {
            return $query->where("slug", "LIKE", "%".$slug."%");
        }
    }

    public function scopeBody($query, $body)
    {
        if (!is_null($body)) {
            return $query->where("body", "LIKE", "%".$body."%");
        }
    }

    public function scopeCategory($query, $category_id)
    {
        if (!is_null($category_id)) {
            return $query->where('category_id', $category_id);
        }
    }
}
