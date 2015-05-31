@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Sales Chart

@stop

@section('sidebar')
    

    <h1>Statistics on the sales of each item</h1>
    
    
    <?php 
    
    echo Lava::render('BarChart', 'TotalSales', 'sales_div', array('height'=>700, 'width'=>1000))  ?>
    
    <select name="item[]" style="color:black;">
        @foreach($order as $item)
        <option value="">{{ $item->item_name }}</option>
        @endforeach
    </select> 
            
    
@stop