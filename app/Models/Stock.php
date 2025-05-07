<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct use statement
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory; // Correct trait name

    protected $fillable = [
        'product_name',
        'quantity',
    ];
}
