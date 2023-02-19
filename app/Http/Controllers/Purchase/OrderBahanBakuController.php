<?php

namespace App\Http\Controllers\Purchase;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Settings\Vendor;
use App\Models\Warehouse\BahanBaku;
use App\Http\Controllers\Controller;
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
        return view('bahan-baku.order', [
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
        $cek_kode = OrderBahanBaku::select()->latest()->first();
        $kode = 1;
        if (isset($cek_kode)) {
            $kode = $cek_kode->id + 1;
        }
        $tgl = Carbon::now();
        $kode_order = $tgl->format('y') . '.' . sprintf('%03d', $kode);

        foreach ($request->order_bahan_baku as $data) {

            $input = $data;
            $input['kode'] = $kode_order;
            $input['status'] = 'Diajukan';
            // return $input;

            OrderBahanBaku::create($input);
        }
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
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
