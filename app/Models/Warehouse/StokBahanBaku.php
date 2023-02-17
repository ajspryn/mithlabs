<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBahanBaku extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class, 'sku_bahan_baku', 'sku');
    }
}
