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

//$lava = new Lavacharts; // See note below for Laravel
        $order = order::all();
        
        order::table('items')
            ->join('lineitems', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id', 'contacts.phone', 'orders.price')
            ->get();
        
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



