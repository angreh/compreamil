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

    if( $('.tmz-auto-save').length ) {
        autoSaveField();
        applyMasks();
    }

    $('select').material_select();
    $('.modal-trigger').leanModal();
    $('ul.tabs').tabs();

    if( $('#pendentestable').length )
    {
        $('#pendentestable,#test3 table').DataTable({
            pageLength: 15,
            language: {
                "decimal":        "",
                "emptyTable":     "No data available in table",
                //"info":           "Mostrando do _START_ to _END_ of _TOTAL_ entries",
                "info":           "Mostrando do _START_ ao _END_ de _TOTAL_ registro(s)",
                "infoEmpty":      "Showing 0 to 0 of 0 entries",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Show _MENU_ entries",
                "loadingRecords": "Loading...",
                "processing":     "Processing...",
                "search":         "Search:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });

        $('.tabs .tab a').on(
            'click',
            function()
            {
                //$('#pendentestable,#test3 table').columns.adjust().draw();
            }
        );
    }
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

var timeoutController = {};
function autoSaveField()
{
    $('.tmz-auto-save').on(
        'input propertychange change',
        function()
        {
            var id = $(this).attr('aria-field');
            var field = this;
            if( timeoutController.hasOwnProperty(id) ) clearTimeout(timeoutController[id]);
            timeoutController[id] = setTimeout(function()
            {
                var fieldID = field.hasAttribute('aria-id')?$(field).attr('aria-id'):false;
                var orderID = $('#pedidoID').val();
                var table = $(field).attr('aria-table');
                var value = $(field).val();
                autoSave(id,table,value,orderID,fieldID);
            }, 1500);
        }
    );
}

function autoSave(id,table,value,orderID,fieldID)
{
    $('.tmz-mini-alert').slideDown();
    fieldID = (fieldID===false)?'':'&fieldID=' + fieldID;
    $.ajax({
        method: 'post',
        url: '/adm/autosave',
        data: 'id=' + id + '&table=' + table + '&value=' + value + '&orderID=' + orderID + fieldID,
        success: function()
        {
            $('.tmz-mini-alert').slideUp(500);
        }
    });
}