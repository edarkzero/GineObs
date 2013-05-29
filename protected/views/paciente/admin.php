<?php
/* @var $this PacienteController */
/* @var $model Paciente */

$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List Paciente', 'url'=>array('index')),
	array('label'=>'Create Paciente', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('paciente-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Pacientes</h1>

<p>
También puede escribir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre1',
		'apellido1',
//		'apellido2',
//		'direccion',
//		'telefono1',
//		'telefono2',
//		'correo',
//		array(
//                    'name'=>'edo_civil',
//                    'value'=>'Paciente::GET_EDO_CIVIL($data->id)',
//                ),
		'fecha_ingreso',
//		'fecha_nacimiento',
//		'ante_familiares',
//		'ante_personales',
//		'menarquia',
//		'tipo_regla',
//		'gesta',
//		'para',
//		'aborto',
//		'cesarea',
//		'cesarea_descrip',
//		'fue',
//		'pmf',
		array(			'class'=>'CButtonColumn',
		)
//                array(
//                    'class'=>'CLinkColumn',
//                    'imageUrl'=>Yii::app()->baseUrl.'/images/mail.png',
//                    'labelExpression'=>'$data->correo',
//                    'urlExpression'=>'"mailto://".$data->correo',
//                    'htmlOptions'=>array('style'=>'text-alignment:center'),
//                )
	),
)); ?>
</div>