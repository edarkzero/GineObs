<?php
/* @var $this RecipeController */
/* @var $model Recipe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recipe-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'indicaciones'); ?>
		<?php echo $form->textArea($model,'indicaciones',array('rows'=>6, 'cols'=>100, 'wrap'=>"hard")); ?>
		<?php echo $form->error($model,'indicaciones'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'recipeMedicinas'); ?>
		<?php echo $form->dropDownList($model,'recipeMedicinas',Medicina::GET_LISTA_NOMBRE(),array('multiple'=>true)); ?>
		<?php echo $form->error($model,'recipeMedicinas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_id'); ?>
		<?php echo $form->dropDownList($model,'paciente_id', Paciente::GET_LISTA_NOMBRE_COMPLETO(),array('empty'=>'Seleccione paciente')); ?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar');?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->