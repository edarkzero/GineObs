<?php
/* @var $this DashboardController */
/* @var $model HistoriaGinecologia */

$dataP = $model->search();
?>

<?php if (isset($dataP->data[0])): ?>

    <div class="tablaAdmin">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'historia-ginecologia-grid',
            'dataProvider' => $dataP,
            'filter' => $model,
            'columns' => array(
                'fecha',
                'motivo_consulta',
                /*
                        'dir_examen1',
                'dir_examen2',*/
                'examen_fisico',
                'diagnostico',
                'tratamiento',
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )); ?>
    </div>

<?php else: ?>

    <?php $this->renderPartial('/dashboard/hasData', array('model' => $model)); ?>

<?php endif; ?>