<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Purchase\OrderBahanBaku;
use App\Models\Warehouse\StokBahanBaku;
use App\Models\Warehouse\TransaksiBahanBaku;

class VerifikasiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id = Crypt::decryptString($id);
        return view('bahan-baku.order.verifikasi', [
            'orders' => OrderBahanBaku::with('bahanbaku', 'vendor', 'produksi')->select()->where('kode', $id)->get(),

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
        $id = Crypt::decryptString($id);
        $order = OrderBahanBaku::where('kode', $id)->where('sku_bahan_baku', $request->sku)->get()->first();
        $stok = StokBahanBaku::select()->where('sku_bahan_baku', $request->sku)->get()->first();
        if ($order->catatan == null) {
            OrderBahanBaku::where('kode', $id)->where('sku_bahan_baku', $request->sku)
                ->update([
                    'catatan' => 'Terverifikasi',
                ]);
            TransaksiBahanBaku::create([
                'sku_bahan_baku' => $request->sku,
                'jenis_transaksi' => 'Barang Masuk',
                'jumlah' => $order->jumlah,
                'kode_order' => $order->kode,
            ]);
            StokBahanBaku::where('sku_bahan_baku', $request->sku)
                ->update([
                    'stok' => $stok->stok + $order->jumlah,
                ]);
        }else{
            return redirect()->back()->with('error', $order->bahanbaku->nama.'Sudah Terverifikasi');
        }
        return redirect()->back()->with('succes', $order->bahanbaku->nama.'Berhasil Terverifikasi Dan Stok Sudah Bertambah');;
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
