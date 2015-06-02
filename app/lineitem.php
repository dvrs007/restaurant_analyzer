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
    protected $fillable = ['item_id','ordered_quantity']; 
    
}
