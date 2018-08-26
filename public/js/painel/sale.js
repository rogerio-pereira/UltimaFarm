$('.confirmation-callback').confirmation({ 
    placement       : 'top',
    title           : 'Esse processo não pode ser desfeito por nenhum usuário?',
    btnOkClass      : 'btn btn-sm btn-success',
    btnOkLabel      : 'Reembolsar',
    btnCancelClass  : 'btn btn-sm btn-default',
    btnCancelLabel  : 'Cancelar',
    onConfirm       : function(event, element){ 
        id = element.data('id');
        token = $('meta[name=csrf-token]').attr("content");

        $.ajax
        ({
            type: "POST",
            url: "sales/refund/"+id,
            data: 
            {
                id:     id,
                _token: token
            },
            success: function(data)
            {
                $('#sale_'+id).html('');
            },
            error: function(data)
            {
                console.log(data);
                $('body').html(data.responseText);
            }
        });
    }
});