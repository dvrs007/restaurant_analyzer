@extends('layouts.master')

@section('content')
<hr/><h1>Edit/Update {{ $item->item_name}}</h1>
<a href="{{ url('menus')  }}">List of Menus</a>
|
<a href="{{ url('menus/create')  }}">Create</a>
|
<a href="{{ url('/')}}">Home</a>
<br/>

@if($errors->any())
@foreach($errors ->all() as $error)
<li>{{ $error }}</li>
@endforeach
@endif
<hr/>

{!! Form:: open( ['url' => 'menusUpdate' ]) !!} 
{!! Form::hidden('id',  $item->id  ) !!}

<div class="form-group">
    {!! Form::label('item_name', 'Item Name: ') !!}
    {!! Form::text('item_name',$item->item_name, ['class' => 'form-control']) !!}       
</div>

<div class="form-group" >
    {!! Form::label('item_price', 'Price: ') !!}
    {!! Form::text('item_price',$item->item_price, ['class' => 'form-control']) !!}        
</div>


<div class="form-group">
    {!! Form::label('item_cost', 'Cost: ') !!}
    {!! Form::text('item_cost',$item->item_cost, ['class' => 'form-control']) !!}
</div>

<br/>
<div class="form-group">    
    {!! Form::submit('Update', ['class ' => 'btn btn-primary form-control']) !!}
</div>
<br/>
<br/>
{!! Form:: close() !!}

{!! Form:: open( ['url' => 'menuDelete']) !!}
{!! Form::hidden('id',  $item->id  ) !!}
<div class="form-group">    
    <div>{!! Form::submit('Delete', ['class ' => 'btn btn-primary form-control']) !!}</div>
</div>
{!! Form:: close() !!} 
@stop