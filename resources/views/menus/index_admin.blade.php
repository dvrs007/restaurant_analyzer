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

@section('content')
<div class="main-title">
    <h2>Menu
        <div class="create_link"><a href="{{ url('menus/create') }}"><span class="glyphicon glyphicon-plus-sign"></span></a></div>        
    </h2>            
</div><!--/.main-title-->
<div class="row">
    <div class="col-lg-10 center-block">
        <table id="menuTable" class="display table table-bordered table-condensed table-hover table-responsive table-striped">
            <thead>
                <tr>            
                    <th>Menu</th>
                    <th>Price</th>

            </thead>   
            <tbody>
                @foreach($items as $item)
                <tr>           
                    <td><a href="{{ url('/menus', $item->id) }}">{{ $item->item_name}}</a></td>
                    <td>{{ $item->item_price}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div><!-- /.col-lg-10 center-block-->
</div><!--/ .row-->
<script>
$(document).ready(function () {
    $('#menuTable').dataTable();
});
</script>
@stop