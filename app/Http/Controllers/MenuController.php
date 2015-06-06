<?php
namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
use DB;
use Illuminate\Http\Request;  //changed it after adding validation
/**
 * Description of MenuController
 *
 * @author SuzieQ
 */
class MenuController extends Controller {
    
    public function index() {
        $items = Item::all();
        //dd($items);
        //return "items";

        return view('menus.index')->with("items", $items);
    }
    
}
