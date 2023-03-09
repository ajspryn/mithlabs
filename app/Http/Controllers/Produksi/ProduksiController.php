<?php

namespace App\Http\Controllers\Produksi;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Produksi\Produksi;
use App\Models\Warehouse\Product;
use App\Models\Settings\Pengrajin;
use App\Http\Controllers\Controller;
use App\Models\Settings\Vendor;
use App\Models\Warehouse\Assembly;
use App\Models\Warehouse\BahanBaku;
use Illuminate\Support\Facades\Auth;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data= Produksi::with('product','pengrajin','qc')->select()->get();
        // return $dat;
        if (Auth::user()->role_id == 2) {
            $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Planning Produksi', 'Produksi Ditolak', 'Produksi Disetujui', 'Bahan Baku Dipesan', 'Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->limit(9)->get();
            if (request('sku_product')) {
                $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Planning Produksi', 'Produksi Ditolak', 'Produksi Disetujui', 'Bahan Baku Dipesan', 'Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->where('sku_product', request('sku_product'))->whereYear('created_at', request('tahun'))->get();
            }
        } elseif (Auth::user()->role_id == 3) {
            $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Produksi Disetujui', 'Bahan Baku Dipesan', 'Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->limit(9)->get();
            if (request('sku_product')) {
                $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Produksi Disetujui', 'Bahan Baku Dipesan', 'Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->where('sku_product', request('sku_product'))->whereYear('created_at', request('tahun'))->get();
            }
        } elseif (Auth::user()->role_id == 4) {
            $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->limit(9)->get();
            if (request('sku_product')) {
                $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Bahan Baku Dikirim', 'Sedang Diproduksi', 'Produksi Selesai'])->where('sku_product', request('sku_product'))->whereYear('created_at', request('tahun'))->get();
            }
        } elseif (Auth::user()->role_id == 5) {
            $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Sedang Diproduksi', 'Produksi Selesai'])->limit(9)->get();
            if (request('sku_product')) {
                $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->wherein('status', ['Sedang Diproduksi', 'Produksi Selesai'])->where('sku_product', request('sku_product'))->whereYear('created_at', request('tahun'))->get();
            }
        } elseif (Auth::user()->role_id == 6) {
            $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->limit(9)->get();
            if (request('sku_product')) {
                $produksi = Produksi::with('product', 'pengrajin', 'qc')->orderBy('id', 'desc')->select()->where('sku_product', request('sku_product'))->whereYear('created_at', request('tahun'))->get();
            }
        }
        // return Product::with('assembly')->select()->get();
        return view('produksi.index', [
            'produksis' => $produksi,
            'pengrajins' => Pengrajin::all(),
            'products' => Product::with('assembly')->select()->get(),
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
        $produksi = Produksi::select()->where('sku_product', $request->sku_product)->get()->count();
        $request->validate([
            'kode_pengrajin' => 'nullable',
            'sku_product' => 'required',
            'jumlah' => 'required',
            'catatan' => 'nullable',
        ]);

        $input = $request->all();
        $input['status'] = 'Planning Produksi';
        if (Auth::user()->role_id == 2) {
            $input['status'] = 'Produksi Disetujui';
        }
        $input['batch'] = $produksi + 1;
        $input['kode'] = $input['sku_product'] . '-' . sprintf('%03d', $produksi + 1) . '-' . Carbon::now()->format('m-y');
        // return $input['kode'];
        Produksi::create($input);
        return redirect(Auth::user()->role->role . '/produksi' . '/' . $input['kode']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $produksi = Produksi::with('product', 'pengrajin', 'qc', 'assembly', 'order')->select()->where('kode', $id)->get();
        // $assembly = Assembly::with('bahanbaku', 'stok_bahanbaku')->select()->where('sku_product', $produksi->product->sku)->get()->first();
        // return $produksi->first();
        return view('produksi.detail', [
            'produksi' => $produksi->first(),
            'produksis' => $produksi,
            'pengrajins' => Pengrajin::all(),
            'assemblies' => Assembly::with('bahanbaku')->select()->where('sku_product', $produksi->first()->product->sku)->get(),
            'vendors' => Vendor::all(),
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
        // return $id;
        // $input = $request->all();
        $validate = [
            'kode_pengrajin' => 'required',
            'status' => 'required',
        ];

        $input = $request->validate($validate);
        Produksi::where('kode', $id)->update($input);
        return redirect()->back()->with('success', 'Terimakasih');
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
