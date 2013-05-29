<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Pagos', 'url'=>array('index')),
	array('label'=>'Crear Pago', 'url'=>array('create')),
	array('label'=>'Registro de caja', 'url'=>array('caja')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pago-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Pagos</h1>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pago-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paga',
		'fecha',
		array(    
                    'name'=>'paciente_id',
                    'header'=>'Paciente',
                    'value'=>'Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)',
                    'filter'=> Paciente::GET_LISTA_NOMBRE_COMPLETO(),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
