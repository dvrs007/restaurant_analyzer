<?php namespace App\Http\Controllers;

use App\Order;
use Khill\Lavacharts\Lavacharts;

class statsController extends Controller {
	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function Stats_index()
	{
            return view('stats.Stats_index');
            
	}
        
    }



