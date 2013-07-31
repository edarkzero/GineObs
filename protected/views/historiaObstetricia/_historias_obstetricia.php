<?php
/* @var $data HistoriaObstetricia */
?>

<div class="cuadro">
    <a href="<?php echo $this->createUrl('View',array('id'=>$data->id)); ?>"><p>Ver detalle</p></a>
    <p>Fecha: <?php echo $data->fecha; ?></p>
    <p>Edad de embarazo: <?php echo $data->edad_embarazo; ?></p>
    <p>Foco fetal: <?php echo $data->foco_fetal; ?></p>
</div>