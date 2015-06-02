<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
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
        $orders = Order::all();
        //dd($items);
        //return "items";

        return view('orders.index')->with("orders", $orders);
    }
/*
    public function show($id) {
        //get a single detail
        $recipe = Recipe::find($id); //helper method to find recipe with id
        //$recipe=Recipe::where('dish_name' , '=', 'sausage');

        return view('recipes.show')->with('recipe', $recipe);
    }
*/
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
        return Redirect('orders/choose');
    }
    
    
    public function choose(){
        $items = Item::all();        
        
        return view('orders.choose')->with("items", $items);
    }
    
    public function itemStore(){
        $inputs = Request::all();
        Lineitem::create($inputs);
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