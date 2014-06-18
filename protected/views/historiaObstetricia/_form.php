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
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'attribute'=>'paciente_id',
            'model'=>$model,
            'sourceUrl'=>array('PacienteAutoComplete'),
            'options'=>array(
                'minLength'=>'0',
            ),
            'htmlOptions'=>array(
                'size'=>45,
                'maxlength'=>45,
            ),
        )); ?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>

        <?php echo $form->textField($model,'fecha',array('id' => 'fecha-dtp')); ?>

		<?php
/*			$this->widget('zii.widgets.jui.CJuiDatePicker',
						array(
						'model' => $model,
						'attribute' => 'fecha',
						'language' => Yii::app()->language,
						'options' => array(
										'dateFormat' => 'dd-mm-yy',
										'constrainInput' => 'false',
										'duration' => 'fast',
										'showAnim' => 'slide',
									),
							)
					);
					
		*/?>

        <?php echo $form->hiddenField($model,'fecha_alt',array('id' =>'fecha_alt')); ?>
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
        <?php echo $form->listBox($model,'foco_fetal',array('0' => '+','1' => '-')); ?>
		<?php echo $form->error($model,'foco_fetal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edad_embarazo'); ?>
		<?php echo $form->numberField($model,'edad_embarazo'); ?>
		<?php echo $form->error($model,'edad_embarazo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edemas'); ?>
        <?php echo $form->listBox($model,'edemas', array('0' => 'SI','1' => 'NO')); ?>
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