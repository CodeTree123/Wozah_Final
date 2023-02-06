<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp_verify extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'mobile',
        'otp',
        'verified_at',
    ];
}
