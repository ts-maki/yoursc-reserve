<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_reserve_slot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reserveSlot()
    {
        return $this->belongsTo(Reserve_slot::class);
    }
}
