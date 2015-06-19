<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class order extends Model {

    protected $table = "orders";
    //orders: table name in the database(.env file)
    //binding to table called orders
    //order objects bind to this table
    protected $primaryKey= "order_id";//customize the default setting of the primary key 
    public $timestamps = false; //from method 1 in the cdcontroller
    protected $created_at = 'time_stamp';
    protected $updated_at= 'time_stamp';
    protected $fillable = ['tbl_number', 'server','order_date','order_time','subtotal','tax','total','order_complete','expenses'];

    //from method2 in the recipecontroller
    //modify the default setting in the model.php 
    //vendor/laravel/framework/src/Illuminate/database/Eloquent/model.php

    //public function setOrderedAtAttribute($date) {
    //    $this->attribute['datetime'] =Carbon::createFromFormat('Y-m-d', $date);
    //}

}
