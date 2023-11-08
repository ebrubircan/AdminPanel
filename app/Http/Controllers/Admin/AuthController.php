<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('admin.auth.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();

        if (!$user) {

            return redirect()->back();
        }
        if (empty($user->password)) {
            return view('admin.auth.create-password')->with('title', $email);
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
        /*$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if ($request->has('remember_me')) {
            $hour = 3600 * 24 * 30;
            setcookie("email", $request->email, time() + $hour);
            setcookie("password", $request->password, time() + $hour);
        }

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Login Successful');


    }*/
}
