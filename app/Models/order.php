<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function shop()
    {
        return $this->belongsTo(User::class, 'sp_id', 'id');
    }
    public function shop_forntend_emp_name()
    {
        return $this->belongsTo(User::class, 'assign_emp_id', 'id');
    }
    public function forntend_emp_name()
    {
        return $this->belongsTo(User::class, 'assign_emp_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'cus_id', 'id');
    }
}
