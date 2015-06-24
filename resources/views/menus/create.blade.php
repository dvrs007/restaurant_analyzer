@extends('layouts.master')

@section('title')
Menu Create
@stop

@section('content')
<div class="main-title">
    <h2>Add a New Item
        <div class="create_link"><a href="{{ url('menus/list')  }}"><span class="glyphicon glyphicon-list-alt"></span></a></div>
    </h2>
</div><!--/.main-title-->
<div class="row">
    <div class="col-lg-10 center-block">
        @if($errors->any())
        @foreach($errors ->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <hr/>
        @endif


        {{--!! Form:: open( ['url' => 'menus' ]) !!--}} 
        {!! Form::open(array('url'=>'menus','method'=>'POST', 'files'=>true)) !!}

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
            {!! Form::submit('Add a new Menu', ['class ' => 'btn btn-primary form-control']) !!}

        </div><br/>

        <div class="form-group">    
            <!-- reset button -->
            {!! Form::reset('Reset', ['class ' => 'btn btn-primary form-control']) !!}
        </div><br/>
        {!! Form:: close() !!}
    </div><!--/.col-lg-10 center-block-->
</div><!--/.row-->
@stop