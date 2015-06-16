@extends('layouts.master')
@section('title')
{{ $item->item_name }}
@stop


@section('maintitle')
<a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">{{ $item->item_name }}</a>
@stop

@section('content')

<!--a href="{{ url('menus')  }}">List of Menus</a-->

<figure style='float:left;width:35%'>

    <img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" />

</figure>
<div style="float:left;">
    <h4>description</h4>

    Price: {{ $item-> item_price }} <br/>
    Cost: {{ $item -> item_cost }} <br/><br/>
    <hr/>
    <a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">Edit</a> | 
    <a href="{{ URL::to('/menus')}}/{{$item->id}}/delete">Delete</a><br/><br/>
    <a href="{{ url('menus')  }}">Back to the List of Menus</a> 


</div>
<div style="clear:both;"></div>
<br>


@stop