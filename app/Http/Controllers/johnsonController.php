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

        $sales = \Lava::DataTable();
        
        foreach($results as $value){
        $sales->addStringColumn('Sales')
            ->addNumberColumn('Percent')
            ->addRow(array($value->item_name, $value->item_price-$value->item_cost));
        }
        
        $piechart = \Lava::PieChart('TotalSales')
                 ->setOptions(array(
                   'datatable' => $sales,
                   'title' => 'Total sales of each item',
                   'is3D' => true
                  ));

            
            return view('johnson.index')->with('order',$results)->with('itemcount', $itemcount);
            return view('johnson.index')->with('piechart',$piechart);
            
	}
    }



