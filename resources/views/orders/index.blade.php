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
<div class="main-title">
    <h2>List of Orders
        <div class="create_link"><a href="{{ url('orders/create') }}"><span class="glyphicon glyphicon-plus-sign"></span></a></div>   
    </h2>
</div>


<div class="row">
    <div class="col-lg-10 center-block">
        <div class="table-responsive">
            <table id="orderlist" class="display table table-striped table-hover dt-responsive">

                <thead><tr><th>Complete</th><th>Order#</th><th>Table#</th><th>Server</th><th>Ordered at</th><th>Subtotal$</th><th>Tax$</th><th>Total$</th><th>AddItems</th></tr></thead>
                <tbody>
                    @foreach($results as $order)
                    <tr>
                        <td>@if ( $order->order_complete === 1)
                            <span class="glyphicon glyphicon-ok"></span>                            
                            @endif
                        </td>
                        <!--td><a href="{{-- url('/orders', $order->order_id) --}}">{{-- $order->order_id --}}</a></td-->            
                        <td>{{ $order-> order_id }}</td>
                        <td>{{ $order-> tbl_number }}</td>
                        <td>{{ $order-> server_firstname }}</td>
                        <td>{{ $order-> order_date}} {{ $order->order_time }}</td>
                        <td>{{ $order-> subtotal}}</td>
                        <td>{{ $order-> tax}}</td>
                        <td>{{ $order-> total}}</td>
                        <td>@if(  $order->order_complete != 1) 
                            <!--a href="{{-- URL::to('/orders') --}}/{{-- $order->order_id --}}/chooseItem">Choose Items</a-->                            
                            <a href="{{ URL::to('/orders') }}/{{ $order->order_id }}/items">Choose Items</a>
                            @elseif( $order->subtotal == 0.00)

                            @else
                            Order Complete: <a href="{{ url('/orders', $order->order_id) }}">Details</a>
                            @endif
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div><!--/.table-responsive -->
    </div><!-- /.col-lg-10 center-block-->
</div><!--/ .row-->
<script>
$(document).ready(function () {
    $('#orderlist').DataTable({
        responsive: true,
        "pagingType": "scrolling"
    });
});
</script>

@stop
