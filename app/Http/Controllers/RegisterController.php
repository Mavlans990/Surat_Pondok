<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'page' => 'Register'
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'user_nama' => 'required|unique:tb_users',
            'user_password' => 'required'
        ]);

        // $validate['password'] = bcrypt($validate['password']);
        $validate['user_password'] = Hash::make($validate['user_password']);

        Users::create($validate);

        // $request->session()->flash('success', 'Registrasi Berhasil, Silahkan Login.');
        return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login.');
    }

}
