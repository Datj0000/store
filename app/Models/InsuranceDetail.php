<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceDetail extends Model
{
    use HasFactory;
    protected $table = 'insurancedetails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'insurance_id',
        'product_code',
        'quantity'
    ];
}
