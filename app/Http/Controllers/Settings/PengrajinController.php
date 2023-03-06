<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Pengrajin;
use Illuminate\Http\Request;

class PengrajinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("settings.pengrajin", [
            "pengrajins" => Pengrajin::all(),
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
        ]);

        $input = $request->all();

        Pengrajin::create($input);
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
        $data = [
            "kode" => "required",
            "nama" => "required",
        ];

        $input = $request->validate($data);

        Pengrajin::where("id", $id)->update($input);
        return redirect()
            ->back()
            ->with("success", "Data Berhasil Di Ubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengrajin::destroy($id);
        return redirect()
            ->back()
            ->with("success", "Data Berhasil Dihapus");
    }
}
