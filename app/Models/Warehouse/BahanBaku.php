<?php

namespace App\Models\Warehouse;

use App\Models\Settings\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
