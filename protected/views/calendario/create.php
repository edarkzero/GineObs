<?php
/* @var $this CalendarioController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Eventos', 'url'=>array('index')),
	array('label'=>'Administrar Evento', 'url'=>array('admin')),
);
?>

<h1>Crear Evento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>