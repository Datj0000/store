<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id','product_code','quantity'
    ];
}
