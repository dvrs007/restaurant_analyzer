<?php namespace App\Http\Controllers;

use App\Order;
use App\Item;
use App\Lineitem;
use DB;
use Khill\Lavacharts\Lavacharts;

class johnsonController extends Controller {
	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
            
        //get the tables, joined, all the orders, items, and item quantities
            $results = DB::table('orders')
            ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
            ->join('items', 'lineitems.item_id', '=', 'items.id')
                    ->groupBy('lineitems.order_id')
            ->get();
        
        //get the count of current servers
            $itemcount = DB::table('items')
                    ->distinct()->count('item_name');
            
            //var_dump($itemcount);
            
            $orders= order::all();

        //set the data for the chart
            $sales = \Lava::DataTable();

            $sales->addStringColumn('Server Name')
            ->addNumberColumn('Subtotal');
            //->addNumberColumn('Official');

            // Random Data For Example
            foreach($orders as $value)
            {
                $rowData = array(
                  $value->item_name, $value->ordered_quantity
                );

                $sales->addRow($rowData);
            }
            
            
            
            //decide on the chart type to use
            $barchart = \Lava::BarChart('MostOrdered');

                $barchart->datatable($sales);

            
            return view('johnson.index')->with('results',$results)->with('itemcount', $itemcount);
            return view('johnson.index')->with('barchart',$barchart);
            
	}
    }



