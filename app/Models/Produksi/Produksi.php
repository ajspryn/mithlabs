<?php

namespace App\Models\Produksi;

use App\Models\Warehouse\Product;
use App\Models\Settings\Pengrajin;
use App\Models\Warehouse\Assembly;
use App\Models\Warehouse\QcProduct;
use App\Models\Purchase\OrderBahanBaku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku_product', 'sku');
    }
    public function pengrajin()
    {
        return $this->belongsTo(Pengrajin::class, 'kode_pengrajin', 'kode');
    }
    public function qc()
    {
        return $this->belongsTo(QcProduct::class, 'kode_produksi', 'kode');
    }
    public function order()
    {
        return $this->hasMany(OrderBahanBaku::class, 'kode_produksi', 'kode');
    }
    public function assembly()
    {
        return $this->hasMany(Assembly::class, 'sku_product', 'sku_product');
    }
}
