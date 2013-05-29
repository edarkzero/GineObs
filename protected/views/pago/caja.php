<?php
/* @var $this PagoController */
/* @var $chartLabels array(LABELS) */
/* @var $chartData array(VALUES) */

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
            'Mensual'=>$this->renderPartial('_cajaMensual',array('chartLabels'=>$chartLabels,'chartData'=>$chartData),true),
            'Semanal'=>$this->renderPartial('_cajaSemanal',array('chartLabels'=>$chartLabels,'chartData'=>$chartData),true),
            'Diaria'=>$this->renderPartial('_cajaDiaria',array('chartLabels'=>$chartLabels,'chartData'=>$chartData),true),
        ),
        // additional javascript options for the tabs plugin
        'options'=>array(
            'collapsible'=>false,
        ),
    ));
?>


