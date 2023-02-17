<?php

namespace App\Models\Settings;

use App\Models\Warehouse\BahanBaku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function bahan_baku()
    {
        return $this->hasMany(BahanBaku::class, 'vendor_kode', 'vendor_kode');
    }
}
