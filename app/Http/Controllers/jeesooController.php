<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
use DB;
use Illuminate\Http\Request;  //changed it after adding validation
use Khill\Lavacharts\Lavacharts;

/**
 * Description of jeesooController
 *
 * @author SuzieQ
 */
class jeesooController extends Controller {

    public function __construct() {
        //$this->middleware('auth');
    }

    public function index() {
        $items = Order::all();
        $orders = Order::all();
        //dd($orders);
        //return "orders";
        //dd($items);
        //return "items";

        return view('jeesoo.index')->with("orders", $orders);
    }

    public function totalSales() {
        //$orders = Order::all();
        $results = DB::table('orders')
                ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')
                ->groupBy('lineitems.order_id')
                ->get();

        $sales = \Lava::DataTable();

        
        $sales->addStringColumn('Date')
                ->addNumberColumn('Sales Total($)');
        //  ->setDateTimeFormat('Y-m-d');
        //echo $order;

        foreach ($results as $value) {
            $sales->addRow(array($value->date, $value->total));
        }

        $columnchart = \Lava::ColumnChart('TotalSales')
        ->setOptions(array(
        'datatable' => $sales,
        'title' => 'TOTAL SALES ($) over the years, months, .......'
        ));
        
        $myVar = "HI..HELLO";
        echo $myVar;
        
        return \View('jeesoo.totalSales')->with("var", $myVar)
                                        ->with("order", $results);
    }

    public function example() {
        //creating a new datatable
        $stocksTable = \Lava::DataTable();
        $stocksTable->addDateColumn('Day of Month')
                ->addNumberColumn('Projected')
                ->addNumberColumn('Official');

        //random data for example
        for ($a = 1; $a < 30; $a++) {
            $rowData = array(
                "2014-8-$a", rand(800, 1000), rand(800, 1000)
            );

            $stocksTable->addRow($rowData);
        }
        /*
          $stocksTable->addColumns(array(
          array('date','Day of Month'),
          array('number','Projected'),
          array('number','Official')
          )); */

        //Creaing a chart
        $lineChart = \Lava::LineChart('Stocks')
                ->dataTable($stocksTable)
                ->title('Stock Market Trends');


        return view('jeesoo.chartExample')->with('lineChart', $lineChart);
    }

}
