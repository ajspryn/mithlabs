<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
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
        // dd($request->file('avatar'));
        if ($request->code == 1) {
            $rules = [
                'name' => 'required', 'string', 'max:255',
                'username' => 'required', 'string', 'max:255', 'unique:users',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                'avatar' => 'nullable', 'max:10000'
            ];

            $input = $request->validate($rules);

            if ($request->file('avatar')) {
                if ($request->avatarlama) {
                    Storage::delete($request->avatarlama);
                }
                $input['avatar'] = $request->file('avatar')->store('avatar');
            }

            User::where('id', $id)
                ->update($input);
            return redirect()->back()->with('success', 'Profile Berhasil Di Ubah');
        } elseif ($request->code == 2) {
            return $request;

            $rules = [
                'password' => 'required', 'string', 'min:8', 'confirmed',
            ];

            $input = $request->validate($rules);

            User::where('id', $id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
            return redirect()->back()->with('success', 'Password Berhasil Di Ubah');
        }
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
