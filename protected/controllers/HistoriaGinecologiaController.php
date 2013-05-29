<?php

class HistoriaGinecologiaController extends Controller
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
		$modelGineco=new HistoriaGinecologia;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($modelGineco));

		if(isset($_POST['HistoriaGinecologia']))
		{
			$modelGineco->attributes=$_POST['HistoriaGinecologia'];
                        
			if($modelGineco->save())
                        {
                            $modelGineco->saveMtM($modelGineco->relData,$modelGineco->id, $modelGineco->ginecologiaEnfermedads);
                            
                            $this->redirect(array('view','id'=>$modelGineco->id));
                        }
		}

		$this->render('create',array(
			'modelGineco'=>$modelGineco,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelGineco=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($modelGineco);

		if(isset($_POST['HistoriaGinecologia']))
		{
			$ginecologiaEnfermedadsOLD = $modelGineco->ginecologiaEnfermedads;
                        $modelGineco->attributes=$_POST['HistoriaGinecologia'];
                        
			if($modelGineco->save())
                        {
                            $modelGineco->updateMtM($modelGineco->relData,$modelGineco->id, $modelGineco->ginecologiaEnfermedads, $ginecologiaEnfermedadsOLD);
                            $this->redirect(array('view','id'=>$modelGineco->id));
                        }
                
                }

		$this->render('update',array(
			'modelGineco'=>$modelGineco,
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
                $model->deleteMtM($model->relData,$id,$model->ginecologiaEnfermedads);
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
		$dataProvider=new CActiveDataProvider('HistoriaGinecologia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistoriaGinecologia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistoriaGinecologia']))
			$model->attributes=$_GET['HistoriaGinecologia'];

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
		$model=HistoriaGinecologia::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='historia-ginecologia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
