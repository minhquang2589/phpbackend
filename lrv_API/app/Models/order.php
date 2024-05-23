<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'Oder';
    protected $fillable = [
        'Custome_id',
        'Oder_date',
        'Total_price',
    ];
}
