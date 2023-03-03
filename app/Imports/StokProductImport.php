<?php

namespace App\Imports;

use App\Models\Settings\Brand;
use App\Models\Settings\GudangPenyimpanan;
use App\Models\Settings\KategoriProduct;
use App\Models\Settings\Warna;
use Carbon\Carbon;
use App\Models\Warehouse\ProductStock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        KategoriProduct::updateOrInsert([
            'kode'=>$row['kategori'],
            'nama'=>$row['kategori'],
        ]);
        Warna::updateOrInsert([
            'kode'=>$row['warna'],
            'nama'=>$row['warna'],
        ]);
        Brand::updateOrInsert([
            'kode'=>$row['kode_brand'],
            'nama'=>$row['kode_brand'],
        ]);
        GudangPenyimpanan::updateOrInsert([
            'kode'=>'001',
            'nama'=>'Warehouse',
            'status'=>'Utama',
            'alamat'=>'-',
        ]);
        $gudang=GudangPenyimpanan::select()->where('status','Utama')->get()->first();
        return new ProductStock([
            'sku_product' => str_replace(" ", "", $row['sku']),
            'kode_gudang'=> $gudang->kode,
            'stok'=> 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
