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