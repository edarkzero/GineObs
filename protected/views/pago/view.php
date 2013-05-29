<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Pago', 'url'=>array('index')),
	array('label'=>'Crear Pago', 'url'=>array('create')),
	array('label'=>'Actualizar Pago', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Pago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Pago', 'url'=>array('admin')),
);
?>

<h1>View Pago #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paga',
		'fecha',
		array(    
                    'name'=>'paciente_id',
                    'type' => 'raw',
                    'value'=>Paciente::GET_NOMBRE_COMPLETO_PK($model->paciente_id),
		),
	),
)); ?>
