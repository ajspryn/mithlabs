<?php

namespace App\Imports;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Warehouse\BahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BahanBakuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new BahanBaku([
            'uuid' => Uuid::uuid4(),
            'sku' => str_replace(" ", "", $row['sku']),
            'nama' => $row['nama'],
            'warna' => $row['warna'],
            'satuan' => $row['satuan'],
            'harga' => $row['harga'],
            'kode_vendor' => str_replace(" ", "", $row['kode_vendor']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
