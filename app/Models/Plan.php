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

    public function planReserveSlot()
    {
        return $this->belongsToMany(Reserve_slot::class, 'plan_reserve_slots')->withTimestamps();
    }

    public function planReserveSlots()
    {
        return $this->hasMany(Plan_reserve_slot::class);
    }

    public function sortByReserveDate($plans)
    {
        $plans = $plans->sortBy(function ($plan) {
            return $plan->planReserveSlots->sortBy(function ($reserve_slot_date) {
                return $reserve_slot_date->reserveSlot->date;
            })->first()->reserveSlot->date;
        });

        return $plans;
    }
}
