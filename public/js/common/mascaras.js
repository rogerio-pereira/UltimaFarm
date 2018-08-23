jQuery(function($)
{
    $(".cnpj").mask("99.999.999/9999-99");
    //$(".zipcode").mask("99.999-999");
    $(".cpf").mask("999.999.999-99");
    $(".tempo").mask("99:99:99");
    $('.dinheiro').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.',
    });    
   
    //$(".telefone").mask("(99) 9999-9999?9");
    /*$(".telefone").focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length == 3) {
            element.mask("999");
        }
        else if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');*/

    //Busca CEP(focuslost)
    $(".zipcode").blur(function() {
        console.log('aqui');
        if($(this).val() != '') {
            //Valor sem . e sem - (##.###-###)
            var cep = $(this).val().split(".").join("").split("-").join("");

            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#street").val(dados.logradouro);
                    $("#neighborhood").val(dados.bairro);
                    $("#city").val(dados.localidade);
                    $("#state").val(dados.uf);
                    $("#number").focus();
                }
                else {
                    //CEP pesquisado não foi encontrado.
                    alert("CEP não encontrado.");
                }
            });
        }
    });

    $('.botao').prop("disabled", false);
});