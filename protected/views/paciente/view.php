<?php
/* @var $this PacienteController */
/* @var $model Paciente */

$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Crear Paciente', 'url'=>array('create')),
	array('label'=>'Actualizar Paciente', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Paciente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Pacientes', 'url'=>array('admin')),
);
?>

<h1>Ver Paciente #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre1',
		'nombre2',
		'apellido1',
		'apellido2',
		'direccion',
		'telefono1',
		'telefono2',
		'correo',
		array(
                    'name'=>'edo_civil',
                    'type'=>'raw',
                    'value'=>$this->getEdoCivil($model->id),
                ),
		'fecha_ingreso',
		'fecha_nacimiento',
		'ante_familiares',
		'ante_personales',
		'menarquia',
		'tipo_regla',
		'gesta',
		'para',
		'aborto',
		'cesarea',
		'cesarea_descrip',
		'fue',
		'pmf',
	),
)); ?>
