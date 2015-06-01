<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use Illuminate\Http\Request;  //changed it after adding validation

/**
 * Description of jeesooController
 *
 * @author SuzieQ
 */
class jeesooController extends Controller{
    public function index() {
        $items = Order::all();
        $orders =Order::all();
        //dd($orders);
        //return "orders";
        //dd($items);
        //return "items";

        return view('jeesoo.index')->with("orders", $orders);
    }
}
