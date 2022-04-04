<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $primaryKey = 'id';
    protected $fillable = [
        'coupon_name', 'coupon_desc','coupon_code', 'coupon_condition', 'coupon_number', 'coupon_time', 'coupon_start_at', 'coupon_end_at','coupon_status'
    ];
}
