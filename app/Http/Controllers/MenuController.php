<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
use DB;
use Illuminate\Http\Request;  //changed it after adding validation
use Input;
use Validator;
use Redirect;
use Session;

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

    public function indexAdmin() {
        $items = Item::all();
        return view('menus.index_admin')->with("items", $items);
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


        $inputs = $request->all(); //added after validation added   
        //
        
        /*         * ********* FILE UPLOAD *************** */
        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('menus/create')->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'images/items'; // upload path                
                $name = Input::file('image')->getClientOriginalName(); //*Getting original name of uploaded file :-
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = $name . '.'; //. $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                //
                $path = Input::file('image')->getRealPath(); //Getting path of uploaded file :-
                $pos = strpos($path, '/public/');
                if ($pos !== false) {
                    $path = substr($path, $pos + 1);
                }
                //$inputs['file'] = $path;
                // sending back with message
                //Session::flash('success', 'Upload successfully');
                //method1    ****************************************/   
                $item = new Item; /*                 * ******************************* */
                $item->item_name = $inputs['item_name']; /*                 * ******** */
                $item->item_price = $inputs['item_price']; /*                 * ****** */
                $item->item_cost = $inputs['item_cost']; /*                 * ******** */
                $item->img_path = 'images/items/' . $name; /*                 * *********** */

                $item->save();  /*                 * ********************************* */

                return Redirect::to('menus'); /*                 * ******************* */
                //***************************************************/ 
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('menus/create');
            }
        }/*         * ********* FILE UPLOAD *************** */


        //Item::create($inputs);
        //STEP3: Redierect
        //return Redirect('menus');
    }

    //SHOW
    public function show($id) {
        //get a single detail
        $item = Item::find($id); //helper method to find item with id
        $cnt_item = $item->count();

        return view('menus.show')->with('item', $item)
                        ->with('cnt_item', $cnt_item);
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
            'item_price' => 'required|numeric|min:0.00',
            'item_cost' => 'required|numeric|min:0.00'
                ]
        );

        //image file update!!!
        /*         * ********* FILE UPLOAD *************** */
        if ($request->hasFile('image')) {

            // getting all of the post data
            $file = array('image' => Input::file('image'));
            // setting up rules
            $rules = array(); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('menus/create')->withInput()->withErrors($validator);
            } else {
                // checking file is valid.
                if (Input::file('image')->isValid()) {
                    $destinationPath = 'images/items'; // upload path                
                    $name = Input::file('image')->getClientOriginalName(); //*Getting original name of uploaded file :-
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = $name . '.'; //. $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                    $path = Input::file('image')->getRealPath(); //Getting path of uploaded file :-
                    $pos = strpos($path, '/public/');
                    if ($pos !== false) {
                        $path = substr($path, $pos + 1);
                    }
                    //$inputs['file'] = $path;
                    // sending back with message
                    //Session::flash('success', 'Upload successfully');
                    //STEP1: Fetch the inputs
                    //$inputs =  $request -> all(); //added after validation added
                    $inputs = array(
                        'item_name' => $request['item_name'],
                        'item_price' => $request['item_price'],
                        'item_cost' => $request['item_cost'],
                        'img_path' => 'images/items/' . $name
                    );

                    //STEP2: Store         
                    //Recipe::find($request['dish_id'])->update($inputs);
                    Item::where('id', $request['id'])->update($inputs);
                    //helper method to find recipe with id
                    return Redirect::to('menus/' . $request['id'] . '/edit');
                    //***************************************************/ 
                } else {
                    // sending back with error message.
                    Session::flash('error', 'uploaded file is not valid');
                    return Redirect::to('menus/create');
                }
            }/*             * ********* FILE UPLOAD *************** */
        } else {//if (Input::file('image')->hasFile() == NULL) {
            $inputs = array(
                'item_name' => $request['item_name'],
                'item_price' => $request['item_price'],
                'item_cost' => $request['item_cost']
            );

            Item::where('id', $request['id'])->update($inputs);
            //helper method to find recipe with id
            return Redirect::to('menus/' . $request['id'] . '/edit');
        }
    }

    public function deleteButton(Request $request) {
        Item::where('id', $request['id'])->delete();
        return Redirect('menus');
    }

    public function deleteLink($id) {
        Item::where('id', $id)->delete();
        return Redirect('menus');
    }

}
