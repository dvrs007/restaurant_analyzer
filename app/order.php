<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author SuzieQ
 */
class order extends Model{
    protected $table= "items" ;
    //recipe: table name in the database(.env file)
    //binding to table called recipes
    //recipe objects bind to this table
    
    //protected $primaryKey= "id";//customize the default setting of the primary key 
    public $timestamps =false; //from method 1 in the cdcontroller
    protected $fillable = ['item_name','item_price','item_cost']; 
    //from method2 in the recipecontroller
            
    //modify the default setting in the model.php 
    //vendor/laravel/framework/src/Illuminate/database/Eloquent/model.php
}
