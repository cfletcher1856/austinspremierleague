<?php

class SeasonController extends AdminController
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
				'actions'=>array('index','view', 'create', 'update'),
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
		$current_players = PlayerSeason::model()->findAll(array(
			'order' => 'division_id',
			'condition' => 'season_id=:x',
			'params' => array(':x' => $id)
		));

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'current_players' => $current_players,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Season;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Season']))
		{
			$model->attributes=$_POST['Season'];
			$o_date = new DateTime($_POST['Season']['start_date']);
			$model->start_date = $o_date->format('Y-m-d');

			$o_date = new DateTime($_POST['Season']['end_date']);
			$model->end_date = $o_date->format('Y-m-d');
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Season Created');
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

		if(isset($_POST['Season']))
		{
			$model->attributes=$_POST['Season'];
			$o_date = new DateTime($_POST['Season']['start_date']);
			$model->start_date = $o_date->format('Y-m-d');

			$o_date = new DateTime($_POST['Season']['end_date']);
			$model->end_date = $o_date->format('Y-m-d');

			if($model->save()){
				Yii::app()->user->setFlash('success', 'Season Updated');
				$this->redirect(array('index'));
			}
		}

		$o_date = new DateTime($model->start_date);
		$model->start_date = $o_date->format('m/d/Y');

		$o_date = new DateTime($model->end_date);
		$model->end_date = $o_date->format('m/d/Y');

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
		$dataProvider=new CActiveDataProvider('Season', array(
			'criteria'=>array(
		        'order'=>'start_date DESC',
		    ),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Season('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Season']))
			$model->attributes=$_GET['Season'];

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
		$model=Season::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='season-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
