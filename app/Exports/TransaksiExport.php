<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class TransaksiExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Transaction::query()->where('status_transaksi','SUCCESS');
        
    }

    public function map($transaction): array
    {
        return [
            Carbon::parse($transaction->created_at)->format('d-m-Y'),
            $transaction->kode,
            $transaction->user->name,
            $transaction->total_harga,
            $transaction->status_transaksi,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Transaksi',
            'Nama Customer',
            'Total Harga',
            'Status Transaksi'
        ];
    }
}