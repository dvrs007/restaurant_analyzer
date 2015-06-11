@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-6 center-block">
        <h1>Choose Items</h1>
        <a href="{{ url('orders')  }}">List of Orders</a>
        |
        <a href="{{ url('orders/create')  }}">Create</a>
        |
        <a href="{{ url('/')}}">Home</a>
        <br/>

        @if($errors->any())
        @foreach($errors ->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        @endif
        <hr/>
        <h2>Order#: {{ $order->id }}</h2>
        Table#:{{ $order->tbl_number}}<br/>
        Server:{{$order->server}}
        <hr/>

        {!! Form:: open( ['url' => 'AddLineItems']) !!} 
        {!! Form::hidden('order_id',  $order->id  ) !!}


        <div class='form-group'>
            <select id="item_id" name="item_id">
                @foreach($items as $item)
                <option id="" value="{{ $item->id }}">{{ $item->item_name }}  (${{ $item->item_price}})</option>
                @endforeach
            </select>  

            <select id="ordered_quantity" name="ordered_quantity">
                @for($i=1; $i<21;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>   
        </div>

        <div class='form-group'>
            {!! Form::Label('order_complete','Order Complete? Check if YES') !!}
            {!! Form::radio('order_complete', 1 , false, ['class' => 'field'] ) !!}
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
            {!! Form::submit('Complete Order', ['class' => 'completeOrd btn btn-primary form-control']) !!}
        </div>
        {!! Form:: close() !!}
    </div>
</div>

@stop