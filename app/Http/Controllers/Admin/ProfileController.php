<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProfileController extends Controller
{
    public function dashboard(){
        $data=[
            'title'=>'Dashboard'
        ];
        return view('admin.dashboard',$data);
    }

    public function logout(){
        Auth::logout();

        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('password'));

        return redirect('admin/login');
    }
}
