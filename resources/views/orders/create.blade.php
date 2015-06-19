@extends('layouts.master')

@section('title')
Order Create
@stop

@section('maintitle')
Add a New Order
@stop

@section('content')
<div class="main-title">
    <h2>Add a New Order
        <div class="create_link"><a href="{{ url('orders')  }}"><span class="glyphicon glyphicon-list-alt"></span></a></div>
    </h2>
</div>

<div class="row">
    <div class="col-lg-10 center-block">
        @if($errors->any())
        @foreach($errors ->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <hr/>
        @endif

        {!! Form:: open( ['url' => 'orders' ] ) !!} 
        <div class="form-group">
            {!! Form::label('tbl_number', 'Table #: ') !!}
            {!! Form::selectRange('tbl_number',1,15) !!}        
        </div>

        <div class="form-group" >
            {!! Form::label('server', 'Server: ') !!}
            {!! Form::select('server', $servers) !!}        
        </div>


        <div class="form-group">
            {!! Form::label('order_date', 'Ordered On: ') !!}
            {!! Form::text('order_date', Carbon::now()->format('Y-m-d'), ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('order_time', 'Ordered At ') !!}
            {!! Form::text('order_time', Carbon::now()->format('h:i:s A'), ['class'=>'form-control']) !!}
        </div>
        {{-- vendor/compiled.php: line 1808-1809 date_default_timezone_set('America/New_York');
            config/app.php:line39 ...'timezone' => 'EDT',
            Ref:http://php.net/manual/fr/function.date-default-timezone-set.php
            --}}
        <br/>
        <div class="form-group">    
            {!! Form::submit('Go to the next', ['class ' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form:: close() !!}
    </div><!-- /.col-lg-10 center-block-->
</div><!--/ .row-->
@stop