
function calendarioCRUD(idDiv,datosJSON) 
{
            $(document).ready(function() {

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var datosArray = []; //0: fecha Inicio, 1:fecha Final, 2: descripcion

            var calendar = $('#'+idDiv).fullCalendar({

                    header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay',
                            view: 'month'
                    },

                    allDayText: 'Todo el Día',
                    firstHour: 8,
                    selectable: true,
                    editable: true,
                    weekends: false,
                    selectHelper: true,
                    defaultView: 'agendaWeek',

                    buttonText: {prev: '&nbsp;&#9668;&nbsp;',
                                next: '&nbsp;&#9658;&nbsp;',
                                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                                today : 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'día',
                                allDay: 'completo'},

                     monthNames : ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                    'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
                     dayNames : ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes','Sabado'],
                     monthNamesShort : ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                    'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
                     dayNamesShort : ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes','Sabado'],

                    events: [datosJSON],

                    select: function(start, end, allDay) {
                            var title = prompt('Ingrese un nombre para el evento: ');
                            if (title) {

                                datosArray[0] = $.fullCalendar.formatDate(start,"yyyy-MM-dd HH:mm:ss");
                                datosArray[1] = $.fullCalendar.formatDate(end,"yyyy-MM-dd HH:mm:ss");
                                datosArray[2] = title;

                                $.post("Create",{data: datosArray},function(data,status){
                                    var ID = data;
                                    calendar.fullCalendar('renderEvent',
                                        {
                                                id: ID,
                                                title: title,
                                                description: title,
                                                start: start,
                                                end: end,
                                                allDay: false
                                        },
                                    true // make the event "stick"
                                    );
                                });

                            }

                            //LLamar a agregar y mandar estos datos
                            //ajaxCalendarCreateEvent(id,title,start,end);
                            calendar.fullCalendar('unselect');

                    },

                    eventClick: function(calEvent, jsEvent, view) {

                        var op = confirm('Desea eleminar este elemento ('+calEvent.id+')?');

                            //Mandar id a detele

                            if(op) {

                                    $.post("Delete",{id:calEvent.id},function(data,status){
                                        calendar.fullCalendar('removeEvents',calEvent.id);
                                    })

                            }

                            else {
                                var title = prompt('Ingrese un nuevo nombre para el evento: ',calEvent.title);

                                if (title) {
                                    datosArray[0] = $.fullCalendar.formatDate(calEvent.start,"yyyy-MM-dd HH:mm:ss");
                                    datosArray[1] = $.fullCalendar.formatDate(calEvent.end,"yyyy-MM-dd HH:mm:ss");
                                    datosArray[2] = title;

                                    $.post("Update",{id: calEvent.id,data: datosArray},function(data,status){
                                        var calEvent_aux = calEvent;

                                        calendar.fullCalendar('removeEvents',calEvent_aux.id);

                                        calendar.fullCalendar('renderEvent',
                                        {
                                                id: calEvent_aux.id,
                                                title: title,
                                                description: title,
                                                start: calEvent_aux.start,
                                                end: calEvent_aux.end,
                                                allDay: false
                                        },
                                        true // make the event "stick"
                                        );

                                        //$('#calendar').fullCalendar('updateEvent', calEvent);
                                    })
                                }

                        }

//                            alert('Event: ' + calEvent.title);
//                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                            alert('View: ' + view.name);
//                            alert('id: ' + calEvent.id);

                    }

//                        eventMouseover: function(calEvent, domEvent) {
//                                var layer =	"<div id='events-layer' class='fc-transparent' style='position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100'> <a> <img border='0' style='padding-right:5px;' src='delete.gif' onClick='deleteEvent("+calEvent.id+");'></a></div>";
//                                $(this).append(layer);
//                        },   
//                        eventMouseout: function(calEvent, domEvent) {
//                                $("#events-layer").remove();
//                        },
                    //EJEMPLOS!
//                        events: [
//				{
//					title: 'All Day Event',
//					start: new Date(y, m, 1)
//				},
//				{
//					title: 'Long Event',
//					start: new Date(y, m, d-5),
//					end: new Date(y, m, d-2)
//				},
//				{
//					id: 999,
//					title: 'Repeating Event',
//					start: new Date(y, m, d-3, 16, 0),
//					allDay: false
//				},
//				{
//					id: 999,
//					title: 'Repeating Event',
//					start: new Date(y, m, d+4, 16, 0),
//					allDay: false
//				},
//				{
//					title: 'Meeting',
//					start: new Date(y, m, d, 10, 30),
//					allDay: false
//				},
//				{
//					title: 'Lunch',
//					start: new Date(y, m, d, 12, 0),
//					end: new Date(y, m, d, 14, 0),
//					allDay: false
//				},
//				{
//					title: 'Birthday Party',
//					start: new Date(y, m, d+1, 19, 0),
//					end: new Date(y, m, d+1, 22, 30),
//					allDay: false
//				},
//				{
//					title: 'Click for Google',
//					start: new Date(y, m, 28),
//					end: new Date(y, m, 29),
//					url: 'http://google.com/'
//				}
//			]
            }
            );

    });

}