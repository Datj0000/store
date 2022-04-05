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
        ''product_id', 'detail_image', 'detail_drive', 'detail_iprice', 'detail_sprice', 'detail_start_at', 'detail_end_at', 'detail_quantity', 'detail_vat'
    ];
}
