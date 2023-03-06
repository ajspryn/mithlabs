<?php

namespace App\Imports;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Settings\Warna;
use App\Models\Settings\Satuan;
use App\Models\Warehouse\BahanBaku;
use App\Models\Warehouse\StokBahanBaku;
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
        // $cek_satuan = Satuan::select()->where('nama', $row['satuan'])->get()->first();
        if (Satuan::select()->where('nama', $row['satuan'])->get()->first() == null) {
            Satuan::updateOrInsert([
                'nama' => $row['satuan'],
            ]);
        }
        if (Warna::select()->where("nama", $row["warna"])->get()->first() == null) {
            Warna::create([
                "kode" => $row["warna"],
                "nama" => $row["warna"],
            ]);
        }
        if (StokBahanBaku::select()->where('sku_bahan_baku', $row['sku'])->get()->first() == null) {
            StokBahanBaku::create([
                'sku_bahan_baku' => str_replace(" ", "", $row['sku']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        if (BahanBaku::select()->where('sku', $row['sku'])->get()->first() == null) {
            BahanBaku::create([
                'uuid' => Uuid::uuid4(),
                'sku' => str_replace(" ", "", $row['sku']),
                'nama' => $row['nama'],
                'warna' => $row['warna'],
                'satuan' => $row['satuan'],
                'harga' => $row['harga'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // return new BahanBaku([
        // 'uuid' => Uuid::uuid4(),
        // 'sku' => str_replace(" ", "", $row['sku']),
        // 'nama' => $row['nama'],
        // 'warna' => $row['warna'],
        // 'satuan' => $row['satuan'],
        // 'harga' => $row['harga'],
        // 'kode_vendor' => str_replace(" ", "", $row['kode_vendor']),
        // 'created_at' => Carbon::now(),
        // 'updated_at' => Carbon::now(),
        // ]);
    }
}
