<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /*public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }*/
}
