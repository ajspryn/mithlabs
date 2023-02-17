<?php

namespace App\Models\Settings;

use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'brand', 'kode');
    }
}
