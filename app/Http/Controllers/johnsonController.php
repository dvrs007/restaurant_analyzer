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
            
        //query with raw mysql
            $itemz = DB::select( DB::raw("SELECT DISTINCT item_name, SUM( ordered_quantity ) AS orderedQuantity, (item_price-item_cost)*SUM(ordered_quantity) as net_revenue
                FROM items
                INNER JOIN lineitems ON items.id = lineitems.item_id
                INNER JOIN orders ON lineitems.order_id = orders.id
                GROUP BY item_name") );
        
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

        //set the data for the piechart
            $sales = \Lava::DataTable();

            foreach($itemz as $value)
            {
            $sales->addDateColumn('Date')
             ->addNumberColumn('Max Temp')
             ->addNumberColumn('Mean Temp')
             ->addNumberColumn('Min Temp')
             ->addRow(array('2014-10-1', 67, 65, 62))
             ->addRow(array('2014-10-2', 68, 65, 61))
             ->addRow(array('2014-10-3', 68, 62, 55))
             ->addRow(array('2014-10-4', 72, 62, 52))
             ->addRow(array('2014-10-5', 61, 54, 47))
             ->addRow(array('2014-10-6', 70, 58, 45))
             ->addRow(array('2014-10-7', 74, 70, 65))
             ->addRow(array('2014-10-8', 75, 69, 62))
             ->addRow(array('2014-10-9', 69, 63, 56))
             ->addRow(array('2014-10-10', 64, 58, 52))
             ->addRow(array('2014-10-11', 59, 55, 50))
             ->addRow(array('2014-10-12', 65, 56, 46))
             ->addRow(array('2014-10-13', 66, 56, 46))
             ->addRow(array('2014-10-14', 75, 70, 64))
             ->addRow(array('2014-10-15', 76, 72, 68))
             ->addRow(array('2014-10-16', 71, 66, 60))
             ->addRow(array('2014-10-17', 72, 66, 60))
             ->addRow(array('2014-10-18', 63, 62, 62));
            }

            $linechart = \Lava::LineChart('Temps')
                  ->dataTable($sales)
                  ->title('Weather in October');

            
            return view('johnson.index')
                    ->with('results',$results)
                    ->with('itemcount', $itemcount)
                    ->with('itemOrders', $itemOrders)
                    ->with('totalGen', $totalGen)
                    ->with('linechart',$linechart);
            
	}
    }



