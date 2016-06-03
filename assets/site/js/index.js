$(function()
{
    //form.functions
    if( $('#cpf').length )
    {
        applyMasks();
        applyTooltip();
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
