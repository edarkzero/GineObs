<?php
/* @var $this EnfermedadController */
/* @var $model Enfermedad */

$this->breadcrumbs=array(
	'Enfermedades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Enfermedades', 'url'=>array('index')),
	array('label'=>'Crear Enfermedad', 'url'=>array('create')),
	array('label'=>'Ver Enfermedad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Enfermedades', 'url'=>array('admin')),
);
?>

<h1>Actualizar Enfermedad <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>