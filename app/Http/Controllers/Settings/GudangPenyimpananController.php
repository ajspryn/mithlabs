<?php

namespace App\Http\Controllers\Settings;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\GudangPenyimpanan;

class GudangPenyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("settings.gudang-penyimpanan", [
            "gudangs" => GudangPenyimpanan::all(),
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
        $request->validate([
            "kode" => "required",
            "nama" => "required",
            "alamat" => "required",
        ]);

        $input = $request->all();

        GudangPenyimpanan::create($input);
        return redirect()
            ->back()
            ->with("success", "Data Berhasil Di Simpan");
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
        // return $request;
        if ($request->status) {
            $cek = GudangPenyimpanan::select()
                ->where("status", "Utama")
                ->get();
            $gudang = GudangPenyimpanan::select()
                ->where("id", $id)
                ->get()
                ->first();
            if ($cek->count()) {
                GudangPenyimpanan::where("id", $cek->first()->id)->update([
                    "status" => null,
                ]);
            }
            GudangPenyimpanan::where("id", $id)->update(["status" => "Utama"]);
        } else {
            $data = [
                "kode" => "required",
                "nama" => "required",
            ];

            $input = $request->validate($data);

            GudangPenyimpanan::where("id", $id)->update($input);
            return redirect()
                ->back()
                ->with("success", "Data Berhasil Di Ubah");
        }
        return redirect()->back()->with("success", "Gudang " . $gudang->nama . " Berhasil Di Jadikan Gudang Utama");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GudangPenyimpanan::destroy($id);
        return redirect()
            ->back()
            ->with("success", "Data Berhasil Dihapus");
    }
}
