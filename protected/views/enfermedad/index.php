<?php
/* @var $this EnfermedadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Enfermedades',
);

$this->menu=array(
	array('label'=>'Crear Enfermedad', 'url'=>array('create')),
	array('label'=>'Administrar Enfermedades', 'url'=>array('admin')),
);
?>

<h1>Enfermedades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'cssFile'=>'/css/myCssFile.css',
)); ?>
