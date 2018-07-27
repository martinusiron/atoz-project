<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id','user_id','description', 'status', 'shipping_code', 'pay_date'];
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    CONST SUCCESS = "Success";
    CONST CANCELLED = "Cancelled";
    CONST FAILED = "Failed";
    CONST PAID = "Paid";
    CONST UNPAID = "Unpaid";


    function product(){
        return $this->hasOne(Product::class, 'order_number', 'id');
    }

    function prepaid(){
        return $this->hasOne(Prepaid::class, 'order_number','id');
    }
}
