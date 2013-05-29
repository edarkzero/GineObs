<?php
/* @var $this CalendarioController */
/* @var $model Calendario */

$this->breadcrumbs=array(
	'Calendarios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Calendario', 'url'=>array('index')),
	array('label'=>'Create Calendario', 'url'=>array('create')),
	array('label'=>'Update Calendario', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Calendario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Calendario', 'url'=>array('admin')),
);
?>

<h1>View Calendario #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
	),
)); ?>
