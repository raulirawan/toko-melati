<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
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
            'nama' => 'required|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);


        $result = Category::create($data);

        if ($result != null) {
            return redirect()->route('kategori.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('kategori.index')->with('error',' Data Gagal di Simpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $item = Category::findOrFail($id);

        $result = $item->update($data);

        if ($result != null) {
            return redirect()->route('kategori.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('kategori.index')->with('error',' Data Gagal di Simpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);

        $item->product()->delete();

        $result = $item->delete();

        if ($result != null) {
            return redirect()->route('kategori.index')->with('sukses',' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('kategori.index')->with('error',' Data Gagal di Hapus!');
        }
    }
}
