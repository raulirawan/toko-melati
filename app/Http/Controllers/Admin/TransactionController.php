<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransaksiExport;
use App\Product;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function rincianOrder($id)
    {
        $transaction = Transaction::findOrFail($id);


        $totalPengiriman    = $transaction->total_pengiriman;
        $total              = $transaction->total_harga + $totalPengiriman;


        $order = TransactionDetail::where('transactions_id', $id);

        $orderDetail = $order->get();
        $subTotal = $order->get()->sum('harga');


        return view('pages.admin.transaction-detail.index', compact('orderDetail','subTotal','total','totalPengiriman','transaction'));
    }

    public function updateTransaksi(Request $request, $id)
    {
        $this->validate($request, [
            'status_transaksi'         => 'required',
        ]);

        $data = [
            'status_transaksi' => $request->status_transaksi,
        ];

        $item = Transaction::findOrFail($id);

        $result = $item->update($data);

        $detailTransaksi = TransactionDetail::where('transactions_id', $item->id)->get();

        if($request->status_transaksi == 'SUCCESS') {
            
            foreach ($detailTransaksi as $detail) {

                $qty = $detail->qty;


                $produk = Product::findOrFail($detail->product->id);

                $produk->stok -= $qty;

                $produk->save();

            }

        }

        if ($result != null) {
            return redirect()->route('rincian.order', $item->id)->with('sukses',' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('rincian.order', $item->id)->with('error',' Data Gagal di Simpan!');
        }

    }

    public function export()
    {
        return Excel::download(new TransaksiExport, 'laporan-transaksi.xlsx');
    }

   
}
