function applyMasks()
{
    $('#cpf').mask
    (
        '000.000.000-00'
    );

    $('#nascimento').mask
    (
        '00/00/0000'
    );

    $('#telCel').mask(SPMaskBehavior, spOptions);

    $('#telRes').mask(SPMaskBehavior, spOptions);

    $('#cep').mask
    (
        '00000-000'
    );

    $('#rcpf').mask
    (
        '000.000.000-00'
    );

    triggerSelect();
}

function triggerSelect()
{
    $.each($('select.tmz-auto-save'),function(i,elem){
        var id = $(elem).attr('id');
        $(elem).val($('[aria-select='+id+']').val());
        $(elem).material_select();
    });
}

var SPMaskBehavior = function (val)
    {
        return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
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