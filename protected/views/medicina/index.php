<?php
$this->breadcrumbs = array(
	'Medicinas',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Medicina', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Medicina', 'url'=>array('admin')),
);
?>

<h1>Medicinas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
