<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function planRoomType()
    {
        return $this->belongsToMany(Room_type::class, 'plan_room_type')->withTimestamps();
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
