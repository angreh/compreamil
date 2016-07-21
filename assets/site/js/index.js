$(function()
{

    openHash();

    //form.functions
    if( $('#cpf').length )
    {
        applyMasks();
        applyTooltip();
        applyFormValidators();
    }

    $( '.fulllist-show').on( 'click', function()
    {
        $( '.coberturas-fulllist').toggle(500,function(){
            scrollTo('.coberturas-fulllist');
        });
    });

    $( '.clicker').on('click',function(){
       openHash($(this).attr('href'));
        return true;
    });

    if( $('#orcamento-form').length )
    {
        applyOrcamentoFunctions();
    }

    if( $('#home_form').length || $( '#orcamento-form').length )
    {
        $('#telefone').mask( SPMaskBehavior, spOptions );
    }

    if( $('#home_form').length )
    {
        applyModalActions();
        $('#tmz-quanto-custa').on(
            'click',
            function()
            {
                var form = $("#home_form form");
                if( form.valid() )
                {
                    $.ajax({
                        method: 'post',
                        url: '/ajaxestimate',
                        data: form.serialize(),
                        success: function()
                        {
                            window.location.href = "/orcamento";
                        }
                    });
                }
            }
        );
    }

    if( $( '#dep-add').length ) enableDepButtons();

    if( $( '.tmz-list-par').length ) enableContratar();

    $(".estimate-request").on(
        'click',
        function(){
            window.location.href = "/orcamento";
        }
    );

    if( $('#preset').length )
    {
        var presetAux = $('#preset').val();
        $('#' + presetAux).click();
    }

});

function orcamentoPreset( type, qtd )
{
    $.ajax({
        url: '/orcamento/preset',
        method: 'post',
        data: 'type=' + type + '&qtd=' + qtd,
        success: function(data)
        {
            if(data == 'Ok')
            {
                window.location.href='/cadastro';
            }
        }
    });
}

$.fn.centerH = function()
{
    var obj = this;

    obj.css({
        'top' : '50%',
        'margin-top' : function() { return - obj.outerHeight()/2 }
    });
}

function scrollTo( objectSelector )
{
    var offset = $( objectSelector ).offset();
    var scrollTop = offset.top - 60;

    $( 'html,body').animate({
        scrollTop: scrollTop
    }, 200);
    return false;
}

function openHash( hash )
{
    if( hash == undefined )
    {
        hash = window.location.hash;
    }

    if( hash.length > 1 ){
        hash = '.' + hash.substring(1);

        var pageSelector = hash;

        $( '.tmz-content' ).slideUp(0,function(){
            $( pageSelector ).slideDown(300,function(){
                scrollTo( pageSelector );
            });
        });
    }

}
function applyOrcamentoFunctions()
{
    $('#orcamento-form').submit(function(){
        orcSubmit();
        return false;
    });
}

function orcSubmit(){
    var formData = $('#orcamento-form').serialize();

    if( $( '.ALERTS_ERRORS' ).length )
    {
        $( '.ALERTS_ERRORS' ).slideUp();
    }

    $.ajax({
        method: 'POST',
        url: '/orcamento/calc',
        data: formData,
        success: function(data)
        {
            if(data == 'redirect'){
                location.reload(true);
            }
            $( '.tmz-infos').html(data);
        }
    });
}

function enableDepButtons()
{
    $( '#dep-add').on('click', function(){
        $( '.tmz-dependents-list').slideUp();
        $( 'button.form-next').slideUp();
        $( '.tmz-dependent-data').slideDown();
    });

    $( '.tmz-include-button-cancel').on('click',function(){
        $( '.tmz-dependents-list').slideDown();
        $( 'button.form-next').slideDown();
        $( '.tmz-dependent-data').slideUp();

    });

}

var showingCardData = false;

function enableContratar()
{
    $( '.tmz-list-par li').on(
        'click',
        function()
        {
            $( 'input', this ).prop('checked', true);
        }
    );

    $( '.tmz-pick-band li').on(
        'click',
        function()
        {
            $( 'input', this).prop('checked', true);
        }
    );

    $( '#tmz-form-pag-actions').on(
        'click',
        function()
        {
            if(showingCardData) return true;

            var radioValue = $( 'input[name=tmz-form-pag]:checked').val();

            if(radioValue == undefined)
            {
                alert('Você precisa escolher um forma de pagamento!');
                return false;
            }
            else
            {
                radioValue = radioValue.substring(0,4);

                if(radioValue == 'card')
                {
                    $( '.tmz-pag2-wrapper').slideUp();
                    $( '#tmz-title-pag-fck').slideUp();
                    $( '.tmz-wrapper-cartao').slideDown();
                    showingCardData = true;
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }
    );
}

var globalModalHome = null;

function applyModalActions()
{
    globalModalHome = $('[data-remodal-id=modal-ask]').remodal({hashTracking: false, closeOnOutsideClick: false});
    //$('[data-remodal-id=modal-confirm]').remodal({hashTracking: false});
    $('.tmz-remodal-option.submit').on(
        'click',
        function()
        {
            checkHomeForm();
        }
    );
    $('.tmz-remodal-option.call').on(
        'click',
        function()
        {
            $('#solicitaLigacao').val('sim');
            checkHomeForm();
        }
    );

    applyHomeValitador();
}
function checkHomeForm()
{
    var form = $("#home_form form");
    if( form.valid() ){
        form.submit();
    } else {
        globalModalHome.close();
    }
}

function applyHomeValitador()
{
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
    $('#home_form form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            telephone: {
                required: true,
                phone: true
            }
        },
        messages: {
            name: {
                required: "Por favor insira seu nome",
                minlength: "Por favor insira um valor válido"
            },
            email: {
                required: "Este campo é obrigatório",
                email: "Por favor insira um email válido"
            },
            telephone: {
                required: "Este campo é obrigatório"
            }

        }
    });
}