<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function inquiryType()
    {
        return $this->belongsTo(Inquiry_type::class);
    }

    public function inquiryStatus()
    {
        return $this->belongsTo(Inquiry_status::class);
    }

    public function getStatusColor($inquiry_status_id)
    {
        switch ($inquiry_status_id) {
            case 1:
                return 'bg-danger';
                break;
            case 2:
                return 'bg-primary';
                break;
            case 3:
                return 'bg-success';
                break;
            default:
            return 'bg-danger';
                break;
        }
    }
}
