@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-6 center-block">
        <h1>Add a New Order</h1>
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

        {!! Form:: open( ['url' => 'orders' ]) !!} 
        <div class="form-group">
            {!! Form::label('tbl_number', 'Table #: ') !!}
            {!! Form::selectRange('tbl_number',1,15) !!}        
        </div>

        <div class="form-group" >
            {!! Form::label('server', 'Server: ') !!}
            {!! Form::select('server', array('Jeesoo' => 'Jeesoo', 'Johnson'=>'Johnson', 'Phil'=>'Phil')) !!}        
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
    </div>
</div>
@stop