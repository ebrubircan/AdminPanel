<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function showForm()
    {
        return view('admin.auth.create-password');
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:4',
        ]);

        $email =$request->input('email');
        $user = User::where('email',$email)->first();

        if(empty($user)){
            return redirect()->route('login');
        }

        $password = $request->input('password');
        $user->password = Hash::make($password);
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');

    }
}


