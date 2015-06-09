@extends('layouts.master')

@section('content')
<hr/><h1>Add a New Menu</h1>
<a href="{{ url('menus')  }}">List of Menus</a>
|
<a href="{{ url('/')}}">Home</a>
<br/>
<br/>
@if($errors->any())
@foreach($errors ->all() as $error)
<li>{{ $error }}</li>
@endforeach
@endif
<hr/>

{!! Form:: open( ['url' => 'menus' ]) !!} 
<div class="form-group">
    {!! Form::label('item_name', 'Item Name: ') !!}
    {!! Form::text('item_name',null, ['class' => 'form-control']) !!}       
</div>

<div class="form-group" >
    {!! Form::label('item_price', 'Price: ') !!}
    {!! Form::text('item_price',null, ['class' => 'form-control']) !!}        
</div>


<div class="form-group">
    {!! Form::label('item_cost', 'Cost: ') !!}
    {!! Form::text('item_cost',null, ['class' => 'form-control']) !!}
</div>

<br/>
<div class="form-group">    
    {!! Form::submit('Add a new Menu', ['class ' => 'btn btn-primary form-control']) !!}
</div>
{!! Form:: close() !!}
@stop