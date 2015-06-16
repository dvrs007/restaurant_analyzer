@extends('layouts.master')
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>  
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>  
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>  

@section('title')
Orders List
@stop

@section('maintitle')
List of Orders
@stop

@section('content')

<div class="row">
    <div class="col-lg-10 center-block">
        <!--a href="{{-- url('orders')  --}}">List of Orders</a-->
        <a href="{{ url('orders/create')  }}">Create</a>

        <hr/>
        <div class="table-responsive">
            <table id="orderlist" class="display table table-striped table-hover dt-responsive">

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
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#orderlist').dataTable({
        responsive: true,
        "pagingType": "scrolling"
    });
});
</script>

@stop
