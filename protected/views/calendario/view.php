<?php
/* @var $this CalendarioController */
/* @var $model Evento */

$this->breadcrumbs = array(
    'Calendario' => array('admin'),
    $model->id,
);

$this->menu = array(
    //array('label'=>'Borrar Evento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label' => 'Administrar Calendario', 'url' => array('admin')),
);
?>

    <h1>Vista Calendario #<?php echo $model->id; ?></h1>

<?php

if (isset($model->citas[0]) && !empty($model->citas[0]->id)) {
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'label' => 'Fecha Inicio',
                'type' => 'raw',
                'value' => Evento::FORMATEAR_FECHA($model->fechaInicio),
            ),
            array(
                'label' => 'Fecha Fin',
                'type' => 'raw',
                'value' => Evento::FORMATEAR_FECHA($model->fechaFin),
            ),
            array(
                'label' => 'Paciente',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($model->citas[0]->paciente_id), array('Paciente/View   ', 'id'=>$model->citas[0]->paciente_id)) . " - " . $model->citas[0]->paciente->nombre1 . " " . $model->citas[0]->paciente->apellido1,
            ),
            'descripcion',
        ),
    ));
} else {
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'label' => 'Fecha Inicio',
                'type' => 'raw',
                'value' => Evento::FORMATEAR_FECHA($model->fechaInicio),
            ),
            array(
                'label' => 'Fecha Fin',
                'type' => 'raw',
                'value' => Evento::FORMATEAR_FECHA($model->fechaFin),
            ),
            'descripcion',
        ),
    ));
}

?>