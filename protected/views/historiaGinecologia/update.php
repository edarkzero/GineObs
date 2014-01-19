<?php
/* @var $this HistoriaGinecologiaController */
/* @var $modelGineco HistoriaGinecologia */

$this->breadcrumbs=array(
	'Historia Ginecologias'=>array('index'),
	$modelGineco->id=>array('view','id'=>$modelGineco->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar HistoriaGinecologia', 'url'=>array('index')),
	array('label'=>'Crear HistoriaGinecologia', 'url'=>array('create')),
	array('label'=>'Ver HistoriaGinecologia', 'url'=>array('view', 'id'=>$modelGineco->id)),
	array('label'=>'Administrar HistoriaGinecologia', 'url'=>array('admin')),
    array('label' => 'Ver Historia Completa', 'url' => array('historia', 'id'=>$modelGineco->id)),
);
?>

<h1>Update HistoriaGinecologia <?php echo $modelGineco->id; ?></h1>

<?php echo $this->renderPartial('_form', array('modelGineco'=>$modelGineco)); ?>

    <h2>Historias</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model_historia_paciente,
    'itemView' => '_historias_ginecologias',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>