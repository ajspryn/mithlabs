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
                $url = '/admin';
            } elseif ($role == 1) {
                $url = '/owner';
            } elseif ($role == 2) {
                $url = '/production';
            } elseif ($role == 3) {
                $url = '/purchasing';
            } elseif ($role == 4) {
                $url = '/warehouse';
            } else {
                $url = '/';
            }
        } else {
            return view('kamusiapa');
        }
        return Redirect($url);
    }
}
