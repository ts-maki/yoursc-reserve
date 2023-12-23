<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function getStatusColor($is_status)
    {
        switch ($is_status) {
            case 0:
                return 'bg-success';
                break;
            case 1:
                return 'bg-danger';
                break;
            default:
                return 'bg-success';
                break;
        }
    }

    public function planReserveSlot()
    {
        return $this->belongsToMany(Plan::class, 'plan_reserve_slots')->withTimestamps();
    }

    //日付を年月日(曜日)に変換して取得
    protected function date()
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->isoFormat('YYYY年M月D日(dddd)')
        );
    }
}
