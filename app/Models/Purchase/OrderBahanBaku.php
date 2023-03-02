<?php

namespace App\Models\Purchase;

use App\Models\Settings\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\BahanBaku;

class OrderBahanBaku extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class, 'sku_bahan_baku', 'sku');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'kode_vendor', 'kode');
    }

    public function produksi()
    {
        return $this->belongsTo(Vendor::class, 'kode_produksi', 'kode');
    }
}
