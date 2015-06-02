<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class item extends Model{
    protected $table= "items" ;
    protected $fillable = ['item_name','item_price','item_cost']; 
    public $timestamps =false; //from method 1 in the cdcontroller
}
