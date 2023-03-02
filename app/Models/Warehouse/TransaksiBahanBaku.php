<?php

namespace App\Models\Warehouse;

use App\Models\Purchase\OrderBahanBaku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiBahanBaku extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class, 'sku_bahan_baku', 'sku');
    }
    public function order()
    {
        return $this->belongsTo(OrderBahanBaku::class, 'sku_bahan_baku', 'sku_bahan_baku');
    }
}
