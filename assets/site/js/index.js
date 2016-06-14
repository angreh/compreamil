$(function()
{

    openHash();

    //form.functions
    if( $('#cpf').length )
    {
        applyMasks();
        applyTooltip();
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

    if( $( '#dep-add').length ) enableDepButtons();

    if( $( '.tmz-list-par').length ) enableContratar();
});

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