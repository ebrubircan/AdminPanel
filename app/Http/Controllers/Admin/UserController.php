<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        return view('users.index', ['data' => $user]);
    }

    public function add()
    {
        return view('users.form');
    }

    public function save(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        User::create($data);
        return redirect()->route('users');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.form', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        User::find($id)->update($data);
        return redirect()->route('users');
    }
    public function delete($id)
    {
        User::find($id)->delete();

        return redirect()->route('users');
    }
}
