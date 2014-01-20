<section id="navigation-main">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="nav-collapse">
                    <?php $this->widget('zii.widgets.CMenu', array(
                        'htmlOptions'        => array('class' => 'nav'),
                        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                        'itemCssClass'       => 'item-test',
                        'encodeLabel'        => false,
                        'items'              => array(
                            array('label' => 'Inicio', 'url' => array('site/index'), 'visible' => $this->id === 'site', 'linkOptions' => array("data-description" => "Pagina de inicio"),),
                            array('label' => Yii::t('app', 'Dashboard'), 'visible' => $this->id === 'dashboard', 'url' => array('/dashboard/index'), 'linkOptions' => array("data-description" => Yii::t('app', "Operations grouper"))),

                            /*array('label'=>'Home <span class="caret"></span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"our home page"),
                                            'items'=>array(
                                                array('label'=>'Home 1 - Nivoslider', 'url'=>array('/site/index')),
                                                array('label'=>'Home 2 - Bootstrap carousal', 'url'=>array('/site/page', 'view'=>'home2')),
                                                array('label'=>'Home 3 - Piecemaker2', 'url'=>array('/site/page', 'view'=>'home3')),
                                                array('label'=>'Home 4 - Static image', 'url'=>array('/site/page', 'view'=>'home4')),
                                                array('label'=>'Home 5 - Video header', 'url'=>array('/site/page', 'view'=>'home5')),
                                                array('label'=>'Home 6 - Without slider', 'url'=>array('/site/page', 'view'=>'home6')),
                                            )),*/

                            array('label' => 'Administracion de sistema <span class="caret"></span>', 'url' => array('/Ginecologia', 'view' => 'columns'), 'visible' => $this->id === 'site', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown", "data-description" => "Datos iniciales"),
                                  'items' => array(
                                      array('label' => 'Enfermedades', 'url' => array('/enfermedad/admin')),
                                      array('label' => 'Medicinas', 'url' => array('/medicina/admin')),
                                  )),

                            array('label' => 'Pacientes', 'url' => array('/paciente/admin'), 'visible'=>$this->id === 'site', 'linkOptions' => array("data-description" => "Datos de pacientes"),),

                            array('label' => 'Historia <span class="caret"></span>', 'url' => array('/site/page', 'view' => 'columns'), 'visible'=>$this->id === 'site', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown", "data-description" => "Historias medicas"),
                                  'items' => array(
                                      array('label' => 'Historia de Ginecologia', 'url' => array('/historiaGinecologia/admin')),
                                      array('label' => 'Historia de Obstetricia', 'url' => array('/historiaObstetricia/admin')),
                                  )),

                            array('label' => 'Recipes', 'url' => array('/recipe/admin'), 'visible'=>$this->id === 'site', 'linkOptions' => array("data-description" => "Datos de recipes"),),
                            array('label' => 'Pagos', 'url' => array('/pago/admin'), 'visible'=>$this->id === 'site', 'linkOptions' => array("data-description" => "Datos de pagos"),),
                            array('label' => 'Calendario', 'url' => array('/calendario/admin'), 'visible'=>$this->id === 'site', 'linkOptions' => array("data-description" => "Gestion de calendario"),),
                            array('label' => 'Usuarios', 'url' => array('/usuario/admin'), 'visible'=>$this->id === 'site', 'linkOptions' => array("data-description" => "Datos de usuarios"),),

//                        array('label'=>'Estilos <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"6 estilos para la pagina"), 
//                            'items'=>array(
//                                array('label'=>'<span class="style" style="background-color:#0088CC;"></span> Estilo 1', 'url'=>"javascript:chooseStyle('style1', 60)"),
//                                array('label'=>'<span class="style" style="background-color:#e42e5d;"></span> Estilo 2', 'url'=>"javascript:chooseStyle('style2', 60)"),
//                                array('label'=>'<span class="style" style="background-color:#c80681;"></span> Estilo 3', 'url'=>"javascript:chooseStyle('style3', 60)"),
//                                array('label'=>'<span class="style" style="background-color:#51a351;"></span> Estilo 4', 'url'=>"javascript:chooseStyle('style4', 60)"),
//                                array('label'=>'<span class="style" style="background-color:#b88006;"></span> Estilo 5', 'url'=>"javascript:chooseStyle('style5', 60)"),
//                                array('label'=>'<span class="style" style="background-color:#f9630f;"></span> Estilo 6', 'url'=>"javascript:chooseStyle('style6', 60)"),
//                            )),
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- /#navigation-main -->