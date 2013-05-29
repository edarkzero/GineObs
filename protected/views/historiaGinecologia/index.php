<?php
/* @var $this HistoriaGinecologiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historia Ginecologias',
);

$this->menu=array(
	array('label'=>'Create HistoriaGinecologia', 'url'=>array('create')),
	array('label'=>'Manage HistoriaGinecologia', 'url'=>array('admin')),
);
?>

<h1>Historia Ginecologias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
