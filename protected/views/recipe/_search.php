<?php
/* @var $this RecipeController */
/* @var $model Recipe */
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
        
<!--        <div class="row">
		<?php //echo $form->label($model,'recipeMedicinas'); ?>
		<?php //echo $form->textField($model,'recipeMedicinas',array('size'=>8,'maxlength'=>8)); ?>
	</div>-->
    
	<div class="row">
		<?php echo $form->label($model,'indicaciones'); ?>
		<?php echo $form->textArea($model,'indicaciones',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'fecha',
                        'language' => 'es',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'constrainInput' => 'false',
                            'duration' => 'fast',
                            'showAnim' => 'slide',
                        ),
                            )
                    );
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paciente_id'); ?>
		<?php echo $form->textField($model,'paciente_id',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->