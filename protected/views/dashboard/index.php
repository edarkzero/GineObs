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
            <div class="span6 text-center animated-item">
                <a href="<?php echo $this->createUrl('/historiaGinecologia/admin') ?>">Historia Ginecologia</a>
            </div>
            <div class="span6 text-center animated-item">
                <a href="<?php echo $this->createUrl('/historiaObstetricia/admin') ?>">Historia Ginecologia</a>
            </div>
        </div>

    </div>

    <div class="row-fluid">

        <div class="span12" id="paciente-data">
            <?php /*foreach ($pacientes as $key => $paciente): */ ?><!--
            <?php /*if ($ban === 0): */ ?>
                <div class="row-fluid margin">
            <?php /*endif; */ ?>
            <div class="span4 choice">
                <a href="<?php /*echo Yii::app()->controller->createUrl('paciente/view', array('id' => $paciente->id)) */ ?>">
                    <p><?php /*echo $paciente->getNombreCompleto(); */ ?></p>

                    <p><?php /*echo Paciente::GET_EDO_CIVIL($paciente->id); */ ?></p>

                    <p><?php /*echo $paciente->cesarea_descrip; */ ?></p>
                </a>
            </div>
            <?php /*$ban++;
            if ($ban === 3 || ($key == $countPacientes && $ban < 2)): */
            ?>
                </div>
                <?php /*$ban = 0; */ ?>
            <?php /*endif; */ ?>
        --><?php /*endforeach; */ ?>
        </div>

    </div>

</div>