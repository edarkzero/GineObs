<?php

class RecipeController extends Controller
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
				'actions'=>array('admin','delete','create','update','index','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $this->createPDF($id);
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Recipe;
                $modelMedicina=new Medicina;
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
		if(isset($_POST['Recipe']))
		{
			$model->attributes=$_POST['Recipe'];
			if($model->save())
                        {
                            $model->saveMtM($model->relData,$model->id, $model->recipeMedicinas);
                            $this->redirect(array('view','id'=>$model->id));
                        }
                        
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

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Recipe']))
		{
			$recipeMedicinasOLD = $model->recipeMedicinas;
                        $model->attributes=$_POST['Recipe'];

			if($model->save())
                        {
                            $model->updateMtM($model->relData,$model->id, $model->recipeMedicinas, $recipeMedicinasOLD);
                            $this->redirect(array('view','id'=>$model->id));
                        }
                
                }

		$this->render('update',array(
			'model'=>$model,
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
                $model->deleteMtM($model->relData,$id,$model->recipeMedicinas);
                $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Recipe');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Recipe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Recipe']))
			$model->attributes=$_GET['Recipe'];

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
		$model=Recipe::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='recipe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function createPDF($id) {
            $mpdf = Yii::app()->ePdf->mpdf();
            $model=$this->loadModel($id);
         
            $stylesheet = file_get_contents('C:\wamp\www\Gineobs\themes\hebo\css\pdfMain.css');
             
            $texto = $texto.'<div id=contenedor>';
            
                $texto = $texto.'<div id=columna1>';
                    $texto = $texto.'<H1 class="h1PDF"> Dra. Maria C. Hernandez N.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Ginecologo-Obstetra.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> C.C. Galeno Center Of. C8  Av. Country Club. Bna.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Telf. 0281-2743367/0414-8240064. CM972.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Rif: 3956719-5 MSAS 18083.</H1>';
                $texto = $texto.'</div>';

                $texto = $texto.'<div id=columna2>';
                    $texto = $texto.'<H1 class="h1PDF"> Dra. Maria C. Hernandez N.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Ginecologo-Obstetra.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> C.C. Galeno Center Of. C8  Av. Country Club. Bna.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Telf. 0281-2743367/0414-8240064. CM972.</H1>';
                    $texto = $texto.'<H1 class="h1PDF"> Rif: 3956719-5 MSAS 18083.</H1>';
                $texto = $texto.'</div>';

                $texto = $texto.'<div id=columna1>';
                    $texto = $texto.'<p>Medicina: '. $this->visualizarArreglo($model->recipeMedicinas, 'nombre').'</p>';
                    $texto = $texto.'<p>Indicaciones: '.$model->indicaciones.' </p>';
                    $texto = $texto.'<p>Paciente: '.  Paciente::GET_NOMBRE_COMPLETO_PK($model->paciente_id).' </p>';
                    $texto = $texto.'<p>Fecha de creacion: '.  $model->fecha.' </p>';
                $texto = $texto.'</div>';
            
            $texto = $texto.'</div>';
            
           /* $mpdf->writeHTML(
                    $this->render('create',null ,true)
            );*/
            
            //Propiedades del header y footer
//            $mpdf->defaultheaderfontsize=10;
//            $mpdf->defaultheaderfontstyle='B';
//            $mpdf->defaultheaderline=0;
//            $mpdf->defaultfooterfontsize=10;
//            $mpdf->defaultfooterfontstyle='BI';
//            $mpdf->defaultfooterline=0;
            
            //configurando pdf general
            $mpdf=new mPDF('utf-8', 'Letter-L');
            
            //agregando header y footer
            $mpdf->SetHeader('{DATE j-m-Y}||Recipe #'.$model->id);
            $mpdf->SetFooter('Dr. María Hernández|Ginecologia y obstetricia|{PAGENO}');
            
            //Propiedades del PDF
            $mpdf->setTitle("Recipe Medico");
            $mpdf->setAuthor("María Hernández");
            $mpdf->setCreator("Edgar Cardona y Gabriela Soto");
            $mpdf->setSubject("Recipe medico para tratamiento de pacientes.");
            $mpdf->setKeywords("Recipe,Medico");
            
            //escribiendo CSS
            $mpdf->WriteHTML($stylesheet,1);
            
            //Escribiendo PDF
            $mpdf->writeHTML($texto,2);
            
            //Salida
            $mpdf->output("Recipe Medico", EYiiPdf::OUTPUT_TO_BROWSER);
        }
        
        public function visualizarArreglo($arreglo,$atributo)
        {
            $resultado = "";
            foreach($arreglo as $variable)
            {
                $resultado .= '- '.$variable->{$atributo}.'</br>';
            }
            
            return $resultado;
            
        }
        
}
