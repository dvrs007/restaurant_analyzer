@extends('layouts.master')

@section('content')

<h3><a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">{{ $item->item_name }}</a></h3>
<a href="{{ url('menus')  }}">List of Menus</a>
|
<a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">Edit</a>
|
<a href="{{ url('/')}}">Home</a>
<br/><hr/><br/>
<div>
    Price: {{ $item-> item_price }} 
    <br/>
    Cost: {{ $item -> item_cost }}        
</div>
<br>


@stop