$(document).ready(function () {
    select2Control();
    dashboardControl();
});

function select2Control()
{
    $(s2).select2({
        placeholder: placeHolderMsj,
        allowClear: true
    });

    $(s2).on("select2-selecting", function (e) {
        $('#changin-data').html('');
    });

    if(preSel != undefined && preSel != '-1')
        $(s2).select2('val',preSel);
}

function dashboardControl()
{
    $('.dashboard-item').click(function(e){
        var sel = $(s2).select2('val');
        
        if(sel == "" || sel == undefined) {
            $('#changin-data').html('<span class="text-danger">Debes seleccionar un paciente</span>');
            $(s2).select2("open");
            return;
        }
        var timerId = loadingText('#changin-data');

        $('.active-animated-item').removeClass('active-animated-item');
        $(this).addClass('active-animated-item');

        //Descomentar para usar por GET
        $('#opt').val($(this).attr('data-opt'));
        $('#dashboard-form').submit();

        //Descomentar para usar por AJAX POST
        /*$.post('loadData', {id: sel,opt: $(this).attr('data-opt')}, function (data) {
            clearInterval(timerId);
            $('#changin-data').html(data);
        });*/
    });
}

function loadingText(target)
{
    //IMPORTANT Must retrieve the id of the timer and stop it when you want

    var timerId = 0,
        originalText = 'Cargando',
        i  = 0;

    $(target).html(originalText);

    timerId = setInterval(function() {

        $(target).append(".");
        i++;

        if(i == 4)
        {
            $(target).html(originalText);
            i = 0;
        }

    }, 200);

    return timerId;
}