<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
