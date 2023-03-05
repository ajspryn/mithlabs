<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProduct extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku_product', 'sku');
    }
    public function produksi()
    {
        return $this->belongsTo(produksi::class, 'sku_product', 'sku_product');
    }
}
