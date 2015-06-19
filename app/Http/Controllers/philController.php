<?php

namespace App\Http\Controllers;

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
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        //get the tables, joined, all the orders, items, and item quantities
        $results = DB::table('orders')
                ->join('lineitems', 'orders.order_id', '=', 'lineitems.order_id')
                ->join('items', 'lineitems.item_id', '=', 'items.id')                
                ->groupBy('lineitems.order_id')
                ->get();


        //-------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------
        //************************ANALYZE SERVER ITEM QUANTITIES SOLD**************************************//
        //query with raw mysql to get all servers and their total sales
        $quantitiez = DB::select(DB::raw("SELECT SUM( lineitems.ordered_quantity ) as subtotal , orders.server FROM orders JOIN lineitems ON orders.order_id = lineitems.order_id GROUP BY server"));

        //var_dump($quantitiez);
        //set the data columns for the chart
        $quantitiezTable = \Lava::DataTable();
        $quantitiezTable->addStringColumn('Server Name')
                ->addNumberColumn('Quantity of Items Sold');


        //get the data from the SQL statment and bind it to a variable
        foreach ($quantitiez as $q) {
            //var_dump($s->subtotal);
            $row = array($q->server, $q->subtotal);
            $quantitiezTable->addRow($row);
        }


        //decide on the chart type to use, name the chart
        $quantitiezchart = \Lava::BarChart('quantitiezChart')
                ->setOptions(array(
            'datatable' => $quantitiezTable,
            'title' => 'Total Items Sold by Each Server',
            'colors' => array('#333333')));


//            //bind the data to the chart itself
//            $quantitiezchart->datatable($quantitiezTable);
        //************************END ANALYZE SERVER ITEM QUANTITIES SOLD**************************************//
        //-------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------
        //************************GET TOTAL COUNT OF ALL SERVERS**************************************//
        //get the count of current servers
        $serverscount = DB::table('orders')
                        ->distinct()->count('server');

        //************************END TOTAL COUNT OF ALL SERVERS**************************************//
        //-------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------
        //************************ANALYZE SERVER SALES**************************************//
        //query with raw mysql to get all servers and their total sales
        $serverz = DB::select(DB::raw("SELECT DISTINCT server, SUM(subtotal) as subtotal FROM orders GROUP BY server"));
        //set the data columns for the chart
        $stocksTable = \Lava::DataTable();
        $stocksTable->addStringColumn('Server Name')
                ->addNumberColumn('Pre-tax Sales');

        //get the data from the SQL statment and bind it to a variable
        foreach ($serverz as $s) {
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
        $tablez = DB::select(DB::raw("SELECT DISTINCT tbl_number, SUM(subtotal) as subtotal FROM orders GROUP BY tbl_number"));
        $highesttable = DB::select(DB::raw("SELECT DISTINCT tbl_number, SUM(subtotal) as subtotal FROM orders GROUP BY tbl_number ORDER BY subtotal DESC LIMIT 1"));

        $lowesttable = DB::select(DB::raw("SELECT DISTINCT tbl_number, SUM(subtotal) as subtotal FROM orders GROUP BY tbl_number ORDER BY subtotal ASC LIMIT 1"));

        $tablezTable = \Lava::DataTable();
        $tablezTable->addStringColumn('Table Number')
                ->addNumberColumn('Percent');
        foreach ($tablez as $t) {
            $convert = floatval($t->subtotal);
            //var_dump($t->subtotal);
            //var_dump($convert);

            $rowData = array($t->tbl_number, $convert);
            $tablezTable->addRow($rowData);
        }

        $tablezchart = \Lava::PieChart('tablesPieChart')
                ->setOptions(array(
            'datatable' => $tablezTable,
            'title' => 'Total Sales By Table Number',
            'is3D' => false,
            'height' => 700
//                    'slices' => array(
//                        \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                        \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                        \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
//                        )),
//                \Lava::Slice(array(
//                          'offset' => 0.3
                //))
        ));



        ////************************END TABLE PERFORMANCE***************************************//
        //-------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------
        //get all current servers to populate the dropdown list
        $allservers = DB::select(DB::raw("SELECT DISTINCT server FROM orders"));
        

        //************************SEND DATA TO THE VIEW*****************************************//

        return view('phil.index')
                        ->with("results", $results)
                        ->with("serverscount", $serverscount)
                        ->with("serverz", $serverz)
                        ->with("chart", $chart)
                        ->with("tablez", $tablezchart)
                        ->with("quantitiezTable", $quantitiezTable)
                        ->with("allservers", $allservers)
                        ->with("highesttable", $highesttable)
                        ->with("lowesttable", $lowesttable);

        //************************END SEND DATA TO THE VIEW********************//
        //-------------------------------------------------------------------------------------
    }

    public function server() {

        //************************STATS BY INDIVIDUAL SERVER **************************************//
        //get all current servers to populate the dropdown list
        $allservers = DB::select(DB::raw("SELECT DISTINCT server FROM orders"));





        //************************ END STATS BY INDIVIDUAL SERVER **************************************//
        //************************SEND DATA TO THE VIEW*****************************************//

        return view('phil.servers')
                        ->with("allservers", $allservers);

        //************************END SEND DATA TO THE VIEW********************//
        //-------------------------------------------------------------------------------------
    }

}
