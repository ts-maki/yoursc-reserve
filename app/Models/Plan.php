<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function planRoom()
    {
        return $this->belongsToMany(Room::class, 'plan_room')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
}
