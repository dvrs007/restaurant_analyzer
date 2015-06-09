<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
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

    //put your code here


    public function index() {
        $orders = DB::table('orders')->orderBy('id', 'desc')->get();
        //$orders = Order::all();
        //dd($items);
        //return "items";

        return view('orders.index')->with("orders", $orders);
    }

    public function show($orderID) {
        //get a single detail
        $order = Order::find($orderID); //helper method to find recipe with id
        //$recipe=Recipe::where('dish_name' , '=', 'sausage');
        $lineitems = Lineitem::where('order_id', '=', $orderID);

        $results = DB::table('orders')
                ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->where('orders.id', '=', $orderID)
                ->get();



        return view('orders.show')->with('order', $order)
                        ->with('lineitems', $lineitems)
                        ->with('results', $results);
    }

    public function create() {
        return view('orders.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'tbl_number' => 'required|Integer',
            'server' => 'required'
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

//    public function items($orderID) {
//        //parameter: orderid
//        $order = Order::find($orderID);
//        $items = Item::all();
//
//
//
//        return view('orders.items')->with("items", $items)
//                        ->with("order", $order);
//    }



    public function chooseItem($orderID) {
        //parameter: orderid
        $order = Order::find($orderID);
        $items = Item::all();
        $lineitems = Lineitem::all();
        $results = DB::table('orders')
                ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->where('orders.id', '=', $orderID)
                ->get();

        return view('orders.chooseItem')->with("items", $items)
                        ->with("order", $order)
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

        DB::update('UPDATE orders o SET o.expenses= 1.13*(SELECT SUM( i.item_cost * l.ordered_quantity) FROM lineitems l JOIN items i ON i.id=l.item_id WHERE o.id=l.order_id GROUP BY o.id)');
        DB::update('UPDATE orders o SET o.subtotal = (SELECT SUM( i.item_price * l.ordered_quantity) FROM lineitems l JOIN items i ON i.id=l.item_id WHERE o.id=l.order_id GROUP BY o.id)');
        DB::update('UPDATE orders SET tax=subtotal*0.13, total=subtotal+tax');
        /*         * ******************************************* */
        $order_complete = $request['order_complete'];
        
        DB::table('orders')
                ->where('id', $request['order_id'])
                ->update(array('order_complete' => $order_complete));

        return Redirect('orders');
    }

    /*
      //update

      public function edit($id) {
      $recipe = Recipe::find($id);
      //$recipe = Recipe::where('dish_id' , '=', $id);

      return view('recipes.edit')->with('recipe', $recipe);
      }


      public function update(Request $request) {
      //this is for update
      //get a single detail

      $this->validate($request, [
      'dish_name' => 'required|min:10',
      'dish_ingredients' => 'required',
      'dish_steps' => 'required'
      //'dish_steps' => 'required|Integer'
      ]
      );

      //STEP1: Fetch the inputs
      //$inputs =  $request -> all(); //added after validation added
      $inputs = array(
      'dish_name' => $request['dish_name'],
      'dish_ingredients' => $request['dish_ingredients'],
      'dish_steps' => $request['dish_steps']
      );

      //STEP2: Store
      //Recipe::find($request['dish_id'])->update($inputs);
      Recipe::where('dish_id', $request['dish_id'])->update($inputs);
      //helper method to find recipe with id
      //return view('recipes.recipe')->with('recipe',$recipe);
      return Redirect('recipes');
      }

      public function deleteLink($id) {
      Recipe::where('dish_id', $id)->delete();
      return Redirect('recipes');
      }

      public function deleteButton(Request $request) {
      Recipe::where('dish_id', $request['dish_id'])->delete();
      return Redirect('recipes');
      }
     */
}

//end of class
?>