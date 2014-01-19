<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */

$this->breadcrumbs=array(
	'Historias Obstetricia'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Historias Obstetricia', 'url'=>array('index')),
	array('label'=>'Crear Historia Obstetricia', 'url'=>array('create')),
	array('label'=>'Ver Historia Obstetricia', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Historias Obstetricia', 'url'=>array('admin')),
    array('label' => 'Ver Historia Completa', 'url' => array('historia', 'id'=>$model->id)),
);
?>

<h1>Actualizar Historia Obstetricia <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<h2>Historias</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model_historia_paciente,
    'itemView' => '_historias_obstetricia',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>