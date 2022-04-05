<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $table = 'importds';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id', 'import_image', 'import_drive', 'import_iprice', 'import_sprice', 'import_start_at', 'import_end_at', 'import_quantity', 'import_vat'
    ];
}
