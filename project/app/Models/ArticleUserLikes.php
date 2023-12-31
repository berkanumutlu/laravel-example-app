<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleUserLikes extends BaseModel
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];
}
