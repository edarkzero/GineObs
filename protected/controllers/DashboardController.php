<?php

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $pacientes = Paciente::model()->findAll();

        $pacientesSelect2 = ModelDataParser::toHtmlValueTag($pacientes, 'option', 'id', array('nombre1', 'apellido1'));

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

            try {
                /**
                 * @var $model CActiveRecord
                 */
                $model = new $modelName('search');
                $model->unsetAttributes();
                $modelName === 'Paciente' ? $model->id = $pacienteID : $model->paciente_id = $pacienteID;

                if (isset($_GET[$modelName]))
                    $model->attributes = $_GET[$modelName];

                $this->renderPartial('/' . $modelName . '/_ajaxAdmin', array('model' => $model));
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
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