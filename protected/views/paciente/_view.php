<?php
/* @var $this PacienteController */
/* @var $data Paciente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre1')); ?>:</b>
	<?php echo CHtml::encode($data->nombre1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre2')); ?>:</b>
	<?php echo CHtml::encode($data->nombre2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellido1')); ?>:</b>
	<?php echo CHtml::encode($data->apellido1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellido2')); ?>:</b>
	<?php echo CHtml::encode($data->apellido2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono1')); ?>:</b>
	<?php echo CHtml::encode($data->telefono1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono2')); ?>:</b>
	<?php echo CHtml::encode($data->telefono2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edo_civil')); ?>:</b>
	<?php echo CHtml::encode($data->edo_civil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ante_familiares')); ?>:</b>
	<?php echo CHtml::encode($data->ante_familiares); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ante_personales')); ?>:</b>
	<?php echo CHtml::encode($data->ante_personales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menarquia')); ?>:</b>
	<?php echo CHtml::encode($data->menarquia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_regla')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_regla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gesta')); ?>:</b>
	<?php echo CHtml::encode($data->gesta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('para')); ?>:</b>
	<?php echo CHtml::encode($data->para); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aborto')); ?>:</b>
	<?php echo CHtml::encode($data->aborto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cesarea')); ?>:</b>
	<?php echo CHtml::encode($data->cesarea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cesarea_descrip')); ?>:</b>
	<?php echo CHtml::encode($data->cesarea_descrip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fue')); ?>:</b>
	<?php echo CHtml::encode($data->fue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pmf')); ?>:</b>
	<?php echo CHtml::encode($data->pmf); ?>
	<br />

	*/ ?>

</div>