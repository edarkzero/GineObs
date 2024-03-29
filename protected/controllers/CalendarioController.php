<?php

class CalendarioController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update', 'index', 'view'),
                'users' => array('admin', 'secretaria'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Evento::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        if ($_POST['type'] == 0) {
            $model = new Evento;

            $model->fechaInicio = $_POST['data'][0];
            $model->fechaFin = $_POST['data'][1];
            $model->descripcion = $_POST['data'][2];

            $model->save();

            echo $model->id;
        } elseif ($_POST['type'] == 1) {
            $paciente = Paciente::model()->findByPk($_POST['data'][2]);

            if (isset($paciente)) {

                $model_cita = new Cita;
                $model_evento = new Evento;

                $model_evento->fechaInicio = $_POST['data'][0];
                $model_evento->fechaFin = $_POST['data'][1];
                $model_evento->descripcion = $_POST['data'][3];

                $model_evento->save();

                $model_cita->calendario_id = $model_evento->id;
                $model_cita->paciente_id = $_POST['data'][2];

                $model_cita->save();

                echo $model_evento->id;
            } else echo "-1";
        }

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate()
    {
        $id = $_POST['id'];
        $model = $this->loadModel($id);

        if ($_POST['type'] == 0) {
            $model->fechaInicio = $_POST['data'][0];
            $model->fechaFin = $_POST['data'][1];
            $model->descripcion = $_POST['data'][2];

            $model->save();
        } elseif ($_POST['type'] == 1) {
            $model_cita = new Cita;
            $model_evento = new Evento;

            $model_evento->fechaInicio = $_POST['data'][0];
            $model_evento->fechaFin = $_POST['data'][1];
            $model_evento->descripcion = $_POST['data'][3];

            $model_evento->save();

            $model_cita->calendario_id = $model_evento->id;
            $model_cita->paciente_id = $_POST['data'][2];

            $model_cita->save();
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

//		if(isset($_POST['Evento']))
//		{
//			$model->attributes=$_POST['Evento'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {

        $id = $_POST['id'];

        $model = $this->loadModel($id);

        foreach ($model->citas as $cita) {
            $cita->delete();
        }

        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Evento');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        //Yii::app()->clientScript->registerScript('uniqueid', 'alert("ok");alert("ok2");');
        $model = new Evento('search');

        $model_paciente = Paciente::model()->findAll();
        $autoCompletePaciente = Base::toAutoCompleteFormat($model_paciente);

        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Evento']))
            $model->attributes = $_GET['Evento'];

        $this->render('admin', array(
            'model' => $model,
            'calendarJSON' => $this->cargarEventos(),
            'model_paciente' => $model_paciente,
            'autoCompletePaciente' => $autoCompletePaciente,
        ));
    }

    /**
     * @return string
     */
    private function cargarEventos()
    {
        $tableModel = Evento::model()->findAll();
        $JSON = "";

        foreach ($tableModel as $event) {
            $descripcion = "";

            if (isset($event->citas[0]) && !empty($event->citas[0]->id)) {
                $descripcion .= str_replace("\"", "", json_encode("Paciente: " . $event->citas[0]->paciente->nombre1 . " " . $event->citas[0]->paciente->apellido1 . "\n\n"));
            }

            $descripcion .= str_replace("\"", "", json_encode($event->descripcion));

            $anioCreadoI = date("Y", strtotime($event->fechaInicio));
            $mesCreadoI = date("m", strtotime($event->fechaInicio)) - 1;
            $diaCreadoI = date("d", strtotime($event->fechaInicio));
            $horaCreadoI = date("H", strtotime($event->fechaInicio));
            $minCreadoI = date("i", strtotime($event->fechaInicio));
            $anioCreadoF = date("Y", strtotime($event->fechaFin));
            $mesCreadoF = date("m", strtotime($event->fechaFin)) - 1;
            $diaCreadoF = date("d", strtotime($event->fechaFin));
            $horaCreadoF = date("H", strtotime($event->fechaFin));
            $minCreadoF = date("i", strtotime($event->fechaFin));

            $JSON .= "{";
            $JSON .= "id: '" . $event->id . "',";
            $JSON .= "title: '" . $descripcion . "',";
            $JSON .= "start: new Date(" . $anioCreadoI . "," . $mesCreadoI . "," . $diaCreadoI . "," . $horaCreadoI . "," . $minCreadoI . "),";
            $JSON .= "end: new Date(" . $anioCreadoF . "," . $mesCreadoF . "," . $diaCreadoF . "," . $horaCreadoF . "," . $minCreadoF . "),";
            $JSON .= "allDay: false,";
            //$JSON = "url: '" . Yii::app()->createUrl("event/view", array("id"=>$event->id)) . "'";
            $JSON .= "},";

        }

        return $JSON;

    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'evento-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
