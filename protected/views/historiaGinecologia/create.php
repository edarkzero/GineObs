<?php
/* @var $this HistoriaGinecologiaController */
/* @var $model HistoriaGinecologia */

$this->breadcrumbs=array(
	'Historia Ginecologias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistoriaGinecologia', 'url'=>array('index')),
	array('label'=>'Manage HistoriaGinecologia', 'url'=>array('admin')),
);
?>

<h1>Create HistoriaGinecologia</h1>

<?php echo $this->renderPartial('_form', array('modelGineco'=>$modelGineco)); ?>