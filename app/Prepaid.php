<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prepaid extends Model
{
    protected $fillable = ['id','mobile_phone_number','value','total','order_number','status','created_date','modified_date'];
    protected $table = 'prepaids';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function orders(){
        return $this->belongsTo(Order::class, 'order_number','id');
    }
}
