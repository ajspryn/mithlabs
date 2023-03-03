<?php

namespace App\Models\Warehouse;

use App\Models\Settings\GudangPenyimpanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function gudang()
    {
        return $this->belongsTo(GudangPenyimpanan::class, 'kode_gudang','kode');
    }
}
