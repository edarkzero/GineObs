<?php
/* @var $this EnfermedadController */
/* @var $model Enfermedad */

$this->breadcrumbs=array(
	'Enfermedades'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Enfermedades', 'url'=>array('index')),
	array('label'=>'Crear Enfermedad', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('enfermedad-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Enfermedades</h1>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'enfermedad-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>"function(){jQuery('#fecha_creacion_search').datepicker({'dateFormat': 'yy-mm-dd'});$.datepicker.setDefaults($.datepicker.regional['es']);}",
	'filter'=>$model,
	'columns'=>array(
		'nombre',
		'descripcion',
		array(
                    'name' => 'fecha_creacion', 
                    'type' => 'raw', 
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', 
                            array(
                                'model'=>$model, 
                                'attribute'=>'fecha_creacion', 
                                'language' => Yii::app()->language,
                                'htmlOptions' => array('id' => 'fecha_creacion_search'), 
                                'options' => array(
                                    'dateFormat' => 'yy-mm-dd',
                                    'constrainInput' => 'false',
                                    'duration' => 'fast',
                                    'showAnim' => 'slide',)
                                ), 
                            true
                            )
                    ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>