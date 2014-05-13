<?php

class HistoriaGinecologiaController extends Controller
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
                'actions' => array('admin', 'delete', 'create', 'update', 'index', 'view', 'pacienteAutoComplete', 'historia','createPDF'),
                'users' => array('admin'),
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
        $model_historia = $this->loadModel($id);
        $model_historia_paciente = HistoriaGinecologia::model()->getHistoriasGinecologicasByPaciente($model_historia->paciente->id);

        $this->render('view', array(
            'model' => $model_historia,
            'model_historia_paciente' => $model_historia_paciente,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = HistoriaGinecologia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function ActionCreatePDF($id)
    {
        $mpdf = Yii::app()->ePdf->mpdf();

        $model_historia = $this->loadModel($id);
        $model_historiaO_paciente = HistoriaObstetricia::model()->getHistoriasObstetriciaByPaciente($model_historia->paciente->id);
        $model_historiaG_paciente = HistoriaGinecologia::model()->getHistoriasGinecologicasByPaciente($model_historia->paciente->id);
        $historia = array($model_historiaG_paciente, $model_historiaO_paciente);

        $stylesheet = file_get_contents('C:\wamp\www\Gineobs\themes\hebo\css\pdfMain.css');

        //configurando pdf general
        $mpdf = new mPDF('utf-8', 'Letter-L');

        //agregando header y footer
        $mpdf->SetHeader('{DATE j-m-Y}||Recipe #' . $model_historia->paciente->id);
        $mpdf->SetFooter('Dr. María Hernández|Ginecologia y obstetricia|{PAGENO}');

        //Propiedades del PDF
        $mpdf->setTitle("Historia Medica");
        $mpdf->setAuthor("María Hernández");
        $mpdf->setCreator("Edgar Cardona y Gabriela Soto");
        $mpdf->setSubject("Historia medica de pacientes.");
        $mpdf->setKeywords("Historia,Medicina");

        //escribiendo CSS
        $mpdf->WriteHTML($stylesheet, 1);

        //Escribiendo PDF
        $mpdf->writeHTML($this->renderPartial('historia', array(
            'model' => $model_historia->paciente->id,
            'historia' => $historia,
        ),true), 2);

        //Salida
        $mpdf->output("Recipe Medico", EYiiPdf::OUTPUT_TO_DOWNLOAD);
    }

    public function actionHistoria($id)
    {
        $model_historia = $this->loadModel($id);
        $model_historiaO_paciente = HistoriaObstetricia::model()->getHistoriasObstetriciaByPaciente($model_historia->paciente->id);
        $model_historiaG_paciente = HistoriaGinecologia::model()->getHistoriasGinecologicasByPaciente($model_historia->paciente->id);
        $historia = array($model_historiaG_paciente, $model_historiaO_paciente);


        $this->render('historia', array(
            'model' => $model_historia->paciente->id,
            'historia' => $historia,
        ));
    }

    public function actionPacienteAutoComplete()
    {
        $search = $_GET['term'];
        $criteria = new CDbCriteria();
        $criteria->compare('id', $search, true, 'OR');
        $criteria->compare('nombre1', $search, true, 'OR');
        $criteria->compare('nombre2', $search, true, 'OR');
        $criteria->compare('apellido1', $search, true, 'OR');
        $criteria->compare('apellido2', $search, true, 'OR');
        $criteria->order = 'nombre1';

        $pacientes = Paciente::model()->findAll($criteria);
        $array = array();

        foreach ($pacientes as $paciente) {
            $array[] = $paciente->id . " - " . $paciente->nombre1 . ' ' . $paciente->apellido1;
        }

        echo CJSON::encode($array);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $modelGineco = new HistoriaGinecologia;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array($modelGineco));

        if (isset($_POST['HistoriaGinecologia'])) {
            $modelGineco->attributes = $_POST['HistoriaGinecologia'];
            $modelGineco->diagnostico = $_POST['HistoriaGinecologia']['diagnostico'];
            $modelGineco->tratamiento = $_POST['HistoriaGinecologia']['tratamiento'];

            if ($modelGineco->save()) {
                $modelGineco->saveMtM($modelGineco->relData, $modelGineco->id, $modelGineco->ginecologiaEnfermedads);

                $this->redirect(array('view', 'id' => $modelGineco->id));
            }

            //$this->redirect(array('/dashboard/index','id' => $modelGineco->paciente_id,'opt' => $this->id),true);
        }

        $this->render('create', array(
            'modelGineco' => $modelGineco,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'historia-ginecologia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $modelGineco = $this->loadModel($id);
        $model_historia_paciente = HistoriaGinecologia::model()->getHistoriasGinecologicasByPaciente($modelGineco->paciente->id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($modelGineco);

        if (isset($_POST['HistoriaGinecologia'])) {
            $ginecologiaEnfermedadsOLD = $modelGineco->ginecologiaEnfermedads;
            $modelGineco->attributes = $_POST['HistoriaGinecologia'];

            if ($modelGineco->save()) {
                $modelGineco->updateMtM($modelGineco->relData, $modelGineco->id, $modelGineco->ginecologiaEnfermedads, $ginecologiaEnfermedadsOLD);

                $this->redirect(array('view', 'id' => $modelGineco->id));
            }

            //$this->redirect(array('/dashboard/index','id' => $modelGineco->paciente_id,'opt' => $this->id),true);

        }

        $this->render('update', array(
            'modelGineco' => $modelGineco,
            'model_historia_paciente' => $model_historia_paciente,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->deleteMtM($model->relData, $id, $model->ginecologiaEnfermedads);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('HistoriaGinecologia');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new HistoriaGinecologia('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['HistoriaGinecologia']))
            $model->attributes = $_GET['HistoriaGinecologia'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function visualizarArreglo($arreglo, $atributo)
    {
        $resultado = "";

        foreach ($arreglo as $variable) {
            $resultado .= '- ' . $variable->{$atributo} . '</br>';
        }

        return $resultado;

    }

    /**
     * @return HistoriaGinecologia
     */
    public function getPrimaryModel()
    {
        return new HistoriaGinecologia();
    }

}
