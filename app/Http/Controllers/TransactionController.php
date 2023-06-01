<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::where('users_id', Auth::user()->id)->get();

        return view('pages.user.transaction.index', compact('transaction'));

    }

    public function rincianOrder($id)
    {
        $transaction = Transaction::findOrFail($id);


        $totalPengiriman    = $transaction->total_pengiriman;
        $total              = $transaction->total_harga + $totalPengiriman;



        $order = TransactionDetail::where('transactions_id', $id);

        $orderDetail = $order->get();
        $subTotal = $order->get()->sum('harga');


        return view('pages.user.transaction-detail.index', compact('orderDetail','subTotal','total','totalPengiriman','transaction'));
    }

    public function uploadBuktiTransfer (Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $this->validate($request, [
            'bukti_transfer'                  => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('bukti_transfer')) {
            $transaction->bukti_transfer = $request->file('bukti_transfer')->store('assets/bukti-transfer', 'public');
            $transaction->status_transaksi = 'DIBAYAR';
            $transaction->save();
            return redirect()->route('rincian.order.user', $transaction->id)->with('sukses','Bukti Transfer Berhasil di Upload!');
        } else {
            return redirect()->route('rincian.order.user', $transaction->id)->with('error','Bukti Transfer Gagal di Upload');

        }
        
    }
}
