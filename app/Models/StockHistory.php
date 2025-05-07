<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct use statement
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    use HasFactory; // Correct trait name

    protected $fillable = [
        'stock_id',
        'type',
        'quantity',
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}

