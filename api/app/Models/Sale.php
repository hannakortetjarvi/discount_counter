<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'product_id',
        'count',
    ];

    protected $casts = [
        'customer_id' => 'string',
        'product_id' => 'string',
    ];
}
