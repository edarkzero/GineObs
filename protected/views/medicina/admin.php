<?php
$this->breadcrumbs=array(
	'Medicinas'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'List Medicina'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create Medicina'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('medicina-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Administrar Medicinas</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medicina-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nombre',
		'presentacion',
		'unidad',
		'unidadPatron',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>