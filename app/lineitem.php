<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class lineitem extends Model{
    protected $table= "lineitems" ;
    protected $fillable = ['order_id', 'item_id','ordered_quantity']; 
    public $timestamps = false;
    
}
