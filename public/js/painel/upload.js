$(document).ready(function() { 
    $('#uploadModal').on('hide.bs.modal', function (e) {
        var name = $('#selectedImage').val();
        var url = window.location.protocol+"//"
                    +window.location.host;
        url = url.split('://painel.').join('://');

        if(name != '')
            name = name.split('://painel.').join('://');
        else
            name = url+"/img/template/painel/sem-imagem.jpg";

        $('#image-uploaded').attr('src', name);
        $('#image').val(name);
    });
});