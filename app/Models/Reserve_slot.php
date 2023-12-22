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
}
