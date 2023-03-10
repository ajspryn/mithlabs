<?php

namespace App\Http\Controllers\Warehouse;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Models\Settings\Brand;
use App\Models\Settings\Warna;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\Assembly;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Warehouse\ProductStock;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings\KategoriProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::with('brand')->select()->get();
        $product = Product::with('brand')->select()->get();
        $qyt_product = $product->count();
        $avg_cogm = 0;
        $avg_cogs = 0;
        $avg_harga_jual = 0;

        //rata rata
        if ($product->count() > 0) {
            $cogm = $product->sum('cogm');
            $avg_cogm = $cogm / $qyt_product;
            $cogs = $product->sum('cogs');
            $avg_cogs = $cogs / $qyt_product;
            $harga_jual = $product->sum('harga_jual');
            $avg_harga_jual = $harga_jual / $qyt_product;
        }

        return view('product.index', [
            'products' => $product,
            'avg_harga_jual' => $avg_harga_jual,
            'avg_cogm' => $avg_cogm,
            'avg_cogs' => $avg_cogs,
            'warnas' => Warna::all(),
            'kategoris' => KategoriProduct::all(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        if ($request->file('upload_file')) {
            Excel::import(new ProductImport, request()->file('upload_file'));
            // Excel::import(new StokProductImport, request()->file('upload_file'));
            return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
        } else {
            $request->validate([
                'nama' => 'required',
                'nama_singkat' => 'required',
                'kode_brand' => 'required',
                'warna' => 'required',
                'kategori' => 'required',
                'sku_config' => 'required',
                'active_at' => 'required',
                'cogm' => 'nullable',
                'cogs' => 'nullable',
                'harga_marketplace' => 'required',
                'harga_jual' => 'required',
                'foto_product' => 'required',
                'desain_product' => 'nullable',
            ]);

            $input = $request->all();

            if ($request->file('foto_product')) {
                $input['foto_product'] = $request->file('foto_product')->store('foto-product');
            }

            if ($request->file('desain_product')) {
                $input['desain_product'] = $request->file('desain_product')->store('desain-product');
            }

            $warna = Warna::select()->where('nama', $input['warna'])->get()->first();
            $sku = $input['nama_singkat'] . $input['brand'] . '-' . $warna->kode . '-' . $input['warna'];
            $input['uuid'] = Uuid::uuid4();
            $input['sku'] = $sku;


            Product::create($input);
            return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('brand')->select()->where('uuid', $id)->get()->first();
        // return ProductStock::with('gudang')->select()->where('sku_product', $product->sku)->get();
        return view('product.detail', [
            'product' => $product,
            'stoks' => ProductStock::with('gudang')->select()->where('sku_product', $product->sku)->get(),
            'bahan_bakus' => BahanBaku::all(),
            'assemblies' => Assembly::select()->where('sku_product', $product->sku)->get(),
            'warnas' => Warna::all(),
            'kategoris' => KategoriProduct::all(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $rules = [
            'nama' => 'required',
            'nama_singkat' => 'required',
            'kode_brand' => 'required',
            'warna' => 'required',
            'kategori' => 'required',
            'sku_config' => 'required',
            'active_at' => 'required',
            'cogm' => 'nullable',
            'cogs' => 'nullable',
            'harga_marketplace' => 'required',
            'harga_jual' => 'required',
            'foto_product' => 'nullable',
            'desain_product' => 'nullable',
        ];

        $input = $request->validate($rules);

        if ($request->file('foto_product')) {
            if ($request->foto_product_lama) {
                Storage::delete($request->foto_product_lama);
            }
            $input['foto_product'] = $request->file('foto_product')->store('foto-product');
        }

        if ($request->file('desain_product')) {
            if ($request->desain_product_lama) {
                Storage::delete($request->desain_product_lama);
            }
            $input['desain_product'] = $request->file('desain_product')->store('desain-product');
        }

        Product::where('uuid', $id)->update($input);
        return redirect()->back()->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
