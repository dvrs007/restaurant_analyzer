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
            ->distinct('items.item_name')->get();
        
        //get the count of current servers
            $itemcount = DB::table('items')
                    ->distinct()
                    ->count('item_name');
        //get the count of total items ordered
            $itemOrders = DB::table('lineitems')
                    ->distinct()
                    ->sum('lineitems.ordered_quantity');
        //get the total $ generated
            $totalGen = DB::table('orders')
                    ->distinct()
                    ->sum('orders.total');
            //var_dump($itemcount);
            //$item= item::all();

        //set the data for the chart
            $sales = \Lava::DataTable();

            $sales->addStringColumn('Item Name')
            ->addNumberColumn('Ordered Quantity');
            //->addNumberColumn('Official');

            
            foreach($results as $value)
            {
                $rowData = array(
                  $value->item_name, $value->ordered_quantity
                );
                $sales->addRow($rowData);
            }
            
            //decide on the chart type to use
            $barchart = \Lava::BarChart('MostOrdered');

                $barchart->datatable($sales);

            
            return view('johnson.index')
                    ->with('results',$results)
                    ->with('itemcount', $itemcount)
                    ->with('itemOrders', $itemOrders)
                    ->with('totalGen', $totalGen)
                    ->with('barchart',$barchart);
            
	}
    }



