<?php
/* @var $this CalendarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calendarios',
);

$this->menu=array(
	array('label'=>'Create Calendario', 'url'=>array('create')),
	array('label'=>'Manage Calendario', 'url'=>array('admin')),
);
?>

<h1>Calendarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
