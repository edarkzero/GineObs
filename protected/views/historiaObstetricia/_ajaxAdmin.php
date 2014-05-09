<?php
/* @var $this DashboardController */
/* @var $model HistoriaObstetricia */

$dataP = $model->search();
?>

<?php if (isset($dataP->data[0])): ?>

    <div class="tablaAdmin">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'historia-obstetricia-grid',
            'dataProvider' => $dataP,
            'filter' => $model,
            'columns' => array(
                'fecha',
                'peso',
                'tension_arterial',
                'altura_uterina',
                'foco_fetal',
                'edad_embarazo',
                'edemas',
                //'otros',

                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )); ?>
    </div>

<?php else: ?>

    <?php $this->renderPartial('/dashboard/hasData', array('model' => $model)); ?>

<?php endif; ?>