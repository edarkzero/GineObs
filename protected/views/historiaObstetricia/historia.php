<?php
/* @var $this HistoriaObstetriciaController */
/* @var $historia mixed */
/* @var $model int */

$this->breadcrumbs=array(
    'Historia Ginecologias'=>array('Historia'),
    $model,
);

$this->menu=array(
    array('label'=>'Crear HistoriaGinecologia', 'url'=>array('create')),
    array('label'=>'Administrar HistoriaGinecologia', 'url'=>array('admin')),
);
?>

    <h1>Vista de historias de paciente #<?php echo $model; ?></h1>

    <h2>Historia Ginecologica</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$historia[0],
    'itemView' => '_historias_ginecologias',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>

    <h2>Historia de Obstetricia</h2>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$historia[1],
    'itemView' => '_historias_ginecologias',
    'ajaxUpdate'=>true,
    'enablePagination'=>true,
));
?>