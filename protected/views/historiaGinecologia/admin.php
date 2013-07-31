<?php
/* @var $this HistoriaGinecologiaController */
/* @var $model HistoriaGinecologia */

$this->breadcrumbs=array(
	'Historia Ginecologias'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar HistoriaGinecologia', 'url'=>array('index')),
	array('label'=>'Crear HistoriaGinecologia', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('historia-ginecologia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Historia Ginecologias</h1>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historia-ginecologia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'paciente_id',
        array(
            'name'=>'paciente_id',
            'header'=>'Paciente',
            'value'=>'Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)',
            'filter'=> Paciente::GET_LISTA_NOMBRE_COMPLETO(),
        ),
		'fecha',
		'motivo_consulta',
		/*
                'dir_examen1',
		'dir_examen2',
		'examen_fisico',
		'diagnostico',
		'tratamiento',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>