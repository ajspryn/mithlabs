<?php

namespace App\Http\Controllers\Warehouse;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Settings\Warna;
use App\Models\Settings\Satuan;
use App\Models\Settings\Vendor;
use App\Imports\BahanBakuImport;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\Product;
use Maatwebsite\Excel\Facades\Excel;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::select('warna')->groupBy('warna')->get();
        return view('bahan-baku.index', [
            'bahan_bakus' => BahanBaku::with('vendor')->get(),
            'warnas' => Warna::all(),
            'satuans' => Satuan::all(),
            'vendors' => Vendor::all(),
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
            Excel::import(new BahanBakuImport, request()->file('upload_file'));
            return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
        } else {
            $request->validate([
                'sku' => 'required',
                'nama' => 'required',
                'warna' => 'required',
                'satuan' => 'required',
                'harga' => 'required',
                'kode_vendor' => 'required',
            ]);

            $input = $request->all();
            $input['uuid'] = Uuid::uuid4();


            BahanBaku::create($input);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BahanBaku::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
