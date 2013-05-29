<?php
/* @var $this EnfermedadController */
/* @var $model Enfermedad */

$this->breadcrumbs=array(
	'Enfermedades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Enfermedades', 'url'=>array('index')),
	array('label'=>'Crear Enfermedad', 'url'=>array('create')),
	array('label'=>'Actualizar Enfermedad', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Enfermedad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro que desea eliminar este registro?')),
	array('label'=>'Administrar Enfermedades', 'url'=>array('admin')),
);
?>

<h1>Vista Enfermedad #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'descripcion',
		'fecha_creacion',
	),
)); ?>
