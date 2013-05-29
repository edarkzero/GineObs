<?php
/* @var $this RecipeController */
/* @var $data Recipe */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id), array('target'=>'_blank')); ?>
	<br />
        
        <div class="view-detail-container">
            
            <div class="view-detail-column-left"><b>
                <?php echo CHtml::encode($data->getAttributeLabel('recipeMedicinas')); ?>:</b></div>
            
            <div class="view-detail-column-right">
                <?php echo $this->visualizarArreglo($data->recipeMedicinas,'nombre'); ?>
            </div>
            
        </div>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('indicaciones')); ?>:</b>
	<?php echo CHtml::encode($data->indicaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode(Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)); ?>
	<br />


</div>