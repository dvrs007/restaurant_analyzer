@extends('layouts.master')

@section('content')
<hr/><h1>Choose Items</h1>
<a href="{{ url('orders')  }}">List of Orders</a>
|
<a href="{{ url('orders/create')  }}">Create</a>
|
<a href="{{ url('/')}}">Home</a>
<br/>

@if($errors->any())
@foreach($errors ->all() as $error)
<li>{{ $error }}</li>
@endforeach
@endif
<hr/>


{!! Form:: open( ['url' => 'orders' ]) !!} 
<div class="form-group">
    <select name="item[]" style="color:black;">
        @foreach($items as $item)
        <option value="">{{ $item->item_name }}  (${{ $item->item_price}})</option>
        @endforeach
    </select>      
</div>

<div>
    <select name="quantity[]" style="color:black;">
        @for($i=1; $i<21;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>    
</div>



<!--
<form action="">
<div id="order" class="form-group order-select-container"> 
+    
<p><select name="item[]" style="color:black;">
        {{--@foreach($items as $item)
        <option value="">{{ $item->item_name }}  (${{ $item->item_price}})</option>
        @endforeach--}}
    </select>  
    <select name="quantity[]" style="color:black;">
        {{--@for($i=1; $i<21;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor--}}
    </select>    
</p> </div>
<a href="" id="addOrder" class="btn btn-sm btn-info btn-add-more-order">Add More</a>
+<br/><br/>
<input type="submit" value="Order Now" />
</form>
-->
<br/>
<div class="form-group">    
    {!! Form::submit('Complete Order', ['class ' => 'btn btn-primary form-control']) !!}
</div>
{!! Form:: close() !!}
@stop


<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
/*
var template = '<p><select name="item[]" style="color:black;">' +
{{--
        '@foreach($items as $item)' +
        '<option value="">' + '{{ $item->item_name }}' + ' ' + '(${{ $item->item_price}})</option>' +
        '@endforeach' +
        '</select>' +
        ' <select name="quantity[]" style="color:black;">' +
        '@for($i=1; $i<21;$i++)' +
        '<option value="{{$i}}">{{$i}}</option>' +
        '@endfor' +
        '</select>' +
        ' <a href="#" id="removeOrder" class="btn btn-xs btn-danger btn-remove">Remove</a>' +
        '</p>'
--}}{{--
$(function () {
    var orderDiv = $('#order');
    var i = $('#order').size() + 1;
    $(document).on('click', '#addOrder', function () {
        $(template).appendTo('#order');
        i++;
        return false;
    });
    console.log('i:' + i);
    $(document).on('click', '.btn-remove', function () {
        if (i > 2) {
            $(this).parents('p').remove();
            i--;
        }
        return false;
    });
});
//Ref:https://www.youtube.com/watch?v=Ow82DXUlp8A
//http://api.jquery.com/live/

--}}
</script-->



