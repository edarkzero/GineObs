<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Recipes', 'url'=>array('index')),
	array('label'=>'Crear Recipe', 'url'=>array('create')),
	array('label'=>'Actualizar Recipe', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Recipe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Recipes', 'url'=>array('admin')),
);
?>

<h1>Ver Recipe #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
                    'label'=>'id',
                    'type'=>'raw',
                    'value'=>CHtml::link(CHtml::encode($model->id),
                                         array('view','id'=>$model->id)),
                ),
		array(
                    'name' => 'recipeMedicinas',
                    'type' => 'raw',
                    'value' => $this->visualizarArreglo($model->recipeMedicinas,"nombre"),
                ),
                'indicaciones',
		'fecha',
		'paciente_id',
                'paciente.nombre1',
                'paciente.apellido1',
	),
)); ?>
