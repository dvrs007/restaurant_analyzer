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
<h2>Order#: {{ $order->id }}</h2>
Table#:{{ $order->tbl_number}}<br/>
Server:{{$order->server}}
<hr/>

{!! Form:: open( ['url' => 'AddLineItems' ]) !!} 
{!! Form::hidden('order_id',  $order->id  ) !!}

<div class='form-group'>
    <select name="item_id">
        @foreach($items as $item)
        <option value="{{ $item->id }}">{{ $item->item_name }}  (${{ $item->item_price}})</option>
        @endforeach
    </select>  

    <select name="ordered_quantity">
        @for($i=1; $i<21;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>   
</div>

<div class='form-group'>
    {!! Form::Label('order_complete','Order Complete? Check if YES') !!}
    {!! Form::checkbox('order_complete','value') !!}
</div>
<br/><br/>
<div class="form-group">    
    {!! Form::submit('Complete Order', ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form:: close() !!}
@stop