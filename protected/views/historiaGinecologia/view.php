<?php
/* @var $this HistoriaGinecologiaController */
/* @var $model HistoriaGinecologia */

$this->breadcrumbs=array(
	'Historia Ginecologias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar HistoriaGinecologia', 'url'=>array('index')),
	array('label'=>'Crear HistoriaGinecologia', 'url'=>array('create')),
	array('label'=>'Actualizar HistoriaGinecologia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar HistoriaGinecologia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar HistoriaGinecologia', 'url'=>array('admin')),
);
?>

<h1>View HistoriaGinecologia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
                    'label'=>'id',
                    'type'=>'raw',
                    'value'=>CHtml::link(CHtml::encode($model->id),
                                         array('view','id'=>$model->id)),
                ),
		'paciente_id',
		'fecha',
                array(
                    'name' => 'Enfermedades',
                    'type' => 'raw',
                    'value' => $this->visualizarArreglo($model->ginecologiaEnfermedads,"nombre"),
                ),
		'motivo_consulta',
		'dir_examen1',
		'dir_examen2',
		'examen_fisico',
		'diagnostico',
		'tratamiento',
	),
)); ?>
