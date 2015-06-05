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
            
        //query with raw mysql for highest net revenue
            $net_revenue1 = DB::select( DB::raw("SELECT DISTINCT item_name, order_date, SUM( ordered_quantity ) AS orderedQuantity, (item_price-item_cost)*SUM(ordered_quantity) as net_revenue
                FROM items
                INNER JOIN lineitems ON items.id = lineitems.item_id
                INNER JOIN orders ON lineitems.order_id = orders.id
                GROUP BY item_name
                ORDER BY net_revenue DESC limit 10") );
        
        //set the data for the piechart
            $sales = \Lava::DataTable();
            
            $sales->addStringColumn('Item Name')
                    ->addNumberColumn('Net Revenue ($)');
            foreach($net_revenue1 as $value)
            {
                //convert datatype to string for this column
                $convert = floatval($value->net_revenue);
                $rowData = array($value->item_name, $convert);
                $sales->addRow($rowData);
            }
            
            $piechart = \Lava::PieChart('NetRevenue_highestNet')
                    ->setOptions(array(
                        'datatable' => $sales,
                        'title' => 'Top 10 Highest Net Revenue per Item ($)'
                    ));
            
        
        //query with raw mysql for lowest net revenue
            $net_revenue2 = DB::select( DB::raw("SELECT DISTINCT item_name, order_date, SUM( ordered_quantity ) AS orderedQuantity, (item_price-item_cost)*SUM(ordered_quantity) as net_revenue
                FROM items
                INNER JOIN lineitems ON items.id = lineitems.item_id
                INNER JOIN orders ON lineitems.order_id = orders.id
                GROUP BY item_name
                ORDER BY net_revenue limit 10") );
        
        //set the data for the piechart
            $sales_lowestNet = \Lava::DataTable();
            
            $sales_lowestNet->addStringColumn('Item Name')
                    ->addNumberColumn('Net Revenue ($)');
            foreach($net_revenue2 as $value)
            {
                //convert datatype to string for this column
                $convert = floatval($value->net_revenue);
                $rowData = array($value->item_name, $convert);
                $sales_lowestNet->addRow($rowData);
            }
            
            $piechart_lowestNet = \Lava::PieChart('NetRevenue_lowestNet')
                    ->setOptions(array(
                        'datatable' => $sales_lowestNet,
                        'title' => 'Top 10 Lowest Net Revenue per Item ($)'
                    ));
            
        
            
        /////////////// VARIABLE COUNTS //////////////////////////////////////////////////
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
            
        ////////////////// END VARIABLE COUNTS ////////////////////////

        

            
            return view('johnson.index')
                    ->with('results',$results)
                    ->with('itemcount', $itemcount)
                    ->with('itemOrders', $itemOrders)
                    ->with('totalGen', $totalGen)
                    ->with('piechart',$piechart)
                    ->with('piechart_lowestNet',$piechart_lowestNet);
            
	}
    }



