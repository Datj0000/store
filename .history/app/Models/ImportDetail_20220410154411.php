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
        'soldout','import_id','product_id','product_code', 'image', 'drive', 'import_price', 'sell_price', 'date_start', 'date_end', 'quantity', 'vat'
    ];
}
