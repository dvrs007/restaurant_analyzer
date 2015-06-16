@extends('layouts.master')

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

@section('title')
Menu List
@stop


@section('maintitle')
Menu

<div style="float:right;"><a href="{{ url('menus/create') }}">Create</a></div>
<div style="clear:both;"></div>
@stop

@section('content')

<table id="menuTable" class="display table table-bordered table-condensed table-hover table-responsive table-striped">
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
<script>
$(document).ready(function () {
    $('#menuTable').dataTable();
});
</script>
@stop