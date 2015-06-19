<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of server
 *
 * @author SuzieQ
 */
class server extends Model {
    protected $table= "servers" ;
    protected $fillable = ['server_firstname','server_lastname','server_pic']; 
    public $timestamps =false; //from method 1 in the cdcontroller
}
