<?php

namespace App\Http\Controllers\Purchase;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Settings\Vendor;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Purchase\OrderBahanBaku;

class OrderBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bahan-baku.order.index', [
            'orders' => OrderBahanBaku::select('kode')->groupBy('kode')->get(),
            'bahan_bakus' => BahanBaku::select()->get(),
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
        $cek_kode = OrderBahanBaku::select()->latest()->first();
        $kode = 1;
        if (isset($cek_kode)) {
            $kode = $cek_kode->id + 1;
        }
        $tgl = Carbon::now();
        $kode_order = $tgl->format('y') . '.' . sprintf('%03d', $kode);

        foreach ($request->order_bahan_baku as $data) {

            $data->validate([
                'kode' => 'required',
                'sku_bahan_baku' => 'required',
                'jumlah' => 'required',
                'kode_vendor' => 'required',
                'kode_produksi' => 'nullable',
                'catatan' => 'nullable',
            ]);

            $input = $data->all();
            $input['kode'] = $kode_order;
            $input['status'] = 'Diajukan';

            OrderBahanBaku::create($input);
        }
        return redirect()->back()->with('success', 'Bahan Baku Berhasil Di Order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return OrderBahanBaku::with('bahanbaku','vendor','produksi')->select()->where('kode',$id)->get();
        return view('bahan-baku.order.detail', [
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
        $data=([
            'catatan' => 'nullable',
            'status' => 'nullable',
        ]);
        $input=$request->validate($data);
        OrderBahanBaku::where('kode',$id)->update($input);
        return redirect()->back()->with('success', 'Order Telah Di Setujui');
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
