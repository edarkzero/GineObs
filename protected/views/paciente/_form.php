<?php
/* @var $this PacienteController */
/* @var $model Paciente */
/* @var $form CActiveForm */
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

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'id',
                    'mask' => '9?9999999',
                    'htmlOptions' => array('size' => 8)
                    ));
                ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre1'); ?>
		<?php echo $form->textField($model,'nombre1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'nombre1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre2'); ?>
		<?php echo $form->textField($model,'nombre2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'nombre2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido1'); ?>
		<?php echo $form->textField($model,'apellido1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'apellido1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido2'); ?>
		<?php echo $form->textField($model,'apellido2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'apellido2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textArea($model,'direccion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono1'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono1',
                    'mask' => '9999-999-9999',
                    'htmlOptions' => array('size' => 13)
                    ));
                ?>
		<?php echo $form->error($model,'telefono1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono2'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono2',
                    'mask' => '9999-999-9999',
                    'htmlOptions' => array('size' => 13)
                    ));
                ?>
		<?php echo $form->error($model,'telefono2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->emailField($model,'correo',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edo_civil'); ?>
		<?php echo $form->dropDownList($model,'edo_civil',array('0'=>'Soltera','1'=>'Casada','2'=>'Divorciada','3'=>'Viuda','4'=>'Concubino')); ?>
		<?php echo $form->error($model,'edo_civil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_ingreso'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'fecha_ingreso',
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
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'fecha_nacimiento',
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
		<?php echo $form->error($model,'fecha_nacimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ante_familiares'); ?>
		<?php echo $form->textArea($model,'ante_familiares',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ante_familiares'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ante_personales'); ?>
		<?php echo $form->textArea($model,'ante_personales',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ante_personales'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menarquia'); ?>
		<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'menarquia',
                    'mask' => '9?9',
                    'htmlOptions' => array('size' => 2)
                    ));
                ?>
		<?php echo $form->error($model,'menarquia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_regla'); ?>
		<?php echo $form->textField($model,'tipo_regla',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tipo_regla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gesta'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'gesta',
                        $this->cargarMenuMenarquia(),
                        array('empty'=>'Seleccione numero')); 
                ?>
		<?php echo $form->error($model,'gesta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'para'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'para',
                        $this->cargarMenuMenarquia(),
                        array('empty'=>'Seleccione numero')); 
                ?>
		<?php echo $form->error($model,'para'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aborto'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'aborto',
                        $this->cargarMenuMenarquia(),
                        array('empty'=>'Seleccione numero')); 
                ?>
		<?php echo $form->error($model,'aborto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cesarea'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'cesarea',
                        $this->cargarMenuMenarquia(),
                        array('empty'=>'Seleccione numero')); 
                ?>
		<?php echo $form->error($model,'cesarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cesarea_descrip'); ?>
		<?php echo $form->textArea($model,'cesarea_descrip',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cesarea_descrip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fue'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'fue',
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
		<?php echo $form->error($model,'fue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pmf'); ?>
		<?php echo $form->textField($model,'pmf',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pmf'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->