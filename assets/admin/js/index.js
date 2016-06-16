$.fn.centerH = function()
{
    var obj = this;

    obj.css({
        'margin-top' : function() { return - obj.outerHeight()/2 }
    });
}

$(function(){
    $('.button-collapse').sideNav({
            menuWidth: 240, // Default is 240
            edge: 'left', // Choose the horizontal origin
            closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
        }
    );
    $('.collapsible').collapsible();

    if( $('.tmz-order-status').length ) setStatusRealValue();

    if( $('.tmz-user-nivel').length ) setNivel();

    if( $('#usuarios-edit').length ) initUserEditForm();

    $('select').material_select();
    $('.modal-trigger').leanModal();
    $('ul.tabs').tabs();
});

function setStatusRealValue()
{
    $.each( $('.tmz-order-status'), function()
    {
        var status = $(this).html();
        switch(status)
        {
            case '1':
                $(this).html('<div class="tmz-order-inc">incompleto</div>');
                break;
            case '3':
                $(this).html('<div class="tmz-order-comp">completo</div>');
                break;
            case '4':
                $(this).html('<div class="tmz-order-orcamento">orçamento</div>');
                break;
            case '5':
                $(this).html('<div class="tmz-order-sollig">sol. ligação</div>');
                break;
        }
    });
    //$('#login-form-card').centerH();
}

function setNivel()
{
    $.each( $('.tmz-user-nivel'), function()
    {
        var status = $(this).html();
        switch(status)
        {
            case '0':
                $(this).html('<div class="tmz-order-inc">Administrador</div>');
                break;
            case '1':
                $(this).html('<div class="tmz-order-sollig">Corretor</div>');
                break;
        }
    });
}

function initUserEditForm()
{
    var option = $(".tmz-select-label select").attr('id');
    option = option.substring(5);
    $(".tmz-select-label select").val(option);
    $('select').material_select();
}