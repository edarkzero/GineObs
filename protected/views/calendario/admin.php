<?php
/* @var $this CalendarioController */
/* @var $model Evento */
/* @var $model_paciente Paciente[] */
/* @var $calendarJSON Evento[] */
/* @var $autoCompletePaciente string */

$this->breadcrumbs = array(
    'Calendario' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Administracion de calendario', 'url' => 'admin'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('evento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<?php
Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl . '/assets/bb742cb6/fullcalendar/fullcalendar.css');
Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl . '/js/jquery/themes/base/jquery-ui.css');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/assets/bb742cb6/fullcalendar/jquery-ui-1.8.23.custom.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery/jquery.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery/ui/jquery-ui.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/assets/bb742cb6/fullcalendar/fullcalendar.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquerydialog.js');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/calendarioCRUD.js');
?>

<!--<script>
    var calendarJSON = "<//?php echo $calendarJSON; ?>" ;
    document.write("VariableJS = " + calendarJSON);
    calendarioCRUD('calendar', calendarJSON);
</script>-->

<script>

var availableTags = [
    <?php echo $autoCompletePaciente; ?>
];

$(document).ready(function () {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var datosArray = []; //0: fecha Inicio, 1:fecha Final, 2: descripcion
    var dateS, dateF;
    var contenidoOpciones = '<p class="dialog_head">Por favor, elija una opcion.</p><p class="dialog_tip">Visualizar: para ver detalles del evento actual.</p><p class="dialog_tip">Eliminar: elimina completamente los datos del evento actual.</p><p class="dialog_tip">Editar: permite cambiar los datos del evento actual.</p><p id="calenError" class="errorMessage-calendar"></p>';
    var contenidoIngresar = '<p class="dialog_head">Por favor ingrese la descripcion del evento.</p><form><fildset><textarea name="descripcion" id="descripcion" class="dialog_textarea" rows="5"/></fieldset></form><p id="calenError" class="errorMessage-calendar"></p>';
    var contenidoEditar = '<p class="dialog_head">Por favor ingrese la nueva descripcion del evento.</p><form><fildset><textarea name="descripcion" id="descripcion" class="dialog_textarea" rows="5"/></fieldset></form><p id="calenError" class="errorMessage-calendar"></p>';
    var contenidoEliminar = '<p class="dialog_head">¿Desea eliminar este evento?.</p>';
    var citaIngresar = '<p class="dialog_head">Por favor ingrese los siguientes datos.</p><form><fildset><div class="ui-widget"><label for="pacienteAC">Paciente: </label><input id="pacienteAC" /></div><br/><label for="descripcion">Descripcion</label> <textarea name="descripcion" id="descripcion" class="dialog_textarea" rows="5"/></fieldset></form><p id="calenError" class="errorMessage-calendar"></p>';
    var citaEditar = '<p class="dialog_head">Por favor ingrese la nueva información de cita.</p><form><fildset><div class="ui-widget"><label for="pacienteAC">Paciente: </label><input id="pacienteAC" /></div><br/><label for="descripcion">Descripcion</label> <textarea name="descripcion" id="descripcion" class="dialog_textarea" rows="5"/></fieldset></form><p id="calenError" class="errorMessage-calendar"></p>';

    var contenidoTipoCalendario = '<p class="dialog_head">Que tipo de actividad realizará?.</p><p class="dialog_tip">Eventos: para registrar eventos cotidianos.</p><p class="dialog_tip">Citas: para registrar citas de pacientes.</p><p id="calenError" class="errorMessage-calendar"></p>';

    var msjError = "El campo descripcion no puede estar vacio.";

    var calendar = $('#calendar').fullCalendar({

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
                view: 'month'
            },
            titleFormat: {
                week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d, yyyy}"
            },

            allDayText: 'Todo el Día',
            firstHour: 8,
            minTime: 8,
            maxTime: 18,
            selectable: true,
            editable: true,
            weekends: false,
            selectHelper: true,
            defaultView: 'agendaWeek',

            buttonText: {prev: '&nbsp;&#9668;&nbsp;',
                next: '&nbsp;&#9658;&nbsp;',
                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'día',
                allDay: 'completo'},

            monthNames: ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            monthNamesShort: ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
            dayNamesShort: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],

            events: [<?php echo $calendarJSON ?>],

            select: function (start, end, allDay) {
                dateS = start;
                dateF = end;

                $("#dialog-tipo-evento").html(contenidoTipoCalendario);

                $("#dialog-tipo-evento").dialog({
                    autoOpen: true,
                    height: 300,
                    width: 400,
                    modal: true,
                    buttons: {
                        "Evento": {
                            id: "dialog-button-evento",
                            text: "Evento",

                            click: function () {
                                $(this).dialog("close");

                                $("#dialog-add").html(contenidoIngresar);

                                $("#dialog-add").dialog({
                                    autoOpen: true,
                                    height: 300,
                                    width: 400,
                                    modal: true,
                                    buttons: {
                                        "Aceptar": function () {

                                            if ($("#descripcion").val() != "") {
                                                datosArray[0] = $.fullCalendar.formatDate(dateS, "yyyy-MM-dd HH:mm:ss");
                                                datosArray[1] = $.fullCalendar.formatDate(dateF, "yyyy-MM-dd HH:mm:ss");
                                                datosArray[2] = $("#descripcion").val();

                                                $.post("Create", {type: 0, data: datosArray}, function (data, status) {
                                                    var ID = data;
                                                    calendar.fullCalendar('renderEvent',
                                                        {
                                                            id: ID,
                                                            title: datosArray[2],
                                                            description: datosArray[2],
                                                            start: dateS,
                                                            end: dateF,
                                                            allDay: false
                                                        },
                                                        true // make the event "stick"
                                                    );
                                                });

                                                $(this).dialog("close");

                                            }

                                            else {
                                                $(".errorMessage-calendar").html(msjError);
                                            }

                                        },

                                        "Cancelar": function () {
                                            $(this).dialog("close");
                                        }
                                    },
                                    close: function () {
                                    }
                                });

                            }
                        },
                        "Cita": {
                            id: "dialog-button-cita",
                            text: "Cita",

                            click: function () {
                                $(this).dialog("close");

                                $("#cita-ingresar").html(citaIngresar);

                                $("#cita-ingresar").dialog({
                                    autoOpen: true,
                                    height: 300,
                                    width: 400,
                                    modal: true,
                                    buttons: {
                                        "Aceptar": function () {

                                            if ($("#descripcion").val() != "" && $("#pacienteAC").val() != "") {
                                                datosArray[0] = $.fullCalendar.formatDate(dateS, "yyyy-MM-dd HH:mm:ss");
                                                datosArray[1] = $.fullCalendar.formatDate(dateF, "yyyy-MM-dd HH:mm:ss");
                                                datosArray[2] = $("#pacienteAC").val().split("-")[0];
                                                datosArray[3] = $("#descripcion").val();

                                                $.post("Create", {type: 1, data: datosArray}, function (data, status) {
                                                    var ID = data;

                                                    if(ID == -1) return;

                                                    calendar.fullCalendar('renderEvent',
                                                        {
                                                            id: ID,
                                                            title: "Paciente: " + datosArray[2] + "\n\n" + datosArray[3],
                                                            description: "Paciente: " + datosArray[2] + "\n\n" + datosArray[3],
                                                            start: dateS,
                                                            end: dateF,
                                                            allDay: false
                                                        },
                                                        true // make the event "stick"
                                                    );
                                                });

                                                $(this).dialog("close");

                                            }

                                            else {
                                                $(".errorMessage-calendar").html("");

                                                if ($("#pacienteAC").val() == "" || $("#pacienteAC").val() == null) {
                                                    $(".errorMessage-calendar").append("El campo paciente no puede estar vacio.<br/>");
                                                }

                                                if ($("#cita-ingresar #descripcion").val() == "" || $("#descripcion").val() == null) {
                                                    $(".errorMessage-calendar").append(msjError + "<br/>");
                                                }

                                            }

                                        },

                                        "Cancelar": function () {
                                            $(this).dialog("close");
                                        }
                                    },
                                    close: function () {
                                    }
                                });

                                $( "#pacienteAC" ).autocomplete({
                                    source: availableTags
                                });

                                $("#descripcion").on('focusin',function(e)
                                {
                                    var text = $("#pacienteAC").val()
                                    $("#pacienteAC").val(text.split("-")[0]);
                                });

                            }
                        },
                        "Cerrar": {
                            id: "dialog-button-cerrar",
                            text: "Cerrar",

                            click: function () {
                                $(this).dialog("close");
                            }
                        }
                    },
                    close: function () {
                    }
                });

                calendar.fullCalendar('unselect');

            },

            eventClick: function (calEvent, jsEvent, view) {

                if ($("#dialog-options").html() == "")
                    $("#dialog-options").append(contenidoOpciones);

                $("#dialog-options").dialog({
                    autoOpen: true,
                    height: 250,
                    width: 450,
                    modal: true,
                    buttons: {
                        "Visualizar": function () {
                            location.href = "view?id=" + calEvent.id;
                        },
                        "Eliminar": function () {
                            $(this).dialog("close");
                            $("#dialog-del").html(contenidoEliminar);
                            $("#dialog-del").dialog({
                                autoOpen: true,
                                height: 200,
                                width: 400,
                                modal: true,
                                buttons: {
                                    "Aceptar": function () {

                                        $.post("Delete", {id: calEvent.id}, function (data, status) {
                                            calendar.fullCalendar('removeEvents', calEvent.id);
                                        })

                                        $(this).dialog("close");

                                    },

                                    Cancel: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function () {
                                }
                            });

                        },
                        "Editar": function () {
                            $(this).dialog("close");
                            var dialogMode;
                            var texto = calEvent.title.split("\n\n",2);

                            if(calEvent.title.indexOf('Paciente:') == -1) {$("#dialog-edit").html(contenidoEditar);dialogMode = "#dialog-edit";}
                            else {$("#cita-editar").html(citaEditar);dialogMode = "#cita-editar";}

                            if(texto.length == 1)$("#descripcion").html(calEvent.title);
                            else{$("#descripcion").html(texto[1]);$("#cita-editar #pacienteAC").val(texto[0].replace('Paciente: ',''));}

                            $(dialogMode).dialog({
                                autoOpen: true,
                                height: 300,
                                width: 400,
                                modal: true,
                                buttons: {
                                    "Editar": function () {

                                        if ($("#descripcion").val() != "") {
                                            datosArray[0] = $.fullCalendar.formatDate(calEvent.start, "yyyy-MM-dd HH:mm:ss");
                                            datosArray[1] = $.fullCalendar.formatDate(calEvent.end, "yyyy-MM-dd HH:mm:ss");
                                            datosArray[2] = $("#descripcion").val();

                                            $.post("Update", {type:0,id: calEvent.id, data: datosArray}, function (data, status) {
                                                var calEvent_aux = calEvent;

                                                calendar.fullCalendar('removeEvents', calEvent_aux.id);

                                                calendar.fullCalendar('renderEvent',
                                                    {
                                                        id: calEvent_aux.id,
                                                        title: datosArray[2],
                                                        description: datosArray[2],
                                                        start: calEvent_aux.start,
                                                        end: calEvent_aux.end,
                                                        allDay: false
                                                    },
                                                    true // make the event "stick"
                                                );

                                            })

                                            $(this).dialog("close");

                                        }

                                        else {
                                            $(".errorMessage-calendar").html(msjError);
                                        }

                                    },

                                    "Cancelar": function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function () {
                                }
                            });

                        },

                        "Cancelar": function () {
                            $(this).dialog("close");
                        }
                    },
                    close: function () {
                    }
                });

            },

            eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc) {

                datosArray[0] = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                datosArray[1] = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                datosArray[2] = event.title.split("\n\n",2)[1];

                $.post("Update", {type: 0,id: event.id, data: datosArray}, function (data, status) {
                });

            },

            eventResize: function (event, dayDelta, minuteDelta, revertFunc) {

                datosArray[0] = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                datosArray[1] = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                datosArray[2] = event.title.split("\n\n",2)[1];

                $.post("Update", {type: 0,id: event.id, data: datosArray}, function (data, status) {
                });

            }


        }

    );

});
</script>

<div id="calendar" style="z-index: 1"></div>

<div id="dialog-options" title="Opciones para los eventos" style="z-index: 99999999999"></div>
<div id="dialog-add" title="Nuevo evento" style="z-index: 99999999999"></div>
<div id="dialog-edit" title="Editar evento" style="z-index: 99999999999"></div>
<div id="dialog-del" title="Eliminar evento" style="z-index: 99999999999"></div>
<div id="dialog-tipo-evento" title="Tipo de evento" style="z-index: 99999999999"></div>
<div id="cita-ingresar" title="Nueva cita" style="z-index: 99999999999"></div>
<div id="cita-editar" title="Editar cita" style="z-index: 99999999999"></div>