<?php
/* @var $this EnfermedadController */
/* @var $model Enfermedad */

$this->breadcrumbs=array(
	'Enfermedades'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Enfermedades', 'url'=>array('index')),
	array('label'=>'Administrar Enfermedades', 'url'=>array('admin')),
);
?>

<h1>Crear Enfermedad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>