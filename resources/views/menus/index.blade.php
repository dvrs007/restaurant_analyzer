@extends('layouts.master')

@section('content')
<hr/>
<h1>List of Menus</h1>

<a href="{{ url('orders')  }}">List of Orders</a>
|
<a href="{{ url('orders/create')  }}">Create</a>
|
<a href="{{ url('/')}}">Home</a>
<br/>
<hr/>

<table class="table table-bordered table-condensed table-hover table-responsive table-striped">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Price</th>
    </thead>   
    <tbody>
        @foreach($items as $menu)
        <tr>
            <td>{{ $menu->item_name}}</td>
            <td>{{ $menu->item_price}}</td>
        </tr>
        @endforeach
      
    </tbody>
</table>
@stop