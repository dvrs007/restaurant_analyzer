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
        return view('menus.index')->with("items", $items);
    }

    //INSERT
    public function create() {
        return view('menus.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'item_name' => 'required|min:3',
            'item_price' => 'required|numeric|min:0.00',
            'item_cost' => 'required|numeric|min:0.00'
                ]
        );

        //insert a data into database
        //1, get the request...what were sent using post
        //line 8 added
        //$inputs = Request::all();
        //STEP1: Fetch the inputs(fetch all of the input from create)
        $inputs = $request->all(); //added after validation added
        //STEP2: Create a recipe and saved it into db        
        Item::create($inputs);

        //STEP3: Redierect
        return Redirect('menus');
    }

    //SHOW
    public function show($id){
        //get a single detail
        $item=Item::find($id); //helper method to find item with id
               
        return view('menus.show')->with('item',$item);
    }   
    //UPDATE
    public function edit($id) {
        $item = Item::find($id);
        //$item = Item::where('id' , '=', $id);

        return view('menus.edit')->with('item', $item);
    }

    public function update(Request $request) {
       
        $this->validate($request, [
            'item_name' => 'required|min:3',
            'item_price' => 'required|decimal',
            'item_cost' => 'required|decimal'
                ]
        );
        
        //STEP1: Fetch the inputs
        //$inputs =  $request -> all(); //added after validation added
        $inputs = array(
            'item_name' => $request['item_name'],
            'item_price' => $request['item_price'],
            'item_cost' => $request['item_cost']
        );

        //STEP2: Store         
        //Recipe::find($request['dish_id'])->update($inputs);
        Item::where('id', $request['id'])->update($inputs);
        //helper method to find recipe with id
        return Redirect('menus');
    }


    public function deleteButton(Request $request) {
        Item::where('id', $request['id'])->delete();
        return Redirect('menus');
    }

}
