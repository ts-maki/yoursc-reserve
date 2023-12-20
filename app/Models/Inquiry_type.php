<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry_type extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
