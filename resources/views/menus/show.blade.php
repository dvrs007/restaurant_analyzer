@extends('layouts.master')
@section('title')
{{ $item->item_name }}
@stop


@section('maintitle')

@if(  $item->id  === 1)
|
@else
<a href="{{ URL::to('/menus')}}/{{$item->id -1 }}"> &lt;&lt; </a>
@endif
<a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">{{ $item->item_name }}</a>
<a href="{{ URL::to('/menus')}}/{{$item->id +1 }}"> &gt;&gt; </a>


<div style="float:right;"><a href="{{ url('menus/create') }}">Create</a></div>
<div style="clear:both;"></div>
@stop

@section('content')

<!--a href="{{ url('menus')  }}">List of Menus</a-->

<figure style='float:left;width:35%'>

    <img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" class="img-thumbnail" />

</figure>
<div style="float:left;margin-left:4%;">
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