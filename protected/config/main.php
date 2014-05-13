<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Set path for charts extension
    Yii::setPathOfAlias('chartjs', dirname(__FILE__) . '/../extensions/yii-chartjs');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
    return array(
        'basePath'       => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name'           => 'GineObs',
        'language'       => 'es',
        'sourceLanguage' => 'en',
        'charset'        => 'utf-8',
        'theme'          => 'hebo',

        // preloading 'log' component
        'preload'        => array('log', 'chartjs', 'bootstrap'), //chartsjs for preload

        // autoloading model and component classes
        'import'         => array(
            'application.models.*',
            'application.components.*',
            'application.include.*',
        ),

        'modules'        => array(
            'gii' => array(
                'class'          => 'system.gii.GiiModule',
                'password'       => 'zero1010',
                'generatorPaths' => array(
                    'ext.gtc', // Gii Template Collection
                    'bootstrap.gii'
                ),
                'ipFilters'=>array('127.0.0.1','::1'),
            ),
        ),

        // application components
        'components'     => array(
            'chartjs'       => array('class' => 'chartjs.components.ChartJs'),

            'bootstrap'     => array(
                'class'         => 'ext.bootstrap.components.Bootstrap',
                'responsiveCss' => true,
            ),

            'ePdf'          => array(
                'class'  => 'ext.yii-pdf.EYiiPdf',
                'params' => array(
                    'mpdf'     => array(
                        'librarySourcePath' => 'application.vendors.mpdf.*',
                        'constants'         => array(
                            '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                        ),
                        'class'             => 'mpdf', // the literal class filename to be loaded from the vendors folder
                        /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                            'mode'              => '', //  This parameter specifies the mode of the new document.
                            'format'            => 'letter', // format A4, A5, ...
                            'default_font_size' => 0, // Sets the default document font size in points (pt)
                            'default_font'      => '', // Sets the default font-family for the new document.
                            'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                            'mgr'               => 15, // margin_right
                            'mgt'               => 16, // margin_top
                            'mgb'               => 16, // margin_bottom
                            'mgh'               => 9, // margin_header
                            'mgf'               => 9, // margin_footer
                            'orientation'       => 'P', // landscape or portrait orientation
                        )*/
                    ),
                    'HTML2PDF' => array(
                        'librarySourcePath' => 'application.vendors.html2pdf.*',
                        'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                        /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                            'orientation' => 'P', // landscape or portrait orientation
                            'format'      => 'A4', // format A4, A5, ...
                            'language'    => 'en', // language: fr, en, it ...
                            'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                            'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                            'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                        )*/
                    ),

                ),
            ),

            'user'          => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
            ),

            'widgetFactory' => array(
                'widgets' => array(
                    'CGridView'   => array(
                        'cssFile'       => false,
                        'pager'         => array('cssFile' => false),
                        'pagerCssClass' => 'pagination',
                        'rowCssClass'   => array('light', 'dark'),
                        'itemsCssClass' => 'table table-bordered table-condensed table-striped',
                    ),
                    'CListView'   => array(
                        'cssFile'       => false,
                        'pager'         => array('cssFile' => false),
                        'pagerCssClass' => 'pagination',

                    ),
                    'CDetailView' => array(
                        'cssFile'     => false,
                        'htmlOptions' => array('class' => 'table table-bordered table-condensed table-striped'),
                    ),

                    /*
                    'CLinkPager' =>array(
                    ),
                    */
                )
            ),

            'urlManager'    => array(
                'urlFormat'      => 'path',
                'showScriptName' => false,

                'rules'          => array(
                    '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    #'<lg>/<controller:\w+>/<action:\w+>/<id>/<id2>'=>'<controller>/<action>',
                    #'<lg>/<controller:\w+>/<action:\w+>/<id>'=>'<controller>/<action>',
                    #'<lg>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
                ),
            ),

            'db'            => array(
                'connectionString'   => 'mysql:host=127.0.0.1;dbname=gineobs',
                'emulatePrepare'     => false,
                'username'           => 'root',
                'password'           => 'zero1010',
                'charset'            => 'utf8',
                'enableProfiling'    => true,
                'enableParamLogging' => true,
            ),

            /*Descomentar para usar otra base de datos
            'db1'=>array(
        'class' => 'CDbConnection',
        'connectionString' => 'mysql:host=localhost;dbname=gineobs',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        //'enableProfiling'=>true, Para activar el log de consultas BDD
    ),
    */

            'coreMessages'  => array(
                'basePath' => 'protected/messages'
            ),

            'errorHandler'  => array(
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
            ),
            'log'           => array(
                'class'  => 'CLogRouter',
                'routes' => array(
                    array(
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages

                    /*array(
                        'class'=>'CWebLogRoute',
                    ),*/

                ),
            ),
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'         => array(
            // this is used in contact page
            'adminEmail' => 'edgarcardona87@gmail.com',
            'slogan'     => 'Edgar O. Cardona H.',
        ),
    );