<?php namespace App\Http\Controllers;

use App\Item;
use DB;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            //query with raw mysql for highest net revenue
            //query highest grossing item
            $highest_gross_item = DB::select( DB::raw("SELECT DISTINCT item_name, img_path, (
                                                        item_price - item_cost
                                                        ) * SUM( ordered_quantity ) AS net_revenue
                                                        FROM items
                                                        INNER JOIN lineitems ON items.id = lineitems.item_id
                                                        INNER JOIN orders ON lineitems.order_id = orders.order_id
                                                        GROUP BY item_name
                                                        ORDER BY net_revenue
                                                        DESC
                                                        LIMIT 1") );
            foreach($highest_gross_item as $key)
            {
                //convert the datatype to string for this column
                $high_gross_item = ($key->item_name);
                $high_gross_item_img = ($key->img_path);
            }
            
            
		return view('welcome')
                        ->with('high_gross_item', $high_gross_item)
                        ->with('high_gross_item_img', $high_gross_item_img);
	}

}
