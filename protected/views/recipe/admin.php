<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Recipe', 'url'=>array('index')),
	array('label'=>'Crear Recipe', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('recipe-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Recipes</h1>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'recipe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'indicaciones',
		'fecha',
		'paciente_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
