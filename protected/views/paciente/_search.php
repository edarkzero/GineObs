<?php
/* @var $this PacienteController */
/* @var $model Paciente */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'id',
                    'mask' => '9?9999999',
                    'htmlOptions' => array('size' => 8)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre1'); ?>
		<?php echo $form->textField($model,'nombre1',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre2'); ?>
		<?php echo $form->textField($model,'nombre2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellido1'); ?>
		<?php echo $form->textField($model,'apellido1',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellido2'); ?>
		<?php echo $form->textField($model,'apellido2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textArea($model,'direccion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono1'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono1',
                    'mask' => '9?999-999-9999',
                    'htmlOptions' => array('size' => 11)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono2'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono2',
                    'mask' => '9?999-999-9999',
                    'htmlOptions' => array('size' => 11)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edo_civil'); ?>
		<?php echo $form->dropDownList($model,'edo_civil',array('0'=>'Soltera','1'=>'Casada','2'=>'Divorciada','3'=>'Viuda','4'=>'Concubino')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_ingreso'); ?>
		<?php echo $form->dateField($model,'fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_nacimiento'); ?>
		<?php echo $form->dateField($model,'fecha_nacimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ante_familiares'); ?>
		<?php echo $form->textArea($model,'ante_familiares',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ante_personales'); ?>
		<?php echo $form->textArea($model,'ante_personales',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'menarquia'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'menarquia',
                        $model->cargarMenuMenarquia(),
                        array('empty'=>'Seleccione numero')); 
                ?>	
</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_regla'); ?>
		<?php echo $form->textField($model,'tipo_regla',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gesta'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'gesta',
                    'mask' => '9',
                    'htmlOptions' => array('size' => 1)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'para'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'para',
                    'mask' => '9?9',
                    'htmlOptions' => array('size' => 2)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aborto'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'aborto',
                    'mask' => '9?9',
                    'htmlOptions' => array('size' => 2)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cesarea'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'cesarea',
                    'mask' => '9?9',
                    'htmlOptions' => array('size' => 2)
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cesarea_descrip'); ?>
		<?php echo $form->textArea($model,'cesarea_descrip',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fue'); ?>
		<?php echo $form->dateField($model,'fue'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pmf'); ?>
		<?php echo $form->textField($model,'pmf',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->