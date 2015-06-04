<?php namespace App\Http\Controllers;

use App\item;
use App\Order;
use DB;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class philController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()              
	{
            //get the tables, joined, all the orders, items, and item quantities
            $results = DB::table('orders')
            ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
            ->join('items', 'lineitems.item_id', '=', 'items.id')
                    ->groupBy('lineitems.order_id')
            ->get();
            
            $serverresults = DB::table('orders')
            ->join('lineitems', 'orders.id', '=', 'lineitems.order_id')
            ->join('items', 'lineitems.item_id', '=', 'items.id')
            ->groupBy('lineitems.order_id')
            ->get();
            
            $orders= order::all();
            
            //get the count of current servers
            $serverscount = DB::table('orders')
                    ->distinct()->count('server');  
            
            //get all the current servers to be graphed on the x-axis
            //raw MySQL query needed to get the correct data: 
            //SELECT DISTINCT server, SUM( subtotal )
            //FROM orders
            //GROUP BY server
            
            //query with raw mysql
            $serverz = DB::select( DB::raw("SELECT DISTINCT server, SUM(subtotal) as subtotal FROM orders GROUP BY server") );
            
//            $serverz = DB::table('orders')
//                    ->distinct()
//                    ->select('server', 'subtotal')
//                    ->groupBy('server')
//                    ->get();
            
            //print_r($serverz);
            
            //set the data for the chart
            $stocksTable = \Lava::DataTable();

            $stocksTable->addStringColumn('Server Name')
            ->addNumberColumn('Subtotal');
            
            foreach($serverz as $s){
                //var_dump($s->subtotal);
                $rowData = array($s->server, $s->subtotal);
                $stocksTable->addRow($rowData);
            }

//            foreach($orders as $value)
//            {
//                $rowData = array(
//                  $value->server, $value->subtotal
//                );
//
//                $stocksTable->addRow($rowData);
//            }

            //decide on the chart type to use
            $chart = \Lava::BarChart('myFancyChart');

                $chart->datatable($stocksTable);

                // You could also pass an associative array to setOptions() method
                // $chart->setOptions(array(
                //   'datatable' => $stocksTable
                // ));
            
            return view('phil.index')
                    ->with("results", $results)
                    ->with("serverscount", $serverscount)
                    ->with("serverz",$serverz)
                    ->with("itemsresults", $serverresults)
                    ->with("chart",$chart);
            
            
	}

}


