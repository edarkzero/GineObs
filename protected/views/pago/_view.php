<?php
/* @var $this PagoController */
/* @var $data Pago */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paga')); ?>:</b>
	<?php echo CHtml::encode($data->paga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode(Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)); ?>
	<br />

</div>