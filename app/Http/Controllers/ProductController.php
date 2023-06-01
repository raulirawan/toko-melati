<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('pages.product-detail',compact('product'));
    }

    public function addToCart(Request $request, $id)
    {

        $this->validate($request, [
            'qty' => 'required',
        ]);

        $product = Product::findOrFail($id);


        $data = [
            'users_id'      => Auth::user()->id,
            'products_id'   => $id,
            'qty'           => $request->qty,
            'ukuran'           => $request->ukuran,
        ];


       if($product->stok >= $request->qty) {
            // $result = Cart::create($data);
            $cart = Cart::where('users_id', Auth::user()->id)
            ->where('products_id', $id);
            
            if($cart->exists()) {
                $dataCart = $cart->first();
                $dataCart->qty += $request->qty;
                $result = $dataCart->save();

                return redirect()->route('product.detail', $product->slug)->with('sukses','Data Berhasil di Tambah Ke Keranjang!');
            } else {
                 $result = Cart::create($data); 
            } 
        } else {
            return redirect()->route('product.detail', $product->slug)->with('error','Stok Barang Tidak Cukup!, Coba Lagi!');
        }

       if ($result != null) {
        return redirect()->route('product.detail', $product->slug)->with('sukses','Data Berhasil di Tambah Ke Keranjang!');
        } else {
        return redirect()->route('product.detail', $product->slug)->with('error','Data Gagal di Tambah Ke Keranjang!');
        }
        
    }

    public function addToCartInstant(Request $request, $id)
    {

        $this->validate($request, [
            'qty' => 'required',
        ]);

        $product = Product::findOrFail($id);


        $data = [
            'users_id'      => Auth::user()->id,
            'products_id'   => $id,
            'qty'           => $request->qty,
        ];


       if($product->stok >= $request->qty) {

            $cart = Cart::where('users_id', Auth::user()->id)
                             ->where('products_id', $id);
                            
            if($cart->exists()) {
                $dataCart = $cart->first();
                $dataCart->qty += $request->qty;
                $result = $dataCart->save();

                return redirect()->route('home')->with('sukses','Data Berhasil di Tambah Ke Keranjang!');

            } else {
                $result = Cart::create($data); 
            }

        } else {
            return redirect()->route('home')->with('error','Stok Barang Tidak Cukup!, Coba Lagi!');
        }
        

       if ($result != null) {
        return redirect()->route('home')->with('sukses','Data Berhasil di Tambah Ke Keranjang!');
        } else {
        return redirect()->route('home')->with('error','Data Gagal di Tambah Ke Keranjang!');
        }
       
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->back();

    }

    public function checkout(Request $request)
    {

        $carts = Cart::where('users_id', Auth::user()->id)->get();
        $code = 'M-' . mt_rand(0000,9999);

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id, 
            'kode' => $code,
            'total_pengiriman' => 10000,
            'status_transaksi' => 'PENDING',
            'total_harga'   => $request->total_harga,
            'bank'          => $request->bank,
        ]);

        
        foreach ($carts as $cart) {
            $ukuran = $cart->ukuran;
            $qty = $cart->qty;
            $price = $cart->product->harga;

            $harga = $price * $qty;

           TransactionDetail::create([
           'transactions_id'       => $transaction->id,
           'products_id'           => $cart->product->id,
           'harga'                 => $harga,
           'qty'                   => $qty,
           'ukuran'                => $ukuran,
       ]);
    }


       Cart::where('users_id', Auth::user()->id)
       ->delete();

       if ($transaction != null) {
        return view('pages.success');
        }
    }
}
