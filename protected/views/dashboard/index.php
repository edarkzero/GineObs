<?php
/* @var $this DashboardController */
/* @var $pacientes Paciente[] */
/* @var $pacientesSelect2 string */

$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/select2/select2.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/dashboard.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/js/select2/select2.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/dashboard.css');

$ban = 0;
$countPacientes = count($pacientes) - 1;

?>

<script>
    var placeHolderMsj = "<?php echo Yii::t('app','Select a patient'); ?>"
    var s2 = '#paciente-multiselect';
</script>

<div id="dashboard-container">

    <div class="row-fluid">
        <div class="span12">
            <select id="paciente-multiselect" name="paciente" class="span12">
                <?php echo $pacientesSelect2; ?>
            </select>
        </div>
    </div>

    <div class="row-fluid">

        <div class="span12">
            <div class="span4 text-center animated-item dashboard-item" href="#" data-opt="HistoriaGinecologia">Historia Ginecologia</div>
            <div class="span4 text-center animated-item dashboard-item" href="#" data-opt="HistoriaObstetricia">Historia Obstetricia</div>
            <div class="span4 text-center animated-item dashboard-item" href="#" data-opt="Paciente">Datos de paciente</div>
        </div>

    </div>

    <div class="row-fluid">

        <div class="span12">
            <div class="span6 text-center animated-item dashboard-item" href="#" data-opt="Recipe">Recipes</div>
            <div class="span6 text-center animated-item dashboard-item" href="#" data-opt="Pago">Pagos</div>
        </div>

    </div>

    <div class="row-fluid">

        <div class="span12" id="changin-data"></div>

    </div>

</div>