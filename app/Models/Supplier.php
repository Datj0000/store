<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_name', 'supplier_phone', 'supplier_email', 'supplier_status', 'supplier_address', 'supplier_debt', 'supplier_mst'
    ];
}
