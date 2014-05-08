$(document).ready(function () {
    $('#paciente-multiselect').select2({
        placeholder: placeHolderMsj,
        allowClear: true
    });

    $('#paciente-multiselect').on("select2-selecting", function(e) {
        $.post('paciente',{id: e.val},function(data){
            $('#paciente-data').html(data);
        });
    });
});