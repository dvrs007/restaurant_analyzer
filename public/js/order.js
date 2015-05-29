/* 
 * May28,2015
 * Jeesoo Kim
 * Ref:http://www.quirksmode.org/dom/domform.html
 */


$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<select name='items'>@foreach($items as $item)<option value=''>{{ $item->item_name }}</option>@endforeach</select><select name='quantity'>@for($i=1; $i<21;$i++)<option value='{{$i}}'>{{$i}}</option>@endfor</select>"); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});