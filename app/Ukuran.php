<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $table = 'ukuran';

    protected $fillable = [
        'nama_ukuran','ukuran1','ukuran2','ukuran3','ukuran4','ukuran5'
        ,'ukuran6','ukuran7','ukuran8','ukuran9','ukuran10'
    ];


    protected $hidden = [
       
    ];
}
