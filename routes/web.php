<?php

use App\Transaction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/tes', function(){

    return view('pages.success');
});

Route::get('/','HomeController@index')->name('home');

Route::get('kategori/{slug}','CategoryController@category')->name('category.slug');

Route::get('/detail/{slug}','ProductController@detail')->name('product.detail');


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['admin','auth'])
    ->group(function () {
        Route::get('/','DashboardController@index')->name('dashboard.admin');
        
        Route::resource('/user', 'UserController');
        Route::resource('/kategori','CategoryController');
        Route::resource('/produk','ProductController');
        Route::resource('/ukuran','UkuranController');

        Route::post('/produk/upload/gambar','ProductController@uploadGallery')->name('upload.gambar');
        Route::get('/produk/upload/hapus/{id}','ProductController@deleteGallery')->name('hapus.gambar');
        
        Route::get('/rincian-order/{id}', 'TransactionController@rincianOrder')->name('rincian.order');
        Route::get('/detail-order/{id}', 'TransactionController@orderDetail')->name('order.detail');
        Route::put('/update/transaksi/{id}', 'TransactionController@updateTransaksi')->name('update.transaksi');
        
        Route::get('/export/transaksi', 'TransactionController@export')->name('export.transaksi');
    
    });

Route::middleware(['auth'])
        ->group(function () {
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        Route::get('/transaksi/rincian-order/{id}', 'TransactionController@rincianOrder')->name('rincian.order.user');


        Route::get('/transaksi','TransactionController@index')->name('transaksi.user.index');

        Route::put('/upload/bukti-transfer/{id}','TransactionController@uploadBuktiTransfer')->name('upload.bukti');

        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::put('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
        
        Route::post('/profile/update/password','ProfileController@changePassword')->name('change.password');    

        Route::post('/tambah-keranjang/{id}','ProductController@addToCart')->name('add.to.cart');
        Route::post('/tambah-keranjang/instan/{id}','ProductController@addToCartInstant')->name('add.to.cart.instant');
        Route::delete('/hapus-keranjang/{id}','ProductController@deleteCart')->name('delete.cart');

        Route::post('/checkout','ProductController@checkout')->name('checkout');
    });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
