$(document).ready(function () {
    $('#paciente-multiselect').select2({
        placeholder: placeHolderMsj,
        allowClear: true
    });

    $('#paciente-multiselect').on("select2-selecting", function (e) {
        var timerId = 0,
            originalText = 'Cargando',
            i  = 0;

        $("#paciente-data").html(originalText);

        timerId = setInterval(function() {

            $("#paciente-data").append(".");
            i++;

            if(i == 4)
            {
                $("#paciente-data").html(originalText);
                i = 0;
            }

        }, 200);

        $.post('paciente', {id: e.val}, function (data) {
            clearInterval(timerId);
            $('#paciente-data').html(data);
        });
    });
});