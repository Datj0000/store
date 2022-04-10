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
        'name', 'code', 'condition', 'number', 'time', 'date_start', 'date_end','status'
    ];
}
