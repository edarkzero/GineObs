<?php
    /* @var $model CActiveRecord */
?>

<!--<a href="<?php /*echo $this->createUrl(get_class($model).'/create'); */?>">Crear nueva información</a>-->
<?php echo $this->renderPartial('/'.get_class($model).'/_form',array('model' => $model,'dashboard' => true)); ?>