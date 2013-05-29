<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Recipes', 'url'=>array('index')),
	array('label'=>'Administrar Recipes', 'url'=>array('admin')),
);
?>

<h1>Crear Recipe</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>