<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nama','slug'
    ];


    protected $hidden = [
       
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'categories_id','id');
    }
}
