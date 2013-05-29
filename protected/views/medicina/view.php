<?php
$this->breadcrumbs=array(
	'Medicinas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Medicina'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Medicina'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Medicina'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Medicina'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Manage Medicina'), 'url'=>array('admin')),
);
?>

<h1>View Medicina #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'presentacion',
		'unidad',
		'unidadPatron',
	),
)); ?>


<ul><?php foreach($model->recipes as $foreignobj) { 

				printf('<li>%s</li>', CHtml::link($foreignobj->indicaciones, array('recipe/view', 'id' => $foreignobj->id)));

				} ?></ul>