<?php

namespace App\Imports;

use Ramsey\Uuid\Uuid;
use App\Models\Warehouse\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'uuid' => Uuid::uuid4(),
            'sku' => str_replace(" ", "", $row['sku']),
            'nama' => $row['nama'],
            'nama_singkat' => $row['nama_singkat'],
            'kode_brand' => str_replace(" ", "", $row['kode_brand']),
            'warna' => $row['warna'],
            'kategori' => $row['kategori'],
            'sku_config' => str_replace(" ", "", $row['sku_config']),
            'active_at' => $row['active_at'],
            'cogm' => $row['cogm'],
            'cogs' => $row['cogs'],
            'harga_marketplace' => $row['harga_marketplace'],
            'harga_jual' => $row['harga_jual'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
