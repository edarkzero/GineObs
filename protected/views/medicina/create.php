<?php
$this->breadcrumbs=array(
	'Medicinas'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Medicina'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Admin Medicina'), 'url'=>array('admin')),
);
?>

<h1> Crear Medicina </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
