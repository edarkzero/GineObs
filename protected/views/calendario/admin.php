<?php
/* @var $this CalendarioController */
/* @var $model Calendario */

$this->breadcrumbs=array(
	'Calendarios'=>array('admin'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('calendario-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<link rel='stylesheet' type='text/css' href='http://localhost/Gineobs/assets/bb742cb6/fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='http://localhost/Gineobs/assets/bb742cb6/fullcalendar/fullcalendar.js'></script>
<script type='text/javascript' src='http://localhost/Gineobs/assets/bb742cb6/fullcalendar/jquery-ui-1.8.23.custom.min.js'></script>

<script>

		$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
                        
                        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
                        weekends: false,
			selectHelper: true,
                        
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

			select: function(start, end, allDay) {
				var title = prompt('Nombre de evento:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
                                                        description: title,
							start: start,
							end: end,
							allDay: false
                                                        
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
                        
                        eventClick: function(calEvent, jsEvent, view) {
                            
                            var op = confirm('Desea eleminar este elemento?');
				
                                if(op) {
					calendar.fullCalendar('removeEvents',calEvent.id);
                                }
                                
//                            alert('Event: ' + calEvent.title);
//                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                            alert('View: ' + view.name);

                        },
                        
			editable: true
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
</script>

<div id="calendar"></div>

<h1>Manage Calendarios</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'calendario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>