$(window).on('load', function() {
    //Grafico Clientes
    $.get("/charts/clients", function(data){
        $("#clientsChart").html(data);
    });
});