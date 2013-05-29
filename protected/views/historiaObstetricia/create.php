<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */

$this->breadcrumbs=array(
	'Historias Obstetricia'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Historias Obstetricia', 'url'=>array('index')),
	array('label'=>'Administrar Historias Obstetricia', 'url'=>array('admin')),
);
?>

<h1>Crear Historias Obstetricia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>