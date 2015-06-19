@extends('layouts.master')

@section('title')
Menu Update
@stop


@section('content')
<div class="main-title">
    <h2>           
        <i class="fa fa-coffee"></i>
        <a href="{{ URL::to('/menus')}}/{{$item->id}}">{{ $item->item_name}}</a>        
        <span class="glyphicon glyphicon-cutlery"></span>
        <div class="create_link">
            <a href="{{ url('menus/create') }}"><span class="glyphicon glyphicon-plus-sign"></span></a>
            <a href="{{ url('menus')  }}"><span class="glyphicon glyphicon-list-alt"></span></a>
        </div>
    </h2>

</div><!--/.main-title-->
@if($errors->any())
@foreach($errors ->all() as $error)
<li>{{ $error }}</li>
@endforeach
<hr/>
@endif
<div class="row">
    <div class="col-lg-10 center-block">
        <div class="item_img">
            <img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" class="img-thumbnail"/>
        </div>

        <div class="item_edit_form">

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
            <!--div class="form-group">    
                <div>{{--!! Form::submit('Delete', ['class ' => 'btn btn-primary form-control']) !!--}}</div>
            </div-->
            {!! Form:: close() !!} 
        </div><!--/.item_edit_form-->
    </div><!-- /.col-lg-10 center-block-->   
</div><!--/ .row-->
@stop