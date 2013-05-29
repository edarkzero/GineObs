<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paciente_id'); ?>
		<?php echo $form->textField($model,'paciente_id',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'peso'); ?>
		<?php echo $form->textField($model,'peso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tension_arterial'); ?>
		<?php echo $form->textField($model,'tension_arterial',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'altura_uterina'); ?>
		<?php echo $form->textField($model,'altura_uterina'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foco_fetal'); ?>
		<?php echo $form->textField($model,'foco_fetal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edad_embarazo'); ?>
		<?php echo $form->textField($model,'edad_embarazo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edemas'); ?>
		<?php echo $form->textField($model,'edemas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otros'); ?>
		<?php echo $form->textArea($model,'otros',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->