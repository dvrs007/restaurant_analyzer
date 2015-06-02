<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of item
 *
 * @author SuzieQ
 */
class item extends Model{
    protected $table= "items" ;
    protected $fillable = ['item_name','item_price','item_cost']; 
    //protected $primaryKey= "dish_id";//customize the default setting of the primary key 
    //public $timestamps =false; //from method 1 in the cdcontroller
}
