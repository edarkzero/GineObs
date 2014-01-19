<?php
/* @var $this HistoriaGinecologiaController */
/* @var $model HistoriaGinecologia */
/* @var $model_historia_paciente HistoriaGinecologia[] */

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
    array('label' => 'Ver Historia Completa', 'url' => array('historia', 'id'=>$model->id)),
);
?>

<h1>Vista HistoriaGinecologia #<?php echo $model->id; ?></h1>

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
		'examen_fisico',
		'diagnostico',
		'tratamiento',
	),
)); ?>

    <h2>Historias</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model_historia_paciente,
    'itemView' => '_historias_ginecologias',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>