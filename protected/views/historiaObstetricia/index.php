<?php
/* @var $this HistoriaObstetriciaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historias Obstetricia',
);

$this->menu=array(
	array('label'=>'Crear Historia Obstetricia', 'url'=>array('create')),
	array('label'=>'Administrar Historias Obstetricia', 'url'=>array('admin')),
);
?>

<h1>Historias de Obstetricia</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
