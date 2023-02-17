<?php

namespace App\Models\Warehouse;

use App\Models\Settings\Vendor;
use App\Models\Purchase\OrderBahanBaku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanBaku extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'kode_vendor', 'kode_vendor');
    }

    public function bahanbaku()
    {
        return $this->belongsTo(OrderBahanBaku::class, 'sku_bahan_baku', 'sku');
    }
}
