<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    //protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'order'      => 'string',
        'created_at' => 'datetime:Y-m-d H:00'
    ];

    public function parentCategory(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function childCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    public function childActiveCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', 1);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function articlesActive(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id', 'id')
            ->where('status', 1)
            ->whereNotNull('publish_date')
            //->where('publish_date', '<=', now())
            ->whereDate('publish_date', '<', now());
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}
