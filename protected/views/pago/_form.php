<?php
/* @var $this PagoController */
/* @var $model Pago */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pago-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'paga'); ?>
		<?php echo $form->textField($model,'paga'); ?>
		<?php echo $form->error($model,'paga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_id'); ?>
		<?php echo $form->dropDownList($model,'paciente_id',CHtml::listData(Paciente::model()->findAll(array('order'=>'nombre1')),'id','nombreCompleto'),array('empty'=>'Seleccione paciente')); ?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->