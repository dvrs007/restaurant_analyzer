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
           
            //-------------------------------------------------------------------------------------
            ////-------------------------------------------------------------------------------------
            //************************GET TOTAL COUNT OF ALL SERVERS**************************************//
            //
            //get the count of current servers
            $serverscount = DB::table('orders')
                    ->distinct()->count('server');  
            
            //************************END TOTAL COUNT OF ALL SERVERS**************************************//
            //-------------------------------------------------------------------------------------
            ////-------------------------------------------------------------------------------------
            //************************ANALYZE SERVER SALES**************************************//
            //
            //query with raw mysql to get all servers and their total sales
            $serverz = DB::select( DB::raw("SELECT DISTINCT server, SUM(subtotal) as subtotal FROM orders GROUP BY server") );
            //set the data columns for the chart
            $stocksTable = \Lava::DataTable();
            $stocksTable->addStringColumn('Server Name')
            ->addNumberColumn('Pre-tax Sales');
            
            //get the data from the SQL statment and bind it to a variable
            foreach($serverz as $s){
                //var_dump($s->subtotal);
                $rowData = array($s->server, $s->subtotal);
                $stocksTable->addRow($rowData);
            }

            //decide on the chart type to use, name the chart
            $chart = \Lava::BarChart('myFancyChart');

            //bind the data to the chart itself
            $chart->datatable($stocksTable);

            //************************END ANALYZE SERVER SALES****************************************//
            //-------------------------------------------------------------------------------------
            //-------------------------------------------------------------------------------------
            
            //************************ANALYZE TABLE PERFORMANCE**************************************//
            
            //query with raw mysql to get all servers and their total sales
            $tablez = DB::select( DB::raw("SELECT DISTINCT tbl_number, SUM(subtotal) as subtotal FROM orders GROUP BY tbl_number") );
//            //set the data columns for the chart
//            $tablezTable = \Lava::DataTable();
//            $tablezTable->addStringColumn('Table Number')
//            ->addNumberColumn('Pre-tax Sales');
//            
//            //get the data from the SQL statment and bind it to a variable
//            foreach($tablez as $t){
//                //var_dump($s->subtotal);
//                $rowData = array($t->tbl_number, $t->subtotal);
//                $tablezTable->addRow($rowData);
//            }
//
//            //decide on the chart type to use, name the chart
//            $tablezchart = \Lava::LineChart('tablesPieChart');
//
//            //bind the data to the chart itself
//            $tablezchart->datatable($tablezTable);
            
            $tablezTable = \Lava::DataTable();
            $tablezTable->addStringColumn('Table Number')
        ->addNumberColumn('Percent');
        foreach($tablez as $t){
                $convert = floatval($t->subtotal);
                //var_dump($t->subtotal);
                //var_dump($convert);
                
                $rowData = array($t->tbl_number, $convert);
                $tablezTable->addRow($rowData);
            }

        $tablezchart = \Lava::PieChart('tablesPieChart');
        $tablezchart->datatable($tablezTable);
            
            ////************************END TABLE PERFORMANCE***************************************//
            //-------------------------------------------------------------------------------------
            //-------------------------------------------------------------------------------------

            
            //************************SEND DATA TO THE VIEW*****************************************//
            
            return view('phil.index')
                    ->with("results", $results)
                    ->with("serverscount", $serverscount)
                    ->with("serverz",$serverz)
                    ->with("chart",$chart)
                    ->with("tablez",$tablezchart);
            
            //************************END SEND DATA TO THE VIEW********************//
            //-------------------------------------------------------------------------------------
            
	}

}


