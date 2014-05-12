<?php
/* @var $data CActiveForm|Paciente */
?>

<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<div class="row">
    <?php echo $form->labelEx($model, 'ante_familiares'); ?>
    <?php echo $form->textArea($model, 'ante_familiares', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'ante_familiares'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'ante_personales'); ?>
    <?php echo $form->textArea($model, 'ante_personales', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'ante_personales'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'menarquia'); ?>
    <?php
    $this->widget('CMaskedTextField', array(
        'model' => $model,
        'attribute' => 'menarquia',
        'mask' => '9?9',
        'htmlOptions' => array('size' => 2)
    ));
    ?>
    <?php echo $form->error($model, 'menarquia'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'tipo_regla'); ?>
    <?php echo $form->textField($model, 'tipo_regla', array('size' => 20, 'maxlength' => 20)); ?>
    <?php echo $form->error($model, 'tipo_regla'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'gesta'); ?>
    <?php echo $form->dropDownList(
        $model,
        'gesta',
        Paciente::cargarMenuMenarquia(),
        array('empty' => 'Seleccione numero'));
    ?>
    <?php echo $form->error($model, 'gesta'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'para'); ?>
    <?php echo $form->dropDownList(
        $model,
        'para',
        Paciente::cargarMenuMenarquia(),
        array('empty' => 'Seleccione numero'));
    ?>
    <?php echo $form->error($model, 'para'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'aborto'); ?>
    <?php echo $form->dropDownList(
        $model,
        'aborto',
        Paciente::cargarMenuMenarquia(),
        array('empty' => 'Seleccione numero'));
    ?>
    <?php echo $form->error($model, 'aborto'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'cesarea'); ?>
    <?php echo $form->dropDownList(
        $model,
        'cesarea',
        Paciente::cargarMenuMenarquia(),
        array('empty' => 'Seleccione numero'));
    ?>
    <?php echo $form->error($model, 'cesarea'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'cesarea_descrip'); ?>
    <?php echo $form->textArea($model, 'cesarea_descrip', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'cesarea_descrip'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'fue'); ?>
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
    <?php echo $form->error($model, 'fue'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'pmf'); ?>
    <?php echo $form->textField($model, 'pmf', array('size' => 20, 'maxlength' => 20)); ?>
    <?php echo $form->error($model, 'pmf'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
</div>