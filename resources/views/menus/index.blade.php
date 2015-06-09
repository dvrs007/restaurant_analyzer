@extends('layouts.master')

@section('content')
<hr/>
<h1>List of Menus</h1>

<a href="{{ url('menus/create')  }}">Create</a>
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
        @foreach($items as $item)
        <tr>
            <td><a href="{{ url('/menus', $item->id) }}">{{ $item->item_name}}</td>
            <td>{{ $item->item_price}}</td>
        </tr>
        @endforeach
      
    </tbody>
</table>
@stop