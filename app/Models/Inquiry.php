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
}
