<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $role = $user->role_id;
        } else {
            $role = false;
        }

        $url = '/';

        if (isset($role)) {
            if ($role == 0) {
                $nama_role = 'Admin';
            } else if ($role == 1) {
                $nama_role = 'Owner';
            } else if ($role == 2) {
                $nama_role = 'Purchase';
            } else if ($role == 3) {
                $nama_role = 'Production';
            } else if ($role == 4) {
                $nama_role = 'QC';
            } else if ($role == 5) {
                $nama_role = 'Warehouse';
            }
            return view('index', [
                'role' => $nama_role,
            ]);
        } else {
            return view('kamusiapa');
        }
        return Redirect($url);
    }
}
