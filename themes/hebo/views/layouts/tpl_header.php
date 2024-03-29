<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>GineObs - Ginecologia Obstetricia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Edgar O. Cardona H.">

    <?php
    $baseUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerCoreScript('jquery');
    ?>

    <script>
        var baseUrl = "<?php echo Yii::app()->baseUrl; ?>";
        var dateLongFormat = "<?php echo DateTools::LONG_DATE_FORMAT_JS; ?>";
        var dateBddFormat = "<?php echo DateTools::BDD_DATE_FORMAT_JS; ?>";
        var dateTimeLongFormat = "<?php echo DateTools::LONG_DATETIME_FORMAT_JS; ?>";
        var dateTimeBddFormat = "<?php echo DateTools::BDD_DATETIME_FORMAT_JS; ?>";
        var lang = "<?php echo Yii::app()->language; ?>";
    </script>

    <!-- the styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap-responsive.min.css">
    <!--<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Pontano+Sans'>-->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/nivo-slider/themes/default/default.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/nivo-slider/nivo-slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/lightbox/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/template.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/style1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jquery-custom/dialog.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/calendar-custom/calendar.css"/>
    <link rel="alternate stylesheet" type="text/css" media="screen" title="style2"
          href="<?php echo $baseUrl; ?>/css/style2.css"/>
    <link rel="alternate stylesheet" type="text/css" media="screen" title="style3"
          href="<?php echo $baseUrl; ?>/css/style3.css"/>
    <link rel="alternate stylesheet" type="text/css" media="screen" title="style4"
          href="<?php echo $baseUrl; ?>/css/style4.css"/>
    <link rel="alternate stylesheet" type="text/css" media="screen" title="style5"
          href="<?php echo $baseUrl; ?>/css/style5.css"/>
    <link rel="alternate stylesheet" type="text/css" media="screen" title="style6"
          href="<?php echo $baseUrl; ?>/css/style6.css"/>

    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/swfobject/swfobject.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/lightbox/js/lightbox.js"></script>
    <!-- style switcher -->
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/styleswitcher.js"></script>


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- The fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo $baseUrl; ?>/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo $baseUrl; ?>/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo $baseUrl; ?>/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl; ?>/img/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
<section id="header">
    <!-- Include the header bar -->
    <?php include_once('header.php'); ?>
    <!-- /.container -->
</section>
<!-- /#header -->