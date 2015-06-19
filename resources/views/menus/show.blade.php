@extends('layouts.master')
@section('title')
{{ $item->item_name }}
@stop

@section('content')
<div class="main-title">
    <h2> 
        {{--$cnt_item--}}
        @if(  $item->id  === 1 )
                <a href="{{ URL::to('/menus')}}/{{$cnt_item-1 }}"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
        
        @else
        <a href="{{ URL::to('/menus')}}/{{$item->id -1 }}"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
        @endif

        <i class="fa fa-coffee"></i> 
        <a href="{{ URL::to('/menus')}}/{{$item->id}}/edit">{{ $item->item_name }}</a> 
        <span class="glyphicon glyphicon-cutlery"></span>

        
        @if( $item->id === $cnt_item -1)              
        <a href="{{ URL::to('/menus/1')}}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        @else
        <a href="{{ URL::to('/menus')}}/{{$item->id +1 }}"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        <!--a href="{{-- URL::to('/menus')--}}/{{-- $cnt_item-1 --}}"><span class="glyphicon glyphicon-fast-forward"></span></a-->
        @endif


        <div class="create_link">
            <a href="{{ url('menus/create') }}"><span class="glyphicon glyphicon-plus-sign"></span></a>
            <a href="{{ url('menus')  }}"><span class="glyphicon glyphicon-list-alt"></span></a>
        </div>
    </h2>
</div><!--/.main-title-->

<div class="row">
    <div class="col-lg-10 center-block">
        <div class="item_img">
            <img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" class="img-thumbnail" />
        </div>
        <div class="item_edit_form">
            <h4>description</h4>
            Price: {{ $item-> item_price }} <br/>
            Cost: {{ $item -> item_cost }} <br/><br/>
            <h1><a href="{{ URL::to('/menus')}}/{{$item->id}}/edit"><i class="fa fa-pencil-square-o"></i></a>
                <!--a href="{{-- URL::to('/menus')--}}/{{--$item->id--}}/delete"><i class="fa fa-trash" onclick="return confirm('Are you sure to delete?')"></i></a--></h1>

        </div><!--/.item_edit_form-->
    </div><!--/.col-lg-10 center-block-->
</div><!--/.row-->
@stop