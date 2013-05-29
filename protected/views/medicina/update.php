<?php
$this->breadcrumbs=array(
	'Medicinas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Medicina', 'url'=>array('index')),
	array('label'=>'Create Medicina', 'url'=>array('create')),
	array('label'=>'View Medicina', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Medicina', 'url'=>array('admin')),
);
?>

<h1> Actualizar Medicina #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'medicina-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
