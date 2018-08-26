$('#client_id').change(function(){
    id = $(this).val();
    $.get( "/clients/"+id, function(data){        
        $('#clientDetail').html(data);
    });
});

$('#product_id').change(function(){
    id = $(this).val();

    $.get( "/products/"+id, function(data){  
        $('#productDetail').html(data);
    });
});