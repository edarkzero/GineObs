$(document).ready(function (e) {
    dtpicker = $.parseJSON(dtpicker);

    if (dtpicker.selector != undefined) {
        $(dtpicker.selector).datetimepicker({
            format: dateTimeLongFormat,
            linkField: dtpicker.mirror,
            linkFormat: dateTimeBddFormat,
            language: lang,
            showMeridian: true,
            todayBtn: 'linked',
            forceParse: false
        });

        $(dtpicker.selector)
            .datetimepicker()
            .on('changeDate', function (ev) {
                ev = datetimePickerLongFormatFix(ev);
            });

        $(dtpicker.selector)
            .datetimepicker()
            .on('hide', function (ev) {
                ev = datetimePickerLongFormatFix(ev);
            });

        $(dtpicker.selector)
            .datetimepicker()
            .on('show', function (ev) {
                ev = datetimePickerLongFormatFix(ev);
            });
    }
});


function datetimePickerLongFormatFix(ev)
{
    ev.target.value = ev.target.value.replace('$$', 'de');
    ev.target.value = ev.target.value.replace('$$', 'de');

    return ev;
}