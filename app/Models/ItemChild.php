<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemChild extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
