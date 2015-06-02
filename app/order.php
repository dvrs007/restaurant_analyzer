<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model {

    protected $table = "orders";
    //orders: table name in the database(.env file)
    //binding to table called orders
    //order objects bind to this table
    //protected $primaryKey= "id";//customize the default setting of the primary key 
    public $timestamps = false; //from method 1 in the cdcontroller
    protected $created_at = 'datetime';
    protected $updated_at= 'datetime';
    protected $fillable = ['tbl_number', 'server'];

    //from method2 in the recipecontroller
    //modify the default setting in the model.php 
    //vendor/laravel/framework/src/Illuminate/database/Eloquent/model.php

    //public function setOrderedAtAttribute($date) {
    //    $this->attribute['datetime'] =Carbon::createFromFormat('Y-m-d', $date);
    //}

}
