<?php

namespace App\Http\Controllers\Admin;

use App\Ukuran;
use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $ukuran = Ukuran::all();

        return view('pages.admin.product.create', compact('category','ukuran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'categories_id'         => 'required|exists:categories,id',
            'nama'                  => 'required|string',
            'deskripsi'             => 'required',
            'stok'                  => 'required|numeric',
            'harga'                  => 'required|numeric',
            'shopee'                  => 'required|string',
            'tokped'                  => 'required|string',
            'photos'                => 'required',
            'photos.*'              => 'required|image|mimes:jpeg,png,jpg',
        ]);


        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $result = Product::create($data);


        $dataPhoto['products_id'] = $result->id;

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            foreach ($photos as $photo) {
                $dataPhoto['photos'] = $photo->store('assets/produk', 'public');
                $result = ProductGallery::create($dataPhoto);
            }
        }

        if ($result != null) {
            return redirect()->route('produk.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produk.index')->with('error',' Data Gagal di Simpan!');
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
        $product = Product::findOrFail($id);

        $category = Category::all();

        return view('pages.admin.product.edit', compact('product','category'));
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
        $this->validate($request, [
            'categories_id'         => 'required|exists:categories,id',
            'nama'                  => 'required|string',
            'deskripsi'             => 'required',
            'stok'                  => 'required|numeric',
            'harga'                  => 'required|numeric',
            'shopee'                  => 'required|string',
            'tokped'                  => 'required|string',
        ]);


        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $item = Product::findOrFail($id);

        $result = $item->update($data);

        if ($result != null) {
            return redirect()->route('produk.index')->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produk.index')->with('error',' Data Gagal di Simpan!');
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
        $product = Product::findOrFail($id);

        $product->galleries()->delete();

        $result = $product->delete();

        if ($result != null) {
            return redirect()->route('produk.index')->with('sukses',' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('produk.index')->with('error',' Data Gagal di Hapus!');
        }
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/produk', 'public');

        $result = ProductGallery::create($data);

        if ($result != null) {
            return redirect()->route('produk.edit', $request->products_id)->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produk.edit', $request->products_id)->with('error',' Data Gagal di Simpan!');
        }

    }

    public function deleteGallery($id)
    {
        $item = ProductGallery::findOrFail($id);
        $result = $item->delete();

        if ($result != null) {
            return redirect()->route('produk.edit', $item->products_id)->with('sukses',' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('produk.edit', $item->products_id)->with('error',' Data Gagal di Hapus!');
        }
       
    }
}
