@extends('layouts.master')

@section('content')
<div class="main-title">
    <h2>Choose Items for Order#{{$order->id}} at Table#{{ $order->tbl_number}} by {{$order->server}}
    <div class="create_link"><a href="{{ url('orders')  }}"><span class="glyphicon glyphicon-list-alt"></span></a></div>
    </h2>
</div>
<div class="row">
    <div class="col-lg-10 center-block">
        @if($errors->any())
        @foreach($errors ->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <hr/>
        @endif


        {!! Form:: open( ['url' => 'AddLineItems']) !!} 
        {!! Form::hidden('order_id',  $order->id  ) !!}


        <div class='form-group'>
            <select name="item_id">
                @foreach($items as $item)
                <option id="" value="{{ $item->id }}">{{ $item->item_name }}  (${{ $item->item_price}})</option>
                @endforeach
            </select>  

            <select name="ordered_quantity">
                @for($i=1; $i<21;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>   
        </div>

        <div class='form-group'>
            {!! Form::Label('order_complete','Order Complete? Check if YES') !!}
            {!! Form::checkbox('order_complete', 1 , false, ['class' => 'field'] ) !!}
        </div>
        
                
        <div id="totalprice">
            <h3>The total before tax: <span class="price"></span></h3>
        </div>
        <!--
        public function checkbox($name, $value = 1, $checked = null, $options = array())
        {
            return $this->checkable('checkbox', $name, $value, $checked, $options);
        }
        1st param: name
        2nd : value
        3rd : checked or not (i.e. null, false or true)
        4th : attributes.
        -->
        <br/><br/>
        <div class="form-group">    
            {!! Form::submit('Complete Order', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form:: close() !!}
    </div><!-- /.col-lg-10 center-block-->
</div><!--/ .row-->
@stop