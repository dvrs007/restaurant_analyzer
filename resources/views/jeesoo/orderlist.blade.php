@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
<h1>Trends Analysis of Sales in Total sales amount ($)</h1><hr>
@stop

@section('sidebar')    
@stop

@section('content')

<div class="row">
    <div class="col-lg-10 center-block">
        <h1>List of Orders</h1>

        <table id="myTable" class="table table-bordered table-condensed table-hover table-responsive table-striped">
            <thead><tr><th>ID</th><th>TOTAL $</th><th>DATE</th><th>TIME</th><th>Server</th></tr></thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order -> order_date}}</td>
                    <td>{{ $order ->order_time }}</td>
                    <td>{{ $order->server}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    });
</script>


@stop
