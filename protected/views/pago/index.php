<?php
/* @var $this PagoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pagos',
);

$this->menu=array(
	array('label'=>'Create Pago', 'url'=>array('create')),
	array('label'=>'Manage Pago', 'url'=>array('admin')),
);
?>

<h1>Pagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
