<?php

namespace App\Models\Warehouse;

use App\Models\Settings\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'kode_brand', 'kode');
    }
    public function bahan_baku()
    {
        return $this->hasMany(BahanBaku::class, 'sku', 'sku_bahan_baku');
    }
    public function produksi()
    {
        return $this->hasMany(produksi::class, 'sku', 'sku_product');
    }
    public function assembly()
    {
        return $this->hasMany(Assembly::class, 'sku_product', 'sku');
    }
}
