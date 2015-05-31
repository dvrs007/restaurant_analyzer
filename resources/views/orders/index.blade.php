@extends('layouts.master')

@section('content')
<br/>
<h2>Orders: item/quantity</h2>
<br/>
<form action="">
    <div class="form-group order-select-container">                
        <select name="item[]" style="color:black;">
            @foreach($items as $item)
            <option value="">{{ $item->item_name }}  (${{ $item->item_price}})</option>
            @endforeach
        </select>        

        <select name="quantity[]" style="color:black;">
            @for($i=1; $i<21;$i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <a href="#" class="btn btn-xs btn-danger btn-remove">Remove</a>
    </div>
    <a href="" class="btn btn-sm btn-info btn-add-more-order">Add More</a>
    <br/><br/>

    <input type="submit" value="Order Now" />
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>


var template = '<div class="form-group order-select-container">' +
        '<select name="item[]" style="color:black;">' +
        '@foreach($items as $item)' +
        '<option value="">' + '{{ $item->item_name }}' + ' ' + '(${{ $item->item_price}})</option>' +
        '@endforeach' +
        '</select>' +
        ' <select name="quantity[]" style="color:black;">' +
        '@for($i=1; $i<21;$i++)' +
        '<option value="{{$i}}">{{$i}}</option>' +
        '@endfor' +
        '</select>' +
        ' <a href="#" class="btn btn-xs btn-danger btn-remove">Remove</a>' +
        '</div>'

$('.btn-add-more-order').on('click', function (e) {
    e.preventDefault();

    $(this).before(template);
});

$(document).on('click','.btn-remove',function(e){
    e.preventDefault();
    $(this).parents('.order-select-container').remove();
    
});
</script>



@stop

