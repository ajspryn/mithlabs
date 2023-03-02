<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Warehouse\StokBahanBaku;
use App\Models\Warehouse\TransaksiBahanBaku;

class StokBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return TransaksiBahanBaku::with('bahanbaku')->select()->limit(5)->get();
        return view('bahan-baku.stok.index', [
            'stoks' => StokBahanBaku::all(),
            'transaksis'=>TransaksiBahanBaku::with('bahanbaku')->select()->take(5)->get(),

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=Crypt::decryptString($id);
        // return BahanBaku::with('order','stok','transaksi')->select()->where('sku',$id)->get()->first();
        return view('bahan-baku.stok.detail',[
            'bahanbaku'=>BahanBaku::with('order','stok','transaksi')->select()->where('sku',$id)->get()->first(),
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
