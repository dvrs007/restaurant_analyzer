@extends('layouts.master')

@section('title')
Menu Update
@stop


@section('maintitle')
Edit/Update {{ $item->item_name}}
@stop

@section('content')
<a href="{{ url('menus') }}">List of Menus</a>
|
<a href="{{ url('menus/create') }}">Create</a>

<br/>

@if($errors->any())
@foreach($errors ->all() as $error)
<li>{{ $error }}</li>
@endforeach
@endif
<hr/>
<figure style='float:left;width:35%'>

    <img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" />

</figure>

<div style="float:left;">
    
{{--!! Form:: open( ['url' => 'menusUpdate' ]) !!--}} 
{!! Form::open(array('url'=>'menusUpdate','method'=>'POST', 'files'=>true)) !!}
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

<div class="form-group">
    {!! Form::label('img_path', 'Image File: ') !!}
    {!! Form::file('image') !!}
    <p class="errors">{!!$errors->first('image')!!}</p>
    @if(Session::has('error'))
    <p class="errors">{!! Session::get('error') !!}</p>
    @endif
</div>
<br/>
<div class="form-group">  
    <!-- submit button -->
    {!! Form::submit('Update', ['class ' => 'btn btn-primary form-control']) !!}
</div>
{!! Form:: close() !!}

{!! Form:: open( ['url' => 'menuDelete']) !!}
{!! Form::hidden('id',  $item->id  ) !!}
<div class="form-group">    
    <div>{!! Form::submit('Delete', ['class ' => 'btn btn-primary form-control']) !!}</div>
</div>
{!! Form:: close() !!} 
</div>
@stop