<?php
/* @var $this CalendarioController */
/* @var $model Calendario */

$this->breadcrumbs=array(
	'Calendarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Calendario', 'url'=>array('index')),
	array('label'=>'Manage Calendario', 'url'=>array('admin')),
);
?>

<h1>Create Calendario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>