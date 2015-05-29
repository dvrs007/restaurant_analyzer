@extends('layouts.master')

@section('content')
<h2>List of items</h2>
<br/>
<form>

    <div class="input_fields_wrap">
        <button class="add_field_button">Add More Items</button>
        <div class="order_fields">
            <select name="item[]">
                @foreach($items as $item)
                <option value="">{{ $item->item_name }}  (${{ $item->item_price}})</option>
                @endforeach
            </select>

            <select name="quantity[]">
                @for($i=1; $i<21;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    
    <input type="submit" value="Order Now" />
    
</form>








@stop

