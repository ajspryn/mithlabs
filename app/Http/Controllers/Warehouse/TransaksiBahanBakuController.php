<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\BahanBaku;
use App\Models\Warehouse\TransaksiBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransaksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('bahan_baku')) {
            $transaksi = TransaksiBahanBaku::select()->where('sku_bahan_baku', request('bahan_baku'))->where('jenis_transaksi', request('jenis_transaksi'))->get();
        } else {
            $transaksi = TransaksiBahanBaku::all();
        }
        return view('bahan-baku.transaksi.index', [
            'transaksis' => $transaksi,
            'bahan_bakus' => BahanBaku::all(),

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
        if ($request->status == 'Masuk') {
            return $request;
        } elseif ($request->status == 'Keluar') {
            return $request;
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
        return Crypt::decryptString($id);
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
