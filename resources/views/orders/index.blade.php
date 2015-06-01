@extends('layouts.master')

@section('content')
<br/>
<h2>Orders: item/quantity</h2>
<br/>

<div id="order" class="form-group order-select-container"> 
    <p>
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
    </p>
</div>

<a href="" id="addOrder" class="btn btn-sm btn-info btn-add-more-order">Add More</a>
<br/><br/>

<input type="submit" value="Order Now" />
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
var template = '<p><select name="item[]" style="color:black;">' +
        '@foreach($items as $item)' +
        '<option value="">' + '{{ $item->item_name }}' + ' ' + '(${{ $item->item_price}})</option>' +
        '@endforeach' +
        '</select>' +
        ' <select name="quantity[]" style="color:black;">' +
        '@for($i=1; $i<21;$i++)' +
        '<option value="{{$i}}">{{$i}}</option>' +
        '@endfor' +
        '</select>' +
        ' <a href="#" id="removeOrder" class="btn btn-xs btn-danger btn-remove">Remove</a>' +
        '</p>'

$(function () {
    var orderDiv = $('#order');
    var i = $('#order').size() + 1;
    $(document).on('click','#addOrder', function () {
        $(template).appendTo('#order');
        i++;
        return false;
    });
   console.log('i:'+i);
    $(document).on('click','.btn-remove', function () {
        if (i > 2) {
            $(this).parents('p').remove();
            i--;
        }
        return false;
    });
});
//Ref:https://www.youtube.com/watch?v=Ow82DXUlp8A
//http://api.jquery.com/live/
</script>

@stop

