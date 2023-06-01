<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        return view('pages.user.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required|string',
            'no_hp'                  => 'required|numeric',
            'alamat_lengkap'                  => 'required',
        ]);

        $user = User::findOrFail(Auth::user()->id);        

        $data = $request->all();

        $result = $user->update($data);

        if ($result != null) {
            return redirect()->route('profile.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('profile.index')->with('error',' Data Gagal di Simpan!');
        }
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
    
            ]);

            if(!(Hash::check($request->get('oldPassword'), Auth::user()->password))){
                
                return redirect()->route('profile.index')->with('error','Password Lama Anda Salah');

            }
    
            if(strcmp($request->get('oldPassword'), $request->get('password')) == 0){

                return redirect()->route('profile.index')->with('error','Password Lama Anda Tidak Boleh Sama Dengan Password Baru');
            }
           
            $user = Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();

            return redirect()->route('profile.index')->with('sukses','Password Anda Berhasil di Ganti');

    }
    
}
