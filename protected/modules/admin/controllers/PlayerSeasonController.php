<?php

class PlayerSeasonController extends AdminController
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
		$model=new PlayerSeason;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PlayerSeason']))
		{
			$model->attributes=$_POST['PlayerSeason'];
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Players added to Season');
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
		$model = new PlayerSeason;
		$season = Season::model()->findByPk($id);
		$divisions = Division::model()->findAll();
		$_activePlayers = Player::model()->findAllByAttributes(array(
			'active' => 1
		));
		$players = PlayerSeason::model()->findAllByAttributes(array(
			'season_id' => $season->id
		));

		$activePlayers = array();
		foreach($_activePlayers as $player){
			if($player->f_name != "Raggedy" && $player->f_name != "Texas"){
				$activePlayers[] = array('player_id' => (string)$player->id, 'name' => $player->getFullName());
			}
		}

		$activeDivisions = array();
		foreach($divisions as $division){
			$activeDivisions[] = array('division_id' => (string)$division->id, 'name' => $division->division);
		}

		$currentPlayers = array();
		foreach($players as $player){
			$currentPlayers[] = array('division' => (string)$player->division_id, 'player' => (string)$player->player_id);
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PlayerSeason']))
		{
			$season_id = $_POST['PlayerSeason']['season_id'];
			$players = json_decode($_POST['PlayerSeason']['player_json']);
			foreach($players->players as $player){
				$player_season = PlayerSeason::model()->findByAttributes(array(
					'season_id' => $season_id,
					'division_id' => $player->division,
					'player_id' => $player->player
				));

				// Create if we cant find a record
				if(!count($player_season)){
					$player_season = new PlayerSeason;
				}

				$player_season->season_id = $season_id;
				$player_season->division_id = $player->division;
				$player_season->player_id = $player->player;
				$player_season->save();
			}

			Yii::app()->user->setFlash('success', 'Players Added to season');
			$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
			'season'=>$season,
			'divisions'=>$divisions,
			'activePlayers' => $activePlayers,
			'activeDivisions' => $activeDivisions,
			'players'=>$players,
			'currentPlayers'=>$currentPlayers,
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
		$dataProvider=new CActiveDataProvider('PlayerSeason');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PlayerSeason('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PlayerSeason']))
			$model->attributes=$_GET['PlayerSeason'];

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
		$model=PlayerSeason::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='player-season-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
