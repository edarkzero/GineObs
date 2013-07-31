<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */
/* @var $model_historia_paciente HistoriaObstetricia[] */

$this->breadcrumbs=array(
	'Historias Obstetricia'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Historias Obstetricia', 'url'=>array('index')),
	array('label'=>'Crear Historia Obstetricia', 'url'=>array('create')),
	array('label'=>'Actualizar Historia Obstetricia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Historia Obstetricia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Historias Obstetricia', 'url'=>array('admin')),
);
?>

<h1>Ver Historia de Obstetricia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'fecha',
		'peso',
		array(
                    'name' => 'tension_arterial',
                    'type' => 'raw',
                    'value' => $this->getTensionArterial($model->id),
                ),
		'altura_uterina',
		'foco_fetal',
		'edad_embarazo',
		'edemas',
		'otros',
	),
)); ?>

<h2>Historias</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model_historia_paciente,
    'itemView' => '_historias_obstetricia',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>
