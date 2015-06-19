<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
use App\Server;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;  //changed it after adding validation

//use Request; //object capture request

/**
 * Description of RecipeControler
 *
 * @author SuzieQ
 */
class OrderController extends Controller {

    public function index() {
        $orders = DB::table('orders')->orderBy('order_id', 'desc')->get();
        $results = DB::table('orders')
                ->join('servers', 'orders.server', '=', 'servers.id')
                ->orderBy('orders.order_id', 'desc')
                ->get();
//$orders = Order::all();

        return view('orders.index')->with("orders", $orders)
                        ->with('results', $results);
    }

    public function show($orderID) {
//get a single detail
        $order = Order::find($orderID); //helper method to find recipe with id
        $server = Server::find($order->server);
        $lineitems = Lineitem::where('order_id', '=', $orderID);

        $results = DB::table('orders')
                ->join('lineitems', 'orders.order_id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->where('orders.order_id', '=', $orderID)
                ->get();
        return view('orders.show')->with('order', $order)
                        ->with('lineitems', $lineitems)
                        ->with('server', $server)
                        ->with('results', $results);
    }

    public function create() {
        $servers = Server::lists('server_firstname', 'id');
        return view('orders.create')->with('servers', $servers);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'tbl_number' => 'required|Integer',
            'server' => 'required',
            'order_date' => 'required|date_format:"Y-m-d"'
                ]
        );

//insert a data into database
//1, get the request...what were sent using post
//line 8 added
//$inputs = Request::all();
//STEP1: Fetch the inputs(fetch all of the input from create)
        $inputs = $request->all(); //added after validation added
//STEP2: Create an order and saved it into db
//method1       
//$order = new Order;
//$order->tbl_nummber = $inputs['tbl_number'];
//$order->server = $inputs['server'];   
//method2
        Order::create($inputs);


//return "recipe inserted";
//return $inputs;
//STEP3: Redierect
        return Redirect('orders');
    }

    public function chooseItem($orderID) {
//parameter: orderid
        $order = Order::find($orderID);
        $server = Server::find($order->server);
        $items = Item::all();
        $lineitems = Lineitem::all();
        $results = DB::table('orders')
                ->join('lineitems', 'orders.order_id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->where('orders.order_id', '=', $orderID)
                ->get();

        return view('orders.chooseItem')->with("items", $items)
                        ->with("order", $order)
                        ->with('server', $server)
                        ->with("lineitems", $lineitems)
                        ->with("results", $results);
    }

    public function itemStore(Request $request) {
//this function is to insert lineitems per an order into lineitems table
//$inputs = Request::all();
//Lineitem::create($inputs);
        $lineitem = new Lineitem;
        $lineitem->order_id = $request['order_id'];
        $lineitem->item_id = $request['item_id'];
        $lineitem->ordered_quantity = $request['ordered_quantity'];
        $lineitem->save();

        DB::update('UPDATE orders o SET o.expenses= 1.13*(SELECT SUM( i.item_cost * l.ordered_quantity) FROM lineitems l JOIN items i ON i.id=l.item_id WHERE o.order_id=l.order_id GROUP BY o.order_id)');
        DB::update('UPDATE orders o SET o.subtotal = (SELECT SUM( i.item_price * l.ordered_quantity) FROM lineitems l JOIN items i ON i.id=l.item_id WHERE o.order_id=l.order_id GROUP BY o.order_id)');
        DB::update('UPDATE orders SET tax=subtotal*0.13, total=subtotal+tax');
        /*         * ******************************************* */
        $order_complete = $request['order_complete'];

        DB::table('orders')
                ->where('order_id', $request['order_id'])
                ->update(array('order_complete' => $order_complete));

        return Redirect('orders');
    }

//Ver.2: adding/inserting lineitems per an order
//Files for this controller : items.blade.php
    public function addItems($orderID) {
        //parameter: orderid
        $order = Order::find($orderID);
        $server = Server::find($order->server);
        $items = Item::all();
        $lineitems = Lineitem::all();
        $results = DB::table('orders')
                ->join('lineitems', 'orders.order_id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->where('orders.order_id', '=', $orderID)
                ->get();



        return view('orders.items')->with("items", $items)
                        ->with("server", $server)
                        ->with("order", $order)
                        ->with("lineitems", $lineitems)
                        ->with("results", $results);
    }

    public function itemsAdd() {
        //to store/insert line items into lineitems table for an order

        if (isset($_POST["item_id"])) {

            $capture_field_vals1 = "";
            $capture_field_vals2 = "";
            foreach ($_POST["item_id"] as $key => $field1) {
                $capture_field_vals1 .= $field1 . ", ";
            }
            foreach ($_POST["ordered_quantity"] as $key => $field2) {
                $capture_field_vals2 .= $field2 . ";;;";
            }

            echo $capture_field_vals1;
            echo $capture_field_vals2;
        }
    }

    /*
      public function deleteLink($id) {
      Item::where('id', $id)->delete();
      return Redirect('items');
      }

      public function deleteButton(Request $request) {
      Item::where('id', $request['id'])->delete();
      return Redirect('items');
      }
     */
}

//end of class
?>