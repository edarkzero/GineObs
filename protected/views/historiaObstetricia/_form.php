<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historia-obstetricia-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_id'); ?>
		<?php echo $form->dropDownList($model,'paciente_id',CHtml::listData(Paciente::model()->findAll(array('order'=>'nombre1')),'id','nombreCompleto'),array('empty'=>'Seleccione paciente')); ?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',
						array(
						'model' => $model,
						'attribute' => 'fecha',
						'language' => 'es',
						'options' => array(
										'dateFormat' => 'dd-mm-yy',
										'constrainInput' => 'false',
										'duration' => 'fast',
										'showAnim' => 'slide',
									),
							)
					);
					
		?>
		
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'peso'); ?>
		<?php echo $form->textField($model,'peso'); ?>
		<?php echo $form->error($model,'peso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tension_arterial'); ?>
		<?php echo $form->numberField($model,'tension_arterial_mm',array('size'=>11,'maxlength'=>11, 'class'=>'campoDependiente')); ?>
		<?php echo $form->error($model,'tension_arterial_mm'); ?>
        </div>
        
        <div class="row">
                <?php echo $form->numberField($model,'tension_arterial_hg',array('size'=>11,'maxlength'=>11, 'class'=>'campoDependiente')); ?>
		<?php echo $form->error($model,'tension_arterial_hg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'altura_uterina'); ?>
		<?php echo $form->textField($model,'altura_uterina'); ?>
		<?php echo $form->error($model,'altura_uterina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foco_fetal'); ?>
		
		<?php echo '+ '.$form->radioButton($model,'foco_fetal',array('value'=>'0','checked'=>'checked')); ?>
		<?php echo '- '.$form->radioButton($model,'foco_fetal',array('value'=>'1')); ?>
		<?php echo $form->error($model,'foco_fetal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edad_embarazo'); ?>
		<?php echo $form->numberField($model,'edad_embarazo'); ?>
		<?php echo $form->error($model,'edad_embarazo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edemas'); ?>
		<?php echo 'Si '.$form->radioButton($model,'edemas',array('value'=>'0','checked'=>'checked')); ?>
		<?php echo 'No '.$form->radioButton($model,'edemas',array('value'=>'1')); ?>
		<?php echo $form->error($model,'edemas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otros'); ?>
		<?php echo $form->textArea($model,'otros',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otros'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->