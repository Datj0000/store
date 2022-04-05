<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $table = 'importdetails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id', 'detailimage', 'detaildrive', 'detailiprice', 'detailsprice', 'detailstart_at', 'detailend_at', 'detailquantity', 'detailvat'
    ];
}
