<?php
/* @var $this HistoriaGinecologiaController */
/* @var $modelGineco HistoriaGinecologia */

$this->breadcrumbs=array(
	'Historia Ginecologias'=>array('index'),
	$modelGineco->id=>array('view','id'=>$modelGineco->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistoriaGinecologia', 'url'=>array('index')),
	array('label'=>'Create HistoriaGinecologia', 'url'=>array('create')),
	array('label'=>'View HistoriaGinecologia', 'url'=>array('view', 'id'=>$modelGineco->id)),
	array('label'=>'Manage HistoriaGinecologia', 'url'=>array('admin')),
);
?>

<h1>Update HistoriaGinecologia <?php echo $modelGineco->id; ?></h1>

<?php echo $this->renderPartial('_form', array('modelGineco'=>$modelGineco)); ?>