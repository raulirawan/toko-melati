<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id','kode','total_harga','status_transaksi','bukti_transfer','total_pengiriman','bank'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id','id');
    }
    
    protected $dates = [
        'created_at'  
    ];
}
