<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name','shipping_address','price','total','order_number'];
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function orders(){
        return $this->belongsTo(Order::class, 'order_number','id');
    }
}
