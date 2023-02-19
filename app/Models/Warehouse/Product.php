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
}
