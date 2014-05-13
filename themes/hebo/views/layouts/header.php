<div class="container">
    <div class="row-fluid">

        <div class="span4">
            <a href="<?php Yii::app()->controller->createUrl('site/index'); ?>" class="logo"></a>
        </div>
        <!--/.span6 -->

        <div class="span8">
            <section id="head-navigation-main">
                <div class="navbar" style="margin-bottom: 0px;">
                    <div class="navbar-inner" style="border:none;">
                        <div class="container">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>

                            <div class="nav-collapse">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                    'htmlOptions' => array('class' => 'nav'),
                                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                                    'itemCssClass' => 'item-test',
                                    'encodeLabel' => false,
                                    'items' => array(
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Area de miembros")),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Area de miembros")),
                                        array('label' => 'Estilos <span class="caret"></span>', 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown", "data-description" => "6 colores"),
                                            'items' => array(
                                                array('label' => '<span class="style" style="background-color:#0088CC;"></span> Azul', 'url' => "javascript:chooseStyle('style1', 60)"),
                                                array('label' => '<span class="style" style="background-color:#e42e5d;"></span> Rojo', 'url' => "javascript:chooseStyle('style2', 60)"),
                                                array('label' => '<span class="style" style="background-color:#c80681;"></span> Purpura', 'url' => "javascript:chooseStyle('style3', 60)"),
                                                array('label' => '<span class="style" style="background-color:#51a351;"></span> Verde', 'url' => "javascript:chooseStyle('style4', 60)"),
                                                array('label' => '<span class="style" style="background-color:#b88006;"></span> Oliva', 'url' => "javascript:chooseStyle('style5', 60)"),
                                                array('label' => '<span class="style" style="background-color:#f9630f;"></span> Naranja', 'url' => "javascript:chooseStyle('style6', 60)"),
                                            )),
                                        /*array('label'=>Yii::t('app','Dashboard'), 'visible'=>$this->id === 'site','url'=>array('/dashboard/index'), 'linkOptions'=>array("data-description"=>Yii::t('app',"Operations grouper"))),*/
                                        array('label'=>'Inicio', 'url'=>array('site/index'), 'visible'=>$this->id === 'dashboard','linkOptions'=>array("data-description"=>"Pagina de inicio"),),
                                    ),
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!--/.row-fluid header -->
</div>