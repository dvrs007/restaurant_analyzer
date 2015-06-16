@extends('layouts.master')
@section('title')
Orders List
@stop
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

@section('maintitle')
List of Orders
@stop

@section('content')

<!--a href="{{-- url('orders')  --}}">List of Orders</a-->
<a href="{{ url('orders/create')  }}">Create</a>

<hr/>

<table id="orderlist" class="display table table-bordered table-condensed table-hover table-responsive table-striped">

    <thead><tr><th>Complete</th><th>Order#</th><th>Table#</th><th>Server</th><th>Ordered at</th><th>Subtotal$</th><th>Tax$</th><th>Total$</th><th>AddItems</th></tr></thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>@if ( $order->order_complete === 1)
                Yes                                
                @endif
            </td>
            <!--td><a href="{{-- url('/orders', $order->id) --}}">{{-- $order->id --}}</a></td-->            
            <td>{{ $order->id }}</td>
            <td>{{$order->tbl_number }}</td>
            <td>{{$order->server }}</td>
            <td>{{ $order->order_date}} {{ $order->order_time }}</td>
            <td>{{ $order->subtotal}}</td>
            <td>{{ $order->tax}}</td>
            <td>{{ $order->total}}</td>
            <td>@if(  $order->order_complete != 1) 
                <a href="{{ URL::to('/orders') }}/{{ $order->id }}/chooseItem">Choose Items</a>
                <!--a href="{{-- URL::to('/orders')--}}/{{--$order->id--}}/items">Choose Items</a-->
                @elseif( $order->subtotal == 0.00)

                @else
                Order Complete: <a href="{{ url('/orders', $order->id) }}">List of Items</a>
                @endif
            </td>
        </tr> 
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#orderlist').DataTable();
    });
</script>
@stop