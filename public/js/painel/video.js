$("#urlField").blur(function()
{
    if($('#urlField').val() != ''){
        token = $('#token').val();

        //Verifica se a URL foi encurtad a
        $.ajax ({
            type: "POST",
            url: "/videos/verificaUrlCurta",
            data:
            {
                url: $('#urlField').val(),
                _token: token,
            },
            success: function(data) 
            {
                $("#urlField").val(data);

                $.ajax
                ({
                    type: "POST",
                    url: "/videos/verificaUrlYoutubeValida",
                    data: 
                    {
                        url:    data,
                        _token: token,
                    },
                    success: function(data2) 
                    {
                        if(data2 == 0)
                            alert('O link não é um video do youtube válido!');
                        else if(data2 == 1)
                        {
                            $.ajax
                            ({
                                type: "POST",
                                url: "/videos/obtemImagemYoutube",
                                data: 
                                {
                                    url:    data,
                                    _token: token,
                                },
                                success: function(data3) 
                                {
                                    $('#image').val(data3);
                                    $('#image-uploaded').attr("src", data3);
                                }
                            });
                        }
                    }
                });
            }
        });
    }
});