<?php

class HistoriaObstetriciaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('admin','delete','create','update','index','view','pacienteAutoComplete','historia','createPDF'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionPacienteAutoComplete()
    {
        $search = $_GET['term'];
        $criteria = new CDbCriteria();
        $criteria->compare('id',$search,true,'OR');
        $criteria->compare('nombre1',$search,true,'OR');
        $criteria->compare('nombre2',$search,true,'OR');
        $criteria->compare('apellido1',$search,true,'OR');
        $criteria->compare('apellido2',$search,true,'OR');
        $criteria->order = 'nombre1';

        $pacientes = Paciente::model()->findAll($criteria);
        $array = array();

        foreach($pacientes as $paciente)
        {
            $array[] = $paciente->id . " - " . $paciente->nombre1 . ' ' . $paciente->apellido1;
        }

        echo CJSON::encode($array);
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $modelGineco = $this->loadModel($id);
        $model_historia_paciente = HistoriaObstetricia::model()->getHistoriasObstetriciaByPaciente($modelGineco->paciente->id);

		$this->render('view',array(
			'model'=>$modelGineco,
			'model_historia_paciente'=>$model_historia_paciente,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new HistoriaObstetricia;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
		if(isset($_POST['HistoriaObstetricia']))
		{
			$model->attributes=$_POST['HistoriaObstetricia'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $model_historia_paciente = HistoriaObstetricia::model()->getHistoriasObstetriciaByPaciente($model->paciente->id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['HistoriaObstetricia']))
		{
			$model->attributes=$_POST['HistoriaObstetricia'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
            'model_historia_paciente' => $model_historia_paciente,
		));
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
        $historia = array($model_historiaG_paciente,$model_historiaO_paciente);

        $this->render('historia',array(
            'model' => $model_historia->paciente->id,
            'historia' => $historia,
        ));
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('HistoriaObstetricia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistoriaObstetricia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistoriaObstetricia']))
			$model->attributes=$_GET['HistoriaObstetricia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=HistoriaObstetricia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historia-obstetricia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function getTensionArterial($id)
        {
            $model=$this->loadModel($id);
            
            return $model->tension_arterial_mm.'/'.$model->tension_arterial_hg;
            
        }
        
}
