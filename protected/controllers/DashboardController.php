<?php

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $pacientes = Paciente::model()->findAll();

        $pacientesSelect2 = array();
        $pacientesSelect2['html'] = ModelDataParser::toHtmlValueTag($pacientes, 'option', 'id', array('nombre1', 'apellido1'),true);

        if(isset($_GET['id']))
        {
            $model = Paciente::model()->findByPk($_GET['id']);

            if(isset($model))
                $pacientesSelect2['selected'] = $model->id;
            else
                $pacientesSelect2['selected'] = '-1';
        }

        $this->render('index', array(
            'pacientes' => $pacientes,
            'pacientesSelect2' => $pacientesSelect2
        ));
    }

    public function actionLoadData()
    {
        if (isset($_POST['id'], $_POST['opt'])) {
            $pacienteID = $_POST['id'];
            $modelName = $_POST['opt'];

            $this->loadModelPartial($modelName,$pacienteID);
        }
    }

    public function getNeededPartial()
    {
        if (isset($_GET['id'], $_GET['opt'])) {
            $pacienteID = $_GET['id'];
            $modelName = $_GET['opt'];

            $this->loadModelPartial($modelName,$pacienteID,false);
        }
    }

    private function loadModelPartial($modelName,$pacienteID,$ajax = true)
    {
        try {
            /**
             * @var $model CActiveRecord
             */
            $model = new $modelName('search');

            if($modelName !== 'Paciente')
            {
                $model->unsetAttributes();
                $model->paciente_id = $pacienteID;
            }

            if (isset($_GET[$modelName]))
                $model->attributes = $_GET[$modelName];

            if($modelName !== 'Paciente')
            {
                if(!$ajax)
                    return $this->renderPartial('/' . $modelName . '/_ajaxAdmin', array('model' => $model),$ajax);
                else
                    $this->renderPartial('/' . $modelName . '/_form', array('model' => $model,$ajax));
            }
            else
            {
                $model = $model->findByPk($pacienteID);

                if(!$ajax)
                    return $this->renderPartial('/' . $modelName . '/_form', array('model' => $model,'ajax' => true),$ajax);
                else
                    $this->renderPartial('/' . $modelName . '/_form', array('model' => $model,'ajax' => true),$ajax);
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function actionPaciente()
    {
        if (isset($_POST['id'])) {
            $paciente = new Paciente();
            $paciente = $paciente->findByPk($_POST['id']);

            if (!isset($paciente)) {
                return;
            }

            $this->renderPartial('/paciente/view', array('model' => $paciente));
        }
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'loadData'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

}