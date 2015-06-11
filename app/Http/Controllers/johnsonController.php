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
            
        //get the tables, joined, all the orders, items, and item quantitiess
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
                        'title' => 'Top 10 Highest Net Revenue per Item ($)',
                        'height' => 700
                    ));
            
        
        //query with raw mysql for lowest net revenue
            $net_revenue2 = DB::select( DB::raw("SELECT DISTINCT item_name, order_date, SUM( ordered_quantity ) AS orderedQuantity, (item_price-item_cost)*SUM(ordered_quantity) as net_revenue
                FROM items
                INNER JOIN lineitems ON items.id = lineitems.item_id
                INNER JOIN orders ON lineitems.order_id = orders.id
                GROUP BY item_name
                ORDER BY net_revenue limit 10"));
            
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
                        'title' => 'Top 10 Lowest Net Revenue per Item ($)',
                        'height' => 700
                    ));
            
        
        //query with raw mysql for highest net revenue
            $orderedQuantity = DB::select( DB::raw("SELECT DISTINCT item_name, order_date, SUM( ordered_quantity ) AS orderedQuantity
                FROM items
                INNER JOIN lineitems ON items.id = lineitems.item_id
                INNER JOIN orders ON lineitems.order_id = orders.id
                GROUP BY item_name
                ORDER BY orderedQuantity DESC limit 20") );
        
        //column chart for item quantity ordered
            $items_orderedQuantity = \Lava::DataTable();
            
            $items_orderedQuantity->addStringColumn('Item Name')
                                    ->addNumberColumn('Quantity')
                                    ->setDateTimeFormat('Y');
            foreach($orderedQuantity as $value)
            {
                //convert datatype to string for this column
                $convert = floatval($value->orderedQuantity);
                $rowData = array($value->item_name, $convert);
                $items_orderedQuantity->addRow($rowData);
            }
            
            $columnchart = \Lava::ColumnChart('OrderedQuantity')
                    ->setOptions(array(
                      'datatable' => $items_orderedQuantity,
                      'title' => 'Ordered Quantity',
                      'titleTextStyle' => \Lava::TextStyle(array(
                        'color' => '#eb6b2c',
                        'fontSize' => 12
                      ))
                    ));
            
            
            //query with raw mysql for top 5 most expensive 
            $top_priced_items = DB::select( DB::raw("SELECT DISTINCT item_name, item_price
                FROM items
                GROUP BY item_price
                ORDER BY item_price DESC") );
        
        //column chart for item quantity ordered
            $top_priced_item_dt = \Lava::DataTable();
            
            $top_priced_item_dt->addStringColumn('Item Name')
                                    ->addNumberColumn('Price');
            foreach($top_priced_items as $value)
            {
                //convert datatype to string for this column
                $convert = floatval($value->item_price);
                $rowData = array($value->item_name, $convert);
                $top_priced_item_dt->addRow($rowData);
            }
            
            $donutchart = \Lava::DonutChart('DonutChart')
                   ->setOptions(array(
                     'datatable' => $top_priced_item_dt,
                     'title' => 'Most expensive items',
                       'height' => 700
                   ));
            
            
            //query highest grossing item
            $highest_gross_item = DB::select( DB::raw("SELECT DISTINCT item_name, (
                                                        item_price - item_cost
                                                        ) * SUM( ordered_quantity ) AS net_revenue
                                                        FROM items
                                                        INNER JOIN lineitems ON items.id = lineitems.item_id
                                                        INNER JOIN orders ON lineitems.order_id = orders.id
                                                        GROUP BY item_name
                                                        ORDER BY net_revenue
                                                        DESC
                                                        LIMIT 1") );
            foreach($highest_gross_item as $key)
            {
                //convert datatype to string for this column
                $high_gross_item = ($key->item_name);
            }
            
            //query lowest grossing item
            $lowest_gross_item = DB::select( DB::raw("SELECT DISTINCT item_name, (
                                                        item_price - item_cost
                                                        ) * SUM( ordered_quantity ) AS net_revenue
                                                        FROM items
                                                        INNER JOIN lineitems ON items.id = lineitems.item_id
                                                        INNER JOIN orders ON lineitems.order_id = orders.id
                                                        GROUP BY item_name
                                                        ORDER BY net_revenue
                                                        ASC
                                                        LIMIT 1") );
            foreach($lowest_gross_item as $key)
            {
                //convert datatype to string for this column
                $low_gross_item = ($key->item_name);
            }
            
            
            
            
        
            
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
        //get the minimum value
            
            
        ////////////////// END VARIABLE COUNTS ////////////////////////

        

            
            return view('johnson.index')
                    ->with('results',$results)
                    ->with('itemcount', $itemcount)
                    ->with('itemOrders', $itemOrders)
                    ->with('totalGen', $totalGen)
                    ->with('piechart',$piechart)
                    ->with('piechart_lowestNet',$piechart_lowestNet)
                    ->with('columnchart', $columnchart)
                    ->with('high_gross_item', $high_gross_item)
                    ->with('low_gross_item', $low_gross_item)
                    ->with('donutchart', $donutchart);
            
	}
    }