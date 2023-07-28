<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrerController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        
        $data = new User();

        $request->validate([
            'first_name'    =>  'required',
            'nip'           =>  'required|integer',
            'email'         =>  'required|email',
            'password'      =>  'required|min:8|confirmed'
        ]);

        $data['first_name'] =   $request->first_name;
        $data['last_name'] =   $request->last_name;
        $data['email'] =   $request->email;
        $data['nip'] =   $request->nip;
        $data['password'] =   Hash::make($request->password);
        $data->save();

        if (Auth::attempt(['nip' => $request->nip, 'password' => $request->password])) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('error', 'Gagal register!');
        }
    }
}
