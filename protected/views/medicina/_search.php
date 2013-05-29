<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'nombre'); ?>
                <?php echo $form->textField($model,'nombre',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'presentacion'); ?>
                <?php echo $form->textField($model,'presentacion',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'unidad'); ?>
                <?php echo $form->numberField($model,'unidad'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'unidadPatron'); ?>
                <?php echo $form->textField($model,'unidadPatron',array('size'=>3,'maxlength'=>3)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
