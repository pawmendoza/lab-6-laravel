<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reference_number',
        'notes',
    ];

    /**
     * Get the product associated with the transaction.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who performed the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}