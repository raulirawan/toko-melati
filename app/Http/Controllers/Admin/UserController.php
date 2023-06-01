<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionDetail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('roles','user')->get();
        return view('pages.admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'alamat_lengkap' => 'required',
            'no_hp' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['roles'] = 'user';


        $result = User::create($data);

        if ($result != null) {
            return redirect()->route('user.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('user.index')->with('error',' Data Gagal di Simpan!');
        }

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
        $user = User::findOrFail($id);

        return view('pages.admin.user.edit', compact('user'));
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

        $request->validate([
            'name' => 'required|string',
            'alamat_lengkap' => 'required',
            'no_hp' => 'required|numeric',
        ]);


        $data = $request->all();

        $item = User::findOrFail($id);

        $result = $item->update($data);

        if ($result != null) {
            return redirect()->route('user.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('user.index')->with('error',' Data Gagal di Simpan!');
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
        $item = User::findOrFail($id);

        $transaction = Transaction::where('users_id', $id)->first();
    
        $transaction->transactionDetail()->delete();
        $transaction->delete();
        $item->transaction()->delete();
    
        $result =  $item->delete();


        if ($result != null) {
            return redirect()->route('user.index')->with('sukses',' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('user.index')->with('error',' Data Gagal di Hapus!');
        }
    }
}
