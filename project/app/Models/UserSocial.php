<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocial extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function social(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class, 'social_id', 'id');
    }
}
