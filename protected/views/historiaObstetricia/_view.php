<?php
/* @var $this HistoriaObstetriciaController */
/* @var $data HistoriaObstetricia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode(Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tension_arterial')); ?>:</b>
	<?php echo CHtml::encode($this->getTensionArterial($data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altura_uterina')); ?>:</b>
	<?php echo CHtml::encode($data->altura_uterina); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foco_fetal')); ?>:</b>
	<?php echo CHtml::encode($data->foco_fetal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('edad_embarazo')); ?>:</b>
	<?php echo CHtml::encode($data->edad_embarazo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edemas')); ?>:</b>
	<?php echo CHtml::encode($data->edemas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otros')); ?>:</b>
	<?php echo CHtml::encode($data->otros); ?>
	<br />

	*/ ?>

</div>