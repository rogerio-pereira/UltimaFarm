$(window).on('load', function() {
    //Grafico Clientes
    $.get("/charts/clients", function(data){
        console.log(data);
        $("#clientsChart").html(data);
    });


    //Grafico Vendas
    $.get("/charts/sales", function(data){
        console.log(data);
        $("#salesChart").html(data);
    });
});