<?php

namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;

use App\Order;
use App\Item;
use App\Lineitem;
use DB;
use Schema;
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


        $orders = Order::all();


        //$years_count = DB::select('select COUNT(DISTINCT YEAR(order_date)) from orders')->get();
        //echo $years_count;

        /*
          $results = DB::table('orders')
          ->join('lineitems', 'orders.order_id', '=', 'lineitems.order_id')
          ->join('items', 'lineitems.item_id', '=', 'items.id')
          ->groupBy('lineitems.order_id')
          ->get();

          $sales = \Lava::DataTable();


          $sales->addStringColumn('Year')
          ->addNumberColumn('Sales Total($)');
          //  ->setDateTimeFormat('Y-m-d');
          //echo $order;

          foreach ($results as $value) {
          //$sales->addRow(array($value->order_date, $value->total));
          $sales->addRow(array($value->order_date, $value->total));
          }
          // Try later:  echo date('Y',$value->order_date)."/".date('m', $value->order_date) ."/".date('d', $value->order_date)

          $columnchart = \Lava::ColumnChart('TotalSales')
          ->setOptions(array(
          'datatable' => $sales,
          'title' => 'TOTAL SALES ($) over the years, months, .......'
          ));

          //$myVar = "HI..HELLO";
          //echo $myVar;

          $lineChart = \Lava::LineChart('TotalSales')
          ->dataTable($sales)
          ->title('Stock Market Trends');

          //return \View('jeesoo.totalSales')->with("var", $myVar)
          return \View('jeesoo.totalSales') ->with("order", $results)
          ->with('lineChart', $lineChart)
          ->with('columnchart',$columnchart);
         * ********************************************************* */


        //$results = DB::select('select SUM(total) AS sum ,count(order_id) AS no,YEAR(order_date) AS year from orders group by YEAR(order_date)');
        //$results =DB::table('orders')   ->get();
        /*
          foreach ($results as $result) {
          $sales->addRow(array($result->year, $result->sum));
          } */


//        foreach ($results as $result) {
//            var_dump($result);
//        }


        /*         * ********** 1. Yearly Analysis ******* */
        //Creating Data TABLEs******************************
        /*
          Schema::table('orders', function($table) {
          $table->decimal('expenses', 10, 2);
          });
          DB::update('UPDATE orders o SET o.expenses= 1.13*(SELECT SUM( i.item_cost * l.ordered_quantity) '
          . 'FROM lineitems l '
          . 'JOIN items i ON i.id=l.item_id '
          . 'WHERE o.id=l.order_id '
          . 'GROUP BY o.id)'); */
        $yearlySales = DB::select('select count(order_id) AS cnt, SUM(total) as sales , SUM(expenses) as cost, YEAR(order_date) AS year from orders group by YEAR(order_date)');

        $yearlySales_avg = DB::select('select AVG(total) AS average ,count(order_id) AS cnt,YEAR(order_date) AS year from orders group by YEAR(order_date)');




        //Columns
        $ySales_amt = \Lava::DataTable();
        $ySales_amt->addStringColumn('Year')
                ->addNumberColumn('Sales $')
                ->addNumberColumn('Expenses $')
                ->addNumberColumn('Sales Profit');

        $ySales_cnt = \Lava::DataTable();
        $ySales_cnt->addStringColumn('Year')
                ->addNumberColumn('Number of Orders');
        $ySales_avg = \Lava::DataTable();
        $ySales_avg->addStringColumn('Year')
                ->addNumberColumn('AverageSales');
        //Rows
        foreach ($yearlySales as $result) {
            $ySales_amt->addRow(array($result->year, $result->sales, $result->cost, $result->sales - $result->cost));
            $ySales_cnt->addRow(array($result->year, $result->cnt));
        }

        foreach ($yearlySales_avg as $result) {
            $ySales_avg->addRow(array($result->year, $result->average));
        }

        //Creating CHARTs************************************
        $combo_year_amt = \Lava::ComboChart('TotalSalesY')
                ->setOptions(array(
            'datatable' => $ySales_amt,
            'title' => 'Total Actual Sales $ over the years 2000-2014',
            'seriesType' => 'bars',
            'series' => array(
                2 => \Lava::Series(array(
                    'type' => 'line'
                )))
        ));

        $areachart_year_cnt = \Lava::AreaChart('TotalNumberY')
                ->setOptions(array(
            'datatable' => $ySales_cnt,
            'title' => 'Total Number of Actual Sales Orders over the years 2000-2014'
        ));

        $columnchart_year_avg = \Lava::ColumnChart('AverageSalesY')
                ->setOptions(array(
            'datatable' => $ySales_avg,
            'title' => 'Average Actual Sales $ over the years 2000-2014'
        ));
        //Outputs in View page: Rendering the charts


        /*         * ********** 2. Monthly Analysis ******* */
        $monthlySales = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders GROUP BY MONTH(order_date)');
        $mSales_amt = \Lava::DataTable();
        $mSales_amt->addStringColumn('Month')
                ->addNumberColumn('Sales');

        $mSales_cnt = \Lava::DataTable();
        $mSales_cnt->addStringColumn('Month')
                ->addNumberColumn('Count');

        foreach ($monthlySales as $result) {
            $mSales_amt->addRow(array($result->month, $result->sum));
            $mSales_cnt->addROw(array($result->month, $result->cnt));
        }

        $columnchart_month_amt = \Lava::ColumnChart('TotalSalesM')
                ->setOptions(array(
            'datatable' => $mSales_amt,
            'title' => 'Total Actual Sales $ per month over the years 2000-2014'
        ));

        $columnchart_month_cnt = \Lava::ColumnChart('TotalCountM')
                ->setOptions(array(
            'datatable' => $mSales_cnt,
            'title' => 'Total Number of Actual Sales Orders per month over the years 2000-2014'
        ));


        /* 2-2 */
        /* YEAR2000 */
        $monthlySales2000 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2000 GROUP BY MONTH(order_date)');
        $mSales_amt_2000 = \Lava::DataTable();
        $mSales_amt_2000->addStringColumn('Month')
                ->addNumberColumn('Sales');

        $mSales_cnt = \Lava::DataTable();
        $mSales_cnt->addStringColumn('Month')
                ->addNumberColumn('Count');

        foreach ($monthlySales2000 as $result) {
            $mSales_amt_2000->addRow(array($result->month, $result->sum));
            $mSales_cnt->addROw(array($result->month, $result->cnt));
        }

        $columnchart_month_amt_2000 = \Lava::ColumnChart('TotalSalesM2000')
                ->setOptions(array(
            'datatable' => $mSales_amt_2000,
            'title' => 'Total Actual Sales $ per month during the year of 2000'
        ));

        $columnchart_month_cnt_2000 = \Lava::ColumnChart('TotalCountM2000')
                ->setOptions(array(
            'datatable' => $mSales_cnt,
            'title' => 'Total Number of Actual Sales Orders per month during the year of 2000'
        ));

        /*         * */

        /*         * ** Average Sales on each month in each YEAR  *** */
        /* 2001 */
        $monthlySales2001 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2001 GROUP BY MONTH(order_date)');
        $mSales_amt_2001 = \Lava::DataTable();
        $mSales_amt_2001->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2001 as $result) {
            $mSales_amt_2001->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2001 = \Lava::ColumnChart('TotalSalesM2001')
                ->setOptions(array(
            'datatable' => $mSales_amt_2001,
            'title' => 'Total Actual Sales $ per month during the year of 2001'
        ));

        /* 2002 */
        $monthlySales2002 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2002 GROUP BY MONTH(order_date)');
        $mSales_amt_2002 = \Lava::DataTable();
        $mSales_amt_2002->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2002 as $result) {
            $mSales_amt_2002->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2002 = \Lava::ColumnChart('TotalSalesM2002')
                ->setOptions(array(
            'datatable' => $mSales_amt_2002,
            'title' => 'Total Actual Sales $ per month during the year of 2002'
        ));
        /* 2003 */
        $monthlySales2003 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2003 GROUP BY MONTH(order_date)');
        $mSales_amt_2003 = \Lava::DataTable();
        $mSales_amt_2003->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2003 as $result) {
            $mSales_amt_2003->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2003 = \Lava::ColumnChart('TotalSalesM2003')
                ->setOptions(array(
            'datatable' => $mSales_amt_2003,
            'title' => 'Total Actual Sales $ per month during the year of 2003'
        ));
        /* 2004 */
        $monthlySales2004 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2004 GROUP BY MONTH(order_date)');
        $mSales_amt_2004 = \Lava::DataTable();
        $mSales_amt_2004->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2004 as $result) {
            $mSales_amt_2004->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2004 = \Lava::ColumnChart('TotalSalesM2004')
                ->setOptions(array(
            'datatable' => $mSales_amt_2004,
            'title' => 'Total Actual Sales $ per month during the year of 2004'
        ));
        /* 2005 */
        $monthlySales2005 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2005 GROUP BY MONTH(order_date)');
        $mSales_amt_2005 = \Lava::DataTable();
        $mSales_amt_2005->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2005 as $result) {
            $mSales_amt_2005->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2005 = \Lava::ColumnChart('TotalSalesM2005')
                ->setOptions(array(
            'datatable' => $mSales_amt_2005,
            'title' => 'Total Actual Sales $ per month during the year of 2005'
        ));
        /* 2006 */
        $monthlySales2006 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2006 GROUP BY MONTH(order_date)');
        $mSales_amt_2006 = \Lava::DataTable();
        $mSales_amt_2006->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2006 as $result) {
            $mSales_amt_2006->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2006 = \Lava::ColumnChart('TotalSalesM2006')
                ->setOptions(array(
            'datatable' => $mSales_amt_2006,
            'title' => 'Total Actual Sales $ per month during the year of 2006'
        ));
        /* 2007 */
        $monthlySales2007 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2007 GROUP BY MONTH(order_date)');
        $mSales_amt_2007 = \Lava::DataTable();
        $mSales_amt_2007->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2007 as $result) {
            $mSales_amt_2007->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2007 = \Lava::ColumnChart('TotalSalesM2007')
                ->setOptions(array(
            'datatable' => $mSales_amt_2007,
            'title' => 'Total Actual Sales $ per month during the year of 2007'
        ));
        /* 2008 */
        $monthlySales2008 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2008 GROUP BY MONTH(order_date)');
        $mSales_amt_2008 = \Lava::DataTable();
        $mSales_amt_2008->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2008 as $result) {
            $mSales_amt_2008->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2008 = \Lava::ColumnChart('TotalSalesM2008')
                ->setOptions(array(
            'datatable' => $mSales_amt_2008,
            'title' => 'Total Actual Sales $ per month during the year of 2008'
        ));
        /* 2009 */
        $monthlySales2009 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2009 GROUP BY MONTH(order_date)');
        $mSales_amt_2009 = \Lava::DataTable();
        $mSales_amt_2009->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2009 as $result) {
            $mSales_amt_2009->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2009 = \Lava::ColumnChart('TotalSalesM2009')
                ->setOptions(array(
            'datatable' => $mSales_amt_2009,
            'title' => 'Total Actual Sales $ per month during the year of 2009'
        ));
        /* 2010 */
        $monthlySales2010 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2010 GROUP BY MONTH(order_date)');
        $mSales_amt_2010 = \Lava::DataTable();
        $mSales_amt_2010->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2010 as $result) {
            $mSales_amt_2010->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2010 = \Lava::ColumnChart('TotalSalesM2010')
                ->setOptions(array(
            'datatable' => $mSales_amt_2010,
            'title' => 'Total Actual Sales $ per month during the year of 2010'
        ));
        /* 2011 */
        $monthlySales2011 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2011 GROUP BY MONTH(order_date)');
        $mSales_amt_2011 = \Lava::DataTable();
        $mSales_amt_2011->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2011 as $result) {
            $mSales_amt_2011->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2011 = \Lava::ColumnChart('TotalSalesM2011')
                ->setOptions(array(
            'datatable' => $mSales_amt_2011,
            'title' => 'Total Actual Sales $ per month during the year of 2011'
        ));
        /* 2012 */
        $monthlySales2012 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2012 GROUP BY MONTH(order_date)');
        $mSales_amt_2012 = \Lava::DataTable();
        $mSales_amt_2012->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2012 as $result) {
            $mSales_amt_2012->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2012 = \Lava::ColumnChart('TotalSalesM2012')
                ->setOptions(array(
            'datatable' => $mSales_amt_2012,
            'title' => 'Total Actual Sales $ per month during the year of 2012'
        ));
        /* 2013 */
        $monthlySales2013 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2013 GROUP BY MONTH(order_date)');
        $mSales_amt_2013 = \Lava::DataTable();
        $mSales_amt_2013->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2013 as $result) {
            $mSales_amt_2013->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2013 = \Lava::ColumnChart('TotalSalesM2013')
                ->setOptions(array(
            'datatable' => $mSales_amt_2013,
            'title' => 'Total Actual Sales $ per month during the year of 2013'
        ));
        /* 2014 */
        $monthlySales2014 = DB::select('select SUM(total) As sum, count(order_id) AS cnt, MONTH(order_date) AS month from orders WHERE YEAR(order_date)=2014 GROUP BY MONTH(order_date)');
        $mSales_amt_2014 = \Lava::DataTable();
        $mSales_amt_2014->addStringColumn('Month')
                ->addNumberColumn('Sales');
        foreach ($monthlySales2014 as $result) {
            $mSales_amt_2014->addRow(array($result->month, $result->sum));
        }

        $columnchart_month_amt_2014 = \Lava::ColumnChart('TotalSalesM2014')
                ->setOptions(array(
            'datatable' => $mSales_amt_2014,
            'title' => 'Total Actual Sales $ per month during the year of 2014'
        ));





        /* 3. time of a day */


        $dailySales = DB::select('select SUM(total) As sum, count(order_id) AS cnt, DAY(order_date) AS day from orders GROUP BY DAY(order_date)');
        $dSales_amt = \Lava::DataTable();
        $dSales_amt->addStringColumn('Day')
                ->addNumberColumn('Sales');

        foreach ($dailySales as $result) {
            $dSales_amt->addRow(array($result->day, $result->sum));
        }

        $columnchart_day_amt = \Lava::ColumnChart('TotalSalesD')
                ->setOptions(array(
            'datatable' => $dSales_amt,
            'title' => 'Total Actual Sales $ per day of the month over the years 2000-2014'
        ));


        /*         * ******* */

        /*         * ******* */

        /*         * ******RETURN to VIEW *************** */
        return \View('jeesoo.index')//->with('results', $results)
                        ->with('yearlySales', $yearlySales)
                        ->with('combo_year_amt', $combo_year_amt)
                        ->with('areachart_year_cnt', $areachart_year_cnt)
                        ->with('columnchart_year_avg', $columnchart_year_avg)
                        ->with('monthlySales', $monthlySales)
                        ->with('columnchart_month_amt', $columnchart_month_amt)
                        ->with('columnchart_month_cnt', $columnchart_month_cnt)
                        ->with('columnchart_month_amt_2000', $columnchart_month_amt_2000)
                        ->with('columnchart_month_amt_2001', $columnchart_month_amt_2001)
                        ->with('columnchart_month_amt_2002', $columnchart_month_amt_2002)
                        ->with('columnchart_month_amt_2003', $columnchart_month_amt_2003)
                        ->with('columnchart_month_amt_2004', $columnchart_month_amt_2004)
                        ->with('columnchart_month_amt_2005', $columnchart_month_amt_2005)
                        ->with('columnchart_month_amt_2006', $columnchart_month_amt_2006)
                        ->with('columnchart_month_amt_2007', $columnchart_month_amt_2007)
                        ->with('columnchart_month_amt_2008', $columnchart_month_amt_2008)
                        ->with('columnchart_month_amt_2009', $columnchart_month_amt_2009)
                        ->with('columnchart_month_amt_2010', $columnchart_month_amt_2010)
                        ->with('columnchart_month_amt_2011', $columnchart_month_amt_2011)
                        ->with('columnchart_month_amt_2012', $columnchart_month_amt_2012)
                        ->with('columnchart_month_amt_2013', $columnchart_month_amt_2013)
                        ->with('columnchart_month_amt_2014', $columnchart_month_amt_2014)
                        ->with('dailySales', $dailySales)
                        ->with('columnchart_day_amt', $columnchart_day_amt)
                        ->with('orders', $orders)

        ;
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
