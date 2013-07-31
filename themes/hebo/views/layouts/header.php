<div class="container">
    <div class="row-fluid">

        <div class="span6">
            <a href="" class="logo"></a>
        </div>
        <!--/.span6 -->

        <div class="span6" style="float: right; width: auto; text-align: right;">
            <section id="navigation-main">
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
                                        array('label' => 'Estilos <span class="caret"></span>', 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown", "data-description" => "6 estilos para la pagina"),
                                            'items' => array(
                                                array('label' => '<span class="style" style="background-color:#0088CC;"></span> Estilo 1', 'url' => "javascript:chooseStyle('style1', 60)"),
                                                array('label' => '<span class="style" style="background-color:#e42e5d;"></span> Estilo 2', 'url' => "javascript:chooseStyle('style2', 60)"),
                                                array('label' => '<span class="style" style="background-color:#c80681;"></span> Estilo 3', 'url' => "javascript:chooseStyle('style3', 60)"),
                                                array('label' => '<span class="style" style="background-color:#51a351;"></span> Estilo 4', 'url' => "javascript:chooseStyle('style4', 60)"),
                                                array('label' => '<span class="style" style="background-color:#b88006;"></span> Estilo 5', 'url' => "javascript:chooseStyle('style5', 60)"),
                                                array('label' => '<span class="style" style="background-color:#f9630f;"></span> Estilo 6', 'url' => "javascript:chooseStyle('style6', 60)"),
                                            )),
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Area de miembros")),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"Area de miembros")),
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