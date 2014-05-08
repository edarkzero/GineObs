<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
        $pacientes = Paciente::model()->findAll();

        $pacientesSelect2 = ModelDataParser::toHtmlValueTag($pacientes,'option','id',array('nombre1','apellido1'));

        $this->render('index',array(
            'pacientes' => $pacientes,
            'pacientesSelect2' => $pacientesSelect2
        ));
	}

    public function actionPaciente()
    {
        if(isset($_POST['id']))
        {
            $paciente = new Paciente();
            $paciente = $paciente->findByPk($_POST['id']);

            if(!isset($paciente)) {return;}

            $this->renderPartial('/paciente/view',array('model' => $paciente));
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

}