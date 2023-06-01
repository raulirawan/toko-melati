<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('users_id',Auth::user()->id);


        $all = $transactions->count();
        $pending = $transactions->where('status_transaksi','PENDING')->count();
        $sukses = $transactions->where('status_transaksi','SUCCESS')->count();
        $gagal = $transactions->where('status_transaksi','FAILED')->count();


        return view('pages.user.dashboard',compact('all','pending','sukses','gagal'));
    }
}
