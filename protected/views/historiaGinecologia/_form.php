<?php
/* @var $this HistoriaGinecologiaController */
/* @var $modelGineco HistoriaGinecologia */
/* @var $form CActiveForm */

if(!isset($modelGineco) && isset($model))
    $modelGineco = $model;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historia-ginecologia-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($modelGineco); ?>

	<div class="row">
		<?php echo $form->labelEx($modelGineco,'paciente_id'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'attribute'=>'paciente_id',
            'model'=>$modelGineco,
            'sourceUrl'=>array('PacienteAutoComplete'),
            'options'=>array(
                'minLength'=>'0',
            ),
            'htmlOptions'=>array(
                'size'=>45,
                'maxlength'=>45,
            ),
        ));
        /*$form->dropDownList($modelGineco,'paciente_id',CHtml::listData(Paciente::model()->findAll(array('order'=>'nombre1')),'id','nombreCompleto'),array('empty'=>'Seleccione paciente'))*/;?>
        <?php echo $form->error($modelGineco,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelGineco,'fecha'); ?>

                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $modelGineco,
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
		<?php echo $form->error($modelGineco,'fecha'); ?>
	</div>

        <div class="row">
                <?php echo $form->labelEx($modelGineco,'ginecologiaEnfermedads'); ?>
                <?php echo $form->dropDownList($modelGineco,'ginecologiaEnfermedads', Enfermedad::GET_LISTA_NOMBRE(),array('multiple' => 'multiple')); ?>
                <?php echo $form->error($modelGineco,'ginecologiaEnfermedads'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($modelGineco,'motivo_consulta'); ?>
		<?php echo $form->textArea($modelGineco,'motivo_consulta',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelGineco,'motivo_consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelGineco,'examen_fisico'); ?>
		<?php echo $form->textArea($modelGineco,'examen_fisico',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelGineco,'examen_fisico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelGineco,'diagnostico'); ?>
		<?php echo $form->textArea($modelGineco,'diagnostico',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelGineco,'diagnostico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelGineco,'tratamiento'); ?>
		<?php echo $form->textArea($modelGineco,'tratamiento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelGineco,'tratamiento'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($modelGineco->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->