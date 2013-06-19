<?php

class ScheduleController extends AdminController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view', 'generate', 'create', 'update', 'admin', 'delete'),
                'expression'=>'$user->isAdmin()'
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
		$model=new Schedule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
			$o_date = new DateTime($_POST['Schedule']['date']);
			$model->date = $o_date->format('Y-m-d');
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Schedule Created');
				if($_POST['SaveContinue'] == 'Save and Create Another'){
					$this->redirect(array('create'));
				}
				$this->redirect(array('index'));
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
			$o_date = new DateTime($_POST['Schedule']['date']);
			$model->date = $o_date->format('Y-m-d');
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Schedule Updated');
				$this->redirect(array('index'));
			}
		}

		$o_date = new DateTime($model->date);
		$model->date = $o_date->format('m/d/Y');

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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$render_options = array();
		foreach(range(1, 11) as $week){
			$provider = 'week'.$week.'DataProvider';
			$$provider = new CActiveDataProvider('Schedule', array(
				'criteria' => array(
					'condition' => "week = $week"
				),
				'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
			$render_options[$provider] = $$provider;
		}

		$this->render('index', $render_options);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Schedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Schedule']))
			$model->attributes=$_GET['Schedule'];

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
		$model=Schedule::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='schedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerate()
	{
		$players = array();
		$this->render('generate', array(
			'players' => $players
		));
	}
}
