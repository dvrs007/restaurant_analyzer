<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class lineitem extends Model{
    protected $table= "lineitems" ;
    protected $fillable = ['item_id','ordered_quantity']; 
    
}
