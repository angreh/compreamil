$(function()
{
    $( '#cpf' ).mask
    (
        '000.000.000-00'
    );

    $( '#dataNascimento' ).mask
    (
        '00/00/0000'
    );

    $( '#telefoneResidencial' ).mask
    (
        '(00) 0000-0000'
    );

    $( '#cep' ).mask
    (
        '00000-000'
    );

    $( '#resp_cpf').mask
    (
        '000.000.000-00'
    );

    $( 'resp_dataNascimento').mask
    (
        '00/00/0000'
    );

    $('#telefoneCelular').mask(SPMaskBehavior, spOptions);

    $("#busca_cep").on
    (
        'click',
        function()
        {
            buscaCep();
        }
    );

    $( '#cep' ).keypress
    (
        function(e)
        {
            if( e.which == 13 )
            {
                buscaCep();
                return false;
            }
        }
    );
});

var SPMaskBehavior = function (val)
    {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options)
        {
            field.mask
            (
                SPMaskBehavior.apply
                (
                    {},
                    arguments
                ),
                options
            );
        }
    };

function buscaCep(){
    $( '.wrapper-end').slideUp();

    //Nova variável "cep" somente com dígitos.
    var cep = $('#cep').val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#logradouro").val("...")
            $("#bairro").val("...")
            $("#cidade").val("...")
            $("#estado").val("...")

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    $( '.wrapper-end').slideDown();

                    //Atualiza os campos com os valores da consulta.
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#estado").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    //limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            //limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        //limpa_formulário_cep();
    }
}
