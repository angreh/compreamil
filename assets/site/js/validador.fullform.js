function applyFormValidators()
{
    jQuery.validator.addMethod(
        "cpfV",
        function (value, element) {
            value = value.replace(/[^0-9]+/g, '');
            var Soma;
            var Resto;
            Soma = 0;
            if (value == "00000000000") return false;

            for (i=1; i<=9; i++) Soma = Soma + parseInt(value.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(value.substring(9, 10)) ) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(value.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(value.substring(10, 11) ) ) return false;
            return true;
        }
    );
    jQuery.validator.addMethod(
        "dateNasc",
        function (value, element) {
            test = value.replace(/[^0-9]+/g, '');
            if( test.length == 8 )
            {
                return true;
            } else {
                return false;
            }
        }
    );
    jQuery.validator.addMethod(
        "notNull",
        function (value, element) {
            if( value != undefined )
            {
                return true;
            } else {
                return false;
            }
        }
    );
    jQuery.validator.addMethod(
        "phone",
        function (value, element){
            var test = value.replace(/[^0-9]+/g, '');
            if( test.length == 10 || test.length == 11 )
            {
                return true;
            } else {
                return false;
            }
        }, "Por favor insira um número válido"
    );
    $('#formFullform').validate({
        rules: {
            nome: {
                required: true,
                minlength: 2
            },
            cpf: {
                required: true,
                cpfV: true
            },
            rg: {
                required: true,
                minlength: 4
            },
            emissor: "required",
            dataNascimento: {
                required: true,
                dateNasc: true
            },
            sexo: "notNull",
            estadoCivil: "notNull",
            email: {
                required: true,
                email: true
            },
            nomeMae: "required",
            aceito: "notNull"
        },
        messages: {
            nome: {
                required: "Por favor insira seu nome",
                minlength: "Insira um NOME válido"
            },
            cpf: {
                required: "Este campo é obrigatório",
                cpfV: "Insira um CPF válido"
            },
            rg: {
                required: "Este campo é obrigatório",
                minlength: "Insira um RG válido"
            },
            emissor:{
                required: "Inisira o Orgão Emissor do seu RG"
            },
            dataNascimento: {
                required: "Este campo é obrigatório",
                dateNasc: "Insira um data válida (dd/mm/aaaa)"
            },
            sexo: "Por favor escolha um sexo",
            estadoCivil: "Uma opção precisa ser escolhida",
            email: {
                required: "Este campo é obrigatório",
                email: "Insira um EMAIL válido"
            },
            nomeMae: "Este campo é obrigatório",
            aceito: "Você precisa aceitar os termos do contrato"
        }
    });
}
