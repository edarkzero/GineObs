<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language;?>" lang="<?php echo Yii::app()->language;?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset;?>" />
	<meta name="language" content="<?php echo Yii::app()->language;?>" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
				array('label'=>'Paciente', 'url'=>array('/paciente/index')),
				array('label'=>'Historia Ginecologia', 'url'=>array('/historiaGinecologia/index')),
				array('label'=>'Historia Obstetricia', 'url'=>array('/historiaObstetricia/index')),
				array('label'=>'Registro de Enfermedad', 'url'=>array('/enfermedad/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Loguearse', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

        <div class='info' style='text-aling:left;'>
        <?php 
            //Mensajes en flash
            $flashMessages = yii::app()->user->getFlashes();
            
            if($flashMessages) {
                
                echo '<ul class="flashes">';
                
                foreach($flashMessages as $key => $message) {
                    //message puede ser notice,error y success
                    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
                    
                }
                
                echo '</ul>';
                
            }
            
        ?>
        </div>
                
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by E. Cardona y G. Soto.<br/>
		Todos los derechos reservados.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

<?php
    //Efecto para el div de Mensajes Flash

    Yii::app()->clientScript->registerScript(
            'myHideEffect',
            '$(".info").animate({opacity: 1.0}, 10000).slideUp("slow");',
            CClientScript::POS_READY
    );
?>