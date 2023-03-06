<?php

namespace App\Imports;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Settings\Brand;
use App\Models\Settings\Warna;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\ProductStock;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Settings\KategoriProduct;
use App\Models\Settings\GudangPenyimpanan;
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
        // dd($row['kategori']);

        if (KategoriProduct::select()->where("nama", $row["kategori"])->get()->first() == null) {
            KategoriProduct::updateOrInsert([
                "kode" => $row["kategori"],
                "nama" => $row["kategori"],
            ]);
        }
        if (Warna::select()->where("nama", $row["warna"])->get()->first() == null) {
            Warna::updateOrInsert([
                "kode" => $row["warna"],
                "nama" => $row["warna"],
            ]);
        }
        if (Brand::select()->where("kode", $row["kode_brand"])->get()->first() == null) {
            Brand::updateOrInsert([
                "kode" => $row["kode_brand"],
                "nama" => $row["kode_brand"],
            ]);
        }
        if (GudangPenyimpanan::select()->where("status", "Utama")->get()->count() == null) {
            GudangPenyimpanan::updateOrInsert([
                "kode" => "001",
                "nama" => "Warehouse",
                "status" => "Utama",
                "alamat" => "-",
            ]);
        }
        $gudang = GudangPenyimpanan::select()->where("status", "Utama")->get()->first();
        if (ProductStock::select()->where("sku_product", $row["sku"])->get()->count() == null) {
            ProductStock::create([
                "sku_product" => str_replace(" ", "", $row["sku"]),
                "kode_gudang" => $gudang->kode,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        if (Product::select()->where("sku", str_replace(" ", "", $row["sku"]))->get()->first() == null) {
            Product::create([
                "uuid" => Uuid::uuid4(),
                "sku" => str_replace(" ", "", $row["sku"]),
                "nama" => $row["nama"],
                "nama_singkat" => $row["nama_singkat"],
                "kode_brand" => str_replace(" ", "", $row["kode_brand"]),
                "warna" => $row["warna"],
                "kategori" => $row["kategori"],
                "sku_config" => str_replace(" ", "", $row["sku_config"]),
                "active_at" => $row["active_at"],
                "cogm" => $row["cogm"],
                "cogs" => $row["cogs"],
                "harga_marketplace" => $row["harga_marketplace"],
                "harga_jual" => $row["harga_jual"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        // return new Product([
        //     'uuid' => Uuid::uuid4(),
        //     'sku' => str_replace(" ", "", $row['sku']),
        //     'nama' => $row['nama'],
        //     'nama_singkat' => $row['nama_singkat'],
        //     'kode_brand' => str_replace(" ", "", $row['kode_brand']),
        //     'warna' => $row['warna'],
        //     'kategori' => $row['kategori'],
        //     'sku_config' => str_replace(" ", "", $row['sku_config']),
        //     'active_at' => $row['active_at'],
        //     'cogm' => $row['cogm'],
        //     'cogs' => $row['cogs'],
        //     'harga_marketplace' => $row['harga_marketplace'],
        //     'harga_jual' => $row['harga_jual'],
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
    }
}
