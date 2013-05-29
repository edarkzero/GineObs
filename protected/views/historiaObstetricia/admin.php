<?php
/* @var $this HistoriaObstetriciaController */
/* @var $model HistoriaObstetricia */

$this->breadcrumbs=array(
	'Historias Obstetricia'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar HistoriaObstetricia', 'url'=>array('index')),
	array('label'=>'Crear HistoriaObstetricia', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('historia-obstetricia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Historias de Obstetricia</h1>

<p>
También puede escribir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="tablaAdmin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historia-obstetricia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
            
		array(    
                    'name'=>'paciente_id',
                    'header'=>'Paciente',
                    'value'=>'Paciente::GET_NOMBRE_COMPLETO_PK($data->paciente_id)',
                    'filter'=> Paciente::GET_LISTA_NOMBRE_COMPLETO(),
		),
            
		'fecha',
		'peso',
		//'tension_arterial',
		//'altura_uterina',
		//'foco_fetal',
		'edad_embarazo',
		//'edemas',
		//'otros',
            
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>