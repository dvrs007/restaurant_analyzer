<?php namespace App\Http\Controllers;

use App\Order;
use Khill\Lavacharts\Lavacharts;

class johnsonController extends Controller {
	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{


//        order::all('items')
//            ->join('lineitems', 'items.id', '=', 'lineitems.id')
//            ->join('orders', 'items.id', '=', 'orders.id')
//            ->select('items.id', 'lineitems.ordered_quantity', 'orders.total')
//            ->get();
        
        $order = order::all();
        
        //carbon for date

        $sales = \Lava::DataTable();

            $sales->addStringColumn('Item Name')
                ->addNumberColumn('Item Price')
                ->addNumberColumn('Item Cost');
            
            //echo $order;
            
            foreach($order as $value){
                $sales->addRow(array($value->item_name, $value->item_price, $value->item_cost));
            }
            
            $barchart = \Lava::BarChart('TotalSales')
                  ->setOptions(array(
                    'datatable' => $sales));

            
            return view('johnson.index')->with('order',$order);
            return view('johnson.index')->with('barchart',$barchart);
            
	}
    }



