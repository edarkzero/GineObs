<?php
/* @var $this PacienteController */
/* @var $model Paciente */
/* @var $form CActiveForm */

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl.'/themes/hebo/css/tabForm.css?v=1');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        )
)); ?>

        <?php echo $form->errorSummary($model); ?>

    <?php $this->widget('bootstrap.widgets.TbTabs', array(
        'id' => 'tab-form',
        'type'=>'tabs', // 'tabs' or 'pills'
        'tabs'=>array(
            array('label'=>'Datos Personales', 'content'=>$this->renderPartial('_formPersonalData',array('form' => $form,'model' => $model),true),'active'=>true,'htmlOptions'=>array('class'=>'tabForm')),
            array('label'=>'Datos de Analisis', 'content'=>$this->renderPartial('_formAnalisisData',array('form' => $form,'model' => $model),true),'htmlOptions'=>array('class'=>'tabForm')),
        ),
    )); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->