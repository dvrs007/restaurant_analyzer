@extends('layouts.master')

@section('content')
<div class="main-title">
    <h2>Choose Items for Order#{{$order->order_id}} at Table#{{ $order->tbl_number}} by {{$server->server_firstname}}
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

        {!! Form:: open( ['url' => 'itemsAdd' ]) !!} 
        {!! Form::hidden('order_id',  $order->order_id  ) !!}



        <div id="order" class="form-group order-select-container"> 

            <button class="btn btn-sm btn-info btn-add-more-order">Add More Item</button>  <br/><br/> 
            <div>
                <select name="item_id[]" id="item_div">
                    @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->item_name }}  (${{ $item->item_price}})</option>
                    @endforeach
                </select>  
                <select name="ordered_quantity[]">
                    @for($i=1; $i<21;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>    
            </div> 
        </div><!-- End of #order -->
     
        <div class="form-group">    
            {!! Form::submit('Complete Order', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form:: close() !!}
    </div>
</div>


<script>
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#order"); //Fields wrapper
        var add_button = $(".btn-add-more-order"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<br/><div><select name="item_id[]" id="item_div">' +
                        '@foreach($items as $item)' +
                        '<option value="{{ $item->id }}">' + '{{ $item->item_name }}' + ' ' + '(${{ $item->item_price}})</option>' +
                        '@endforeach' +
                        '</select>' +
                        ' <select name="ordered_quantity[]">' +
                        '@for($i=1; $i<21;$i++)' +
                        '<option value="{{$i}}">{{$i}}</option>' +
                        '@endfor' +
                        '</select>' +
                        ' <a href="#" id="removeOrder" class="btn btn-xs btn-danger btn-remove">Remove</a>' +
                        '</div>'); //add input box
            }
        });

        $(wrapper).on("click", "#removeOrder", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    
//http://www.sanwebe.com/2013/03/addremove-input-fields-dynamically-with-jquery
</script>


@stop

