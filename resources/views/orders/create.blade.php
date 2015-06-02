@extends('layouts.master')

@section('content')
<hr/><h1>Add a New Order</h1>
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


{!! Form:: open( ['url' => 'orders/choose' ]) !!} 
<div class="form-group">
    {!! Form::label('tbl_number', 'Table #: ') !!}
    {!! Form::selectRange('tbl_number',1,15) !!}        
</div>

<div class="form-group" >
    {!! Form::label('server', 'Server: ') !!}
    {!! Form::select('server', array('Jeesoo' => 'Jeesoo', 'Johnson'=>'Johnson', 'Phil'=>'Phil')) !!}        
</div>


<div class="form-group">
    {{--{!! Form::label('datetime', 'Ordered On: ') !!}
    {!! Form::input('date','datetime',date('Y-m-d'), ['class'=>'form-control']) !!}
</div>

<br/>
<div class="form-group">    
    {!! Form::submit('Go to the next', ['class ' => 'btn btn-primary form-control']) !!}
</div>
{!! Form:: close() !!}
@stop