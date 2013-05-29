<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Recipes', 'url'=>array('index')),
	array('label'=>'Crear Recipe', 'url'=>array('create')),
	array('label'=>'Ver Recipe', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Recipes', 'url'=>array('admin')),
);
?>

<h1>Actualizar Recipe <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>