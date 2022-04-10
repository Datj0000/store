<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $table = 'imports';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code', 'supplier_id', 'fee_ship'
    ];
}
