<?php
Yii::import('application.models.UpcomingSeason');

class UpcomingSeasonController extends AdminController
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
	                'actions'=>array('index','view', 'create', 'update', 'admin', 'delete'),
	                'expression'=>'$user->isAdmin()'
	            ),
	            array('deny',  // deny all users
	                'users'=>array('*'),
	            ),
	        );
	    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UpcomingSeason', array(
			'criteria' => array(
				'order' => "`created`"
			),
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=UpcomingSeason::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='upcoming-season-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
