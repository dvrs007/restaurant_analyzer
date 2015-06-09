$(document).ready(function(){
    
    //show positive charts upon click
    $('#positive_stats').on('click', function(){
        $('#positive_charts').slideToggle();
    });
    
    //show negative charts upon click
    $('#negative_stats').on('click', function(){
        $('#negative_charts').slideToggle();
    });
    
    //calculate based off of select option value
    var item_id = $( "#item_id option:selected" ).val();
    var orderedQuant = $('#ordered_quantity option:selected').text();
    
    
    $('.price').text(item_id*orderedQuant);
    
});