<?php
/* @var $this PagoController */
/* @var $pagosMonthlyChartData array */
/* @var $pagosWeeklyChartData array */
/* @var $pagosDailyChartData array */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
        'Caja',
);

$this->menu=array(
	array('label'=>'Crear Pago', 'url'=>array('create')),
	array('label'=>'Administrar Pagos', 'url'=>array('admin')),
);
?>

<h1>Registros de caja</h1>

    <!--<h2> Estadistica diaria  </h2>
    
    <h2> Estadistica semanal </h2>-->

<?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            'Mensual'=>$this->renderPartial('_cajaChart',array('titulo'=>'mensual','pagosChartData'=>$pagosMonthlyChartData),true),
            'Semanal'=>$this->renderPartial('_cajaChart',array('titulo'=>'semanal','pagosChartData'=>$pagosWeeklyChartData),true),
            'Diaria'=>$this->renderPartial('_cajaChart',array('titulo'=>'diario','pagosChartData'=>$pagosDailyChartData),true),
        ),
        // additional javascript options for the tabs plugin
        'options'=>array(
            'collapsible'=>false,
        ),
    ));
?>


