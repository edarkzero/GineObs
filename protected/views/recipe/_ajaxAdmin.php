<?php
/* @var $this DashboardController */
/* @var $model Recipe */

$dataP = $model->search();
?>

<?php if (isset($dataP->data[0])): ?>

    <div class="tablaAdmin">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'recipe-grid',
            'dataProvider' => $dataP,
            'filter' => $model,
            'columns' => array(
                'indicaciones',
                'fecha',
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )); ?>
    </div>

<?php else: ?>

    <?php $this->renderPartial('/dashboard/hasData', array('model' => $model)); ?>

<?php endif; ?>