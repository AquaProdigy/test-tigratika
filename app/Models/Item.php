<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            if ($item->position === null){
                $item->position = static::max('position') + 1;
            }
        });
    }

    public function child_items()
    {
        return $this->hasMany(ItemChild::class, 'item_id', 'id');
    }
}
