<?php

class PacienteController extends Controller
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
				'actions'=>array('admin','create','update','index','view'),
				'users'=>array('admin','secretaria'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paciente;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Paciente']))
		{
                        
                        $model->attributes=$_POST['Paciente'];
                        
                        if($model->save())
                        {				
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

		if(isset($_POST['Paciente']))
		{
                        
			$model->attributes=$_POST['Paciente'];
                        
			if($model->save()) 
                        {                                
                                Yii::app()->User->setFlash('success','Se actualizo correctamente');
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
		$dataProvider=new CActiveDataProvider('Paciente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

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
		$model=Paciente::model()->findByPk($id);

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paciente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function getEdoCivil($id)
        {//'0'=>'Soltera','1'=>'Casada','2'=>'Divorciada','3'=>'Viuda','4'=>'Concubino'
                        
            $model=Paciente::model()->findByPk($id);
            
            if($model->edo_civil == '0') return 'Soltera';
            else if($model->edo_civil == '1') return 'Casada';
            else if($model->edo_civil == '2') return 'Divorciada';
            else if($model->edo_civil == '3') return 'Viuda';
            else return 'Concubino';
            
        }

    public function cargarMenuMenarquia() 
    {
        return array(
            '0' => '0',
            'I' => 'I - 1',
            'II' => 'II - 2',
            'III' => 'III - 3',
            'IV' => 'IV - 4',
            'V' => 'V  - 5',
            'VI' => 'VI  - 6',
            'VII' => 'VII  - 7',
            'VIII' => 'VIII  - 8',
            'IX' => 'IX  - 9',
            'X' => 'X  - 10',
            'XI' => 'XI  - 11',
            'XII' => 'XII - 12',
            'XIII' => 'XIII - 13',
            'XIV' => 'XIV - 14',
            'XV' => 'XV - 15',
            'XVI' => 'XVI - 16',
            'XVII' => 'XVII - 17',
            'XVIII' => 'XVIII - 18',
        );
        
    }
        
}