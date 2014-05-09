<?php
/* @var $this DashboardController */
/* @var $model Paciente */

$dataP = $model->search();
?>

<?php if (isset($dataP->data[0])): ?>

    <div class="tablaAdmin">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'paciente-grid',
            'dataProvider' => $dataP,
            'filter' => $model,
            'columns' => array(
                //'nombre1',
                //'apellido1',
//		'apellido2',
//		'direccion',
                'fecha_ingreso',
                //'telefono1',
//		'telefono2',
//		'correo',
//		array(
//                    'name'=>'edo_civil',
//                    'value'=>'Paciente::GET_EDO_CIVIL($data->id)',
//                ),
//		'fecha_nacimiento',
//		'ante_familiares',
//		'ante_personales',
                'menarquia',
                'tipo_regla',
                'gesta',
                'para',
//		'aborto',
//		'cesarea',
//		'cesarea_descrip',
//		'fue',
//		'pmf',
                array('class' => 'CButtonColumn',
                )
//                array(
//                    'class'=>'CLinkColumn',
//                    'imageUrl'=>Yii::app()->baseUrl.'/images/mail.png',
//                    'labelExpression'=>'$data->correo',
//                    'urlExpression'=>'"mailto://".$data->correo',
//                    'htmlOptions'=>array('style'=>'text-alignment:center'),
//                )
            ),
        )); ?>
    </div>

<?php else: ?>

    <?php $this->renderPartial('/dashboard/hasData', array('model' => $model)); ?>

<?php endif; ?>