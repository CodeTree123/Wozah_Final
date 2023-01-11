<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp_verify extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile',
        'otp',
        'verified_at',
    ];
}
