<?php/* @var $this PagoController */
/* @var $pagosMonthlyChartData array */
?>

    <h3> Estadistica diaria </h3>

<?php
$this->widget(
    'chartjs.widgets.ChLine',
    array(
        'width' => 600,
        'height' => 300,
        'htmlOptions' => array(),
        'labels' => $pagosMonthlyChartData[0],
        'datasets' => array(
            array(
                "fillColor" => "rgba(75,150,150,0.2)",
                "strokeColor" => "rgba(100,150,150,1)",
                "pointColor" => "rgba(220,220,220,1)", //Azul
                "pointStrokeColor" => "#008080", //Negro
                "data" => $pagosMonthlyChartData[1],
            ),
        ),
        'options' => array()
    )
);
?>