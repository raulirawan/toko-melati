<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
    
        $transactions = Transaction::all();

        $pending = $transactions->where('status_transaksi','PENDING')->count();
        $sukses = $transactions->where('status_transaksi','SUCCESS')->count();
        $gagal = $transactions->where('status_transaksi','FAILED')->count();
        $dibayar = $transactions->where('status_transaksi','DIBAYAR')->count();

        return view('pages.admin.dashboard',compact('transactions','pending','sukses','gagal','dibayar'));
    }


    
}
