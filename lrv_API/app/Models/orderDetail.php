<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    use HasFactory;
    protected $table = 'oder_detail';
    protected $fillable = [
        'Oder_id',
        'Product_id',
        'qty',
        'Price'

    ];
}
