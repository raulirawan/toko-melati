<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'ukuran_id','categories_id','nama','slug','deskripsi','stok','harga','shopee','tokped'
    ];


    protected $hidden = [
       
    ];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class,'products_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id','id');
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class,'ukuran_id','id');
    }
}
