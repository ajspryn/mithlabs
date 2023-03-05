<?php

namespace App\Imports;

use App\Models\Settings\Brand;
use App\Models\Settings\GudangPenyimpanan;
use App\Models\Settings\KategoriProduct;
use App\Models\Settings\Warna;
use Carbon\Carbon;
use App\Models\Warehouse\ProductStock;
use App\Models\Warehouse\StokBahanBaku;
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
        // $cek_kategori = KategoriProduct::select()->where('kode', $row['kategori'])->get()->first();
        // $cek_warna = Warna::select()->where('nama', $row['warna'])->get()->first();
        // $cek_brand = Brand::select()->where('kode', $row['kode_brand'])->get()->first();
        // $cek_gudang_penyimpanan = GudangPenyimpanan::select()->get()->count();
        if (KategoriProduct::select()->where('kode', $row['kategori'])->get()->first() == null) {
            KategoriProduct::updateOrInsert([
                'kode' => $row['kategori'],
                'nama' => $row['kategori'],
            ]);
        }
        if (Warna::select()->where('nama', $row['warna'])->get()->first() == null) {
            Warna::updateOrInsert([
                'kode' => $row['warna'],
                'nama' => $row['warna'],
            ]);
        }
        if (Brand::select()->where('kode', $row['kode_brand'])->get()->first() == null) {
            Brand::updateOrInsert([
                'kode' => $row['kode_brand'],
                'nama' => $row['kode_brand'],
            ]);
        }
        if (GudangPenyimpanan::select()->where('status', 'Utama')->get()->count() == null) {
            GudangPenyimpanan::updateOrInsert([
                'kode' => '001',
                'nama' => 'Warehouse',
                'status' => 'Utama',
                'alamat' => '-',
            ]);
        }

        $gudang = GudangPenyimpanan::select()->where('status', 'Utama')->get()->first();
        ProductStock::updateOrInsert([
            'sku_product' => str_replace(" ", "", $row['sku']),
            'kode_gudang' => $gudang->kode,
            'stok' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return new ProductStock([
            'sku_product' => str_replace(" ", "", $row['sku']),
            'kode_gudang' => $gudang->kode,
            'stok' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
