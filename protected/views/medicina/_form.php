<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
                <?php echo $form->textField($model,'nombre',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'presentacion'); ?>
                <?php echo $form->listBox($model,'presentacion',
                        array('Tabletas'=>'Tabletas','Comprimido'=>'Comprimido','Ovulo'=>'Ovulo','Supositorio'=>'Supositorio','Capsula'=>'Capsula','Ampolla'=>'Ampolla','Parche'=>'Parche','Parche transdermico'=>'Parche transdermico','Crema vaginal'=>'Crema vaginal','Crema topica'=>'Crema topica','Pomada'=>'Pomada','Gel'=>'Gel','Emun-gel'=>'Emun-gel'),
                        array('options'=>array('Tabletas'=>array('selected'=>'selected' )))
                        ); ?>
                <?php echo $form->error($model,'presentacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidad'); ?>
                <?php echo $form->numberField($model,'unidad'); ?>
                <?php echo $form->error($model,'unidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidadPatron'); ?>
                <?php echo $form->listBox($model,'unidadPatron',
                    array('cc'=>'cc','ml'=>'ml','L'=>'L','mcg'=>'mcg','mg'=>'mg','g'=>'g'),
                    array('class'=>'lb_unidadPatron','options'=>array('mg'=>array('selected'=>'selected' )))); ?>
                <?php echo $form->error($model,'unidadPatron'); ?>
	</div>


