<?php
/* @var $this CalendarioController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Eventos', 'url'=>array('index')),
	array('label'=>'Crear Evento', 'url'=>array('create')),
	array('label'=>'Ver Evento', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Eventos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Evento <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>