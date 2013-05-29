<?php
/* @var $this HistoriaGinecologiaController */
/* @var $data HistoriaGinecologia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />
        
        <div class="view-detail-container">
            
            <div class="view-detail-column-left"><b>
                <?php echo CHtml::encode($data->getAttributeLabel('ginecologiaEnfermedads')); ?>:</b></div>
            
            <div class="view-detail-column-right">
                <?php echo $this->visualizarArreglo($data->ginecologiaEnfermedads,'nombre'); ?>
            </div>
            
        </div>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo_consulta')); ?>:</b>
	<?php echo CHtml::encode($data->motivo_consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dir_examen1')); ?>:</b>
	<?php echo CHtml::encode($data->dir_examen1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dir_examen2')); ?>:</b>
	<?php echo CHtml::encode($data->dir_examen2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('examen_fisico')); ?>:</b>
	<?php echo CHtml::encode($data->examen_fisico); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnostico')); ?>:</b>
	<?php echo CHtml::encode($data->diagnostico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tratamiento')); ?>:</b>
	<?php echo CHtml::encode($data->tratamiento); ?>
	<br />

	*/ ?>

</div>