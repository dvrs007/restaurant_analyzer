<?php namespace App\Http\Controllers;

use App\item;
use App\Order;
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
            $items= item::all();
            //dd($items);
            //return "items";
            
            
            //set the data for the chart
            $stocksTable = \Lava::DataTable();

            $stocksTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');

            // Random Data For Example
            for ($a = 1; $a < 30; $a++)
            {
                $rowData = array(
                  "2014-8-$a", rand(800,1000), rand(800,1000)
                );

                $stocksTable->addRow($rowData);
            }
            
            //decide on the chart type to use
            $chart = \Lava::LineChart('myFancyChart');

                $chart->datatable($stocksTable);

                // You could also pass an associative array to setOptions() method
                // $chart->setOptions(array(
                //   'datatable' => $stocksTable
                // ));
            
            return view('phil.index')->with("items", $items);
            return view('phil.index')->with("chart",$chart);
	}

}


