<?php

class cajaAction extends CAction
{
    public $url,$model;
    
    function run()
    {
        $dataProvider=new CActiveDataProvider($this->model);
		
        $this->controller->render($this->url,array(
			'dataProvider'=>$dataProvider,
		));
    }
    
}

?>
