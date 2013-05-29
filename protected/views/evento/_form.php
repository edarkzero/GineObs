<?php
/* @var $this EventoController */
/* @var $model Evento */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaInicio'); ?>
		<?php echo $form->textField($model,'fechaInicio'); ?>
		<?php echo $form->error($model,'fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaFin'); ?>
		<?php echo $form->textField($model,'fechaFin'); ?>
		<?php echo $form->error($model,'fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->