<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve_slot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
}
