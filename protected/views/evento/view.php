<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'Borrar Evento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Eventos', 'url'=>array('admin')),
);
?>

<h1>Vista Evento #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                    'label'=>'Fecha Inicio',
                    'type'=>'raw',
                    'value'=>Evento::FORMATEAR_FECHA($model->fechaInicio),
                ),
		array(
                    'label'=>'Fecha Fin',
                    'type'=>'raw',
                    'value'=>Evento::FORMATEAR_FECHA($model->fechaFin),
                ),
		'descripcion',
	),
)); ?>
