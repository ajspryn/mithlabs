<?php

namespace App\Http\Controllers\Warehouse;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Settings\Brand;
use App\Models\Settings\Warna;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\Assembly;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\ProductStock;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings\KategoriProduct;
use App\Models\Settings\GudangPenyimpanan;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', [
            'products' => Product::all(),
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
        $request->validate([
            'nama' => 'required',
            'nama_singkat' => 'required',
            'brand' => 'required',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::select()->where('uuid', $id)->get()->first();
        return view('product.detail', [
            'product' => $product,
            'stoks' => ProductStock::select()->where('sku', $product->sku)->get(),
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
            'brand' => 'required',
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
