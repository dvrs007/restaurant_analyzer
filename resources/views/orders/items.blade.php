@extends('layouts.master')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

@section('content')
<div class="row">
    <div class="col-lg-10 center-block">
        <h1>Choose Items</h1>
        <a href="{{ url('orders')  }}">List of Orders</a>
        |
        <a href="{{ url('/')}}">Home</a>
        <br/>

        @if($errors->any())
        @foreach($errors ->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        @endif
        <hr/>
        <h2>Order#: {{ $order->order_id }}</h2>
        Table#:{{ $order->tbl_number}}<br/>
        Server:{{$server->server_firstname}}
        <hr/>

        {!! Form:: open( ['url' => 'itemsAdd' ]) !!} 
        {!! Form::hidden('order_id',  $order->order_id  ) !!}
        
        

        <div id="order" class="form-group order-select-container"> 
            <p>
                <select name="item_id[]" id="item_div">
                    @foreach($items as $item)
                    <option value="{{ $item->item_id }}">{{ $item->item_name }}  (${{ $item->item_price}})</option>
                    @endforeach
                </select>  
                <select name="ordered_quantity[]">
                    @for($i=1; $i<21;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>    
            </p> 
        </div><!-- End of #order -->

        <a href="" id="addOrder" class="btn btn-sm btn-info btn-add-more-order">Add More</a>        
        <br/><br/>
        
        
        <div class='form-group'>
            {!! Form::Label('order_complete','Order Complete? Check if YES') !!}
            {!! Form::checkbox('order_complete', 1 , false, ['class' => 'field'] ) !!}
        </div>
        
        <div class="form-group">    
            {!! Form::submit('Complete Order', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form:: close() !!}
    </div>
</div>
@stop



<script>

var template = '<div id="order" class="form-group order-select-container"><p><select name="item_id[]">' +
        '@foreach($items as $item)' +
        '<option value="">' + '{{ $item->item_name }}' + ' ' + '(${{ $item->item_price}})</option>' +
        '@endforeach' +
        '</select>' +
        ' <select name="ordered_quantity[]">' +
        '@for($i=1; $i<21;$i++)' +
        '<option value="{{$i}}">{{$i}}</option>' +
        '@endfor' +
        '</select>' +
        ' <a href="#" id="removeOrder" class="btn btn-xs btn-danger btn-remove">Remove</a>' +
        '</p></div>';

$(document).ready(function () {
    var max_items    = 5; //maximum items per order allowed
    var orderDiv     = $('#order'); // order div
    var num_item     = [];
    
    num_item.push(orderDiv);
    //var i = $('#order').size() ;
    var i= num_item.size(); //initial order items count
    
    $('#addOrder').click(function(e) { // when add button clicks
        e.preventDefault();
        if(i < max_items){
        $(template).appendTo(orderDiv);
        i++;
        
    });
    console.log('i: '+ i);
    
    $(orderDiv).on('click', '#removeOrder', function (e) {
        if (i > 2) {
            
            e.preventDefault();
            $(this).parents('p').remove();
            i--;
        }
    });
});
//Ref:https://www.youtube.com/watch?v=Ow82DXUlp8A
//http://api.jquery.com/live/
</script>