<?php
/* @var $this HistoriaGinecologiaController */
/* @var $modelGineco HistoriaGinecologia */
/* @var $form CActiveForm */
/* @var $dashboard bool */

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl.'/js/clockface/css/clockface.css?v=1');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/clockface/js/clockface.js?v=1',CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/timepicker.js?v=1',CClientScript::POS_END);

if(!isset($modelGineco) && isset($model))
    $modelGineco = $model;

$submitLabel = $modelGineco->isNewRecord ? 'Create' : 'Save';

if(isset($dashboard) && $dashboard)
    $formAction = $this->createUrl('/HistoriaGinecologia/'.strtolower($submitLabel));
else
    $formAction = null;
?>

<script>
    var tp = '#fecha_time';
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historia-ginecologia-form',
    'action' => $formAction,
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
                'language' => Yii::app()->language,
                'options' => array(
                    'dateFormat' => DateTools::LONG_DATE_FORMAT_JS,
                    'constrainInput' => 'false',
                    'duration' => 'fast',
                    'showAnim' => 'slide',
                    'altField' => '#fecha_alt',
                    'altFormat' => 'yy-mm-dd'
                ),
            )
        );
        ?>
        <?php echo $form->hiddenField($modelGineco,'fecha_alt',array('id' =>'fecha_alt')); ?>
		<?php echo $form->error($modelGineco,'fecha'); ?>

        <!--<input type="text" id="fecha_time" value="2:30 PM" readonly="" data-format="<?php /*echo DateTools::LONG_TIME_FORMAT_JS */?>" class="input-small">-->
        <?php echo $form->textField($modelGineco,'fecha_time',array('readonly' => true,'id' => 'fecha_time','data-format' => DateTools::LONG_TIME_FORMAT_JS,'class' => 'input-small')) ?>
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
		<?php echo CHtml::submitButton($submitLabel); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->