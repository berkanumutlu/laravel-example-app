<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static function boot(): void
    {
        parent::boot();
    }

    protected function scopeStatus($query, $value = null)
    {
        if (isset($value)) {
            return $query->where('status', $value);
        }
    }

    public function scopeOrder($query, $value = null)
    {
        if (isset($value)) {
            return $query->where("order", $value);
        }
    }

    public function scopeUser($query, $value = null)
    {
        //dd($query->getQuery()->wheres);
        if (isset($value)) {
            $query->where('user_id', $value);
        }
    }
}
