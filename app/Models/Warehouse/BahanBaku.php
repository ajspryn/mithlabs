<?php

namespace App\Models\Warehouse;

use App\Models\Settings\Vendor;
use App\Models\Purchase\OrderBahanBaku;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\TransaksiBahanBaku;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanBaku extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'kode_vendor', 'kode');
    }
    public function stok()
    {
        return $this->belongsTo(StokBahanBaku::class, 'sku','sku_bahan_baku');
    }
    public function order()
    {
        return $this->hasMany(OrderBahanBaku::class, 'sku_bahan_baku', 'sku');
    }
    public function transaksi()
    {
        return $this->hasMany(TransaksiBahanBaku::class, 'sku_bahan_baku', 'sku');
    }
}
