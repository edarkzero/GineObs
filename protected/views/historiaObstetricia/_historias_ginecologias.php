<?php
/* @var $data HistoriaGinecologia */
?>

<div class="cuadro">
    <a href="<?php echo $this->createUrl('View',array('id'=>$data->id)); ?>"><p>Ver detalle</p></a>
    <p>Fecha: <?php echo $data->fecha; ?></p>
    <p>Enfermedades: <?php echo $this->visualizarArreglo($data->ginecologiaEnfermedads,"nombre"); ?></p>
    <p>Motivo de consulta: <?php echo $data->motivo_consulta; ?></p>
</div>