<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Assembly;
use App\Models\Warehouse\BahanBaku;
use Illuminate\Http\Request;

class AssemblyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
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
        // return $request->assembly[0]['sku_product'];

        $request->validate([
            'sku_bahan_baku' => 'required',
            'jumlah' => 'required',
        ]);

        Assembly::where('sku_product', $request->assembly[0]['sku_product'])->delete();
        foreach ($request->assembly as $data) {

            $input = $data;
            $satuan = BahanBaku::select()->where('sku', $input['sku_bahan_baku'])->get()->first();
            $input['satuan'] = $satuan->satuan;
            $input['sku_product'] = $request->assembly[0]['sku_product'];

            Assembly::create([
                'sku_product' => $input['sku_product'],
                'sku_bahan_baku' => $input['sku_bahan_baku'],
                'jumlah' => $input['jumlah'],
                'satuan' => $input['satuan'],
            ]);
        }

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
        //
    }
}
