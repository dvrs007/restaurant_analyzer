<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of lineitem
 *
 * @author SuzieQ
 */
class lineitem extends Model{
    protected $table= "lineitems" ;
    protected $fillable = ['order_id','item_id','ordered_quantity']; 
    //put your code here
}
