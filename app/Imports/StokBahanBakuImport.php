<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Warehouse\StokBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokBahanBakuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StokBahanBaku([
            'sku_bahan_baku' => str_replace(" ", "", $row['sku']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
