<?php

namespace App\Http\Controllers\Admin;

use App\Ukuran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UkuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukuran = Ukuran::all();
        return view('pages.admin.ukuran.index', compact('ukuran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.ukuran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $result = Ukuran::create($data);

        if ($result != null) {
            return redirect()->route('ukuran.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('ukuran.index')->with('error',' Data Gagal di Simpan!');
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
        $item = Ukuran::findOrFail($id);

        return view('pages.admin.ukuran.detail', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Ukuran::findOrFail($id);

        return view('pages.admin.ukuran.edit', compact('item'));
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
        $data = $request->all();

        $item = Ukuran::findOrFail($id);

        $result = $item->update($data);

        if ($result != null) {
            return redirect()->route('ukuran.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('ukuran.index')->with('error',' Data Gagal di Simpan!');
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
        //
    }
}
