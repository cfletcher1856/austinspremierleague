<?php

class MatchController extends AdminController
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
				'actions'=>array('index','view', 'create', 'update', 'email', 'details'),
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
		$schedule = Schedule::model()->findByPk($id);

		$matches = array(new Match, new Match);

		$h_match = Match::model()->findByAttributes(array('schedule_id' => $id, 'player_id' => $schedule->h_player->id));
		$a_match = Match::model()->findByAttributes(array('schedule_id' => $id, 'player_id' => $schedule->a_player->id));

		if($h_match){
			$matches[0] = $h_match;
		}

		if($a_match){
			$matches[1] = $a_match;
		}

		$this->render('view',array(
			'schedule' => $schedule,
			'matches' => $matches,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Match;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Match']))
		{
			$model->attributes=$_POST['Match'];
			$o_date = new DateTime($_POST['Match']['date']);
			$model->date = $o_date->format('Y-m-d');
			if($model->save())
				$this->redirect(array('index'));
		}

		if(!$model->date){
			$today = new DateTime();
			$model->date = $today->format('m/d/Y');
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
		//$model=$this->loadModel($id);
		$schedule = Schedule::model()->findByPk($id);

		$matches = array(new Match, new Match);

		$h_match = Match::model()->findByAttributes(array('schedule_id' => $id, 'player_id' => $schedule->h_player->id));
		$a_match = Match::model()->findByAttributes(array('schedule_id' => $id, 'player_id' => $schedule->a_player->id));

		if($h_match){
			$matches[0] = $h_match;
		}

		if($a_match){
			$matches[1] = $a_match;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Match']))
		{
			$valid = true;
			foreach($matches as $m => $match){
				if(isset($_POST['Match'][$m]))
					$match->attributes=$_POST['Match'][$m];

				if($_POST['Match'][$m]['legs_won'] > $_POST['Match'][$m]['legs_lost']){
					$match->points = 2;
				} elseif($_POST['Match'][$m]['legs_won'] < $_POST['Match'][$m]['legs_lost']){
					$match->points = 0;
				} else {
					$match->points = 1;
				}

				$valid = $match->validate() && $valid;
			}
			if($valid){
				foreach($matches as $m => $match){
					$match->save();
				}
				Yii::app()->user->setFlash('success', 'Match Updated');
				$this->redirect(array('details', 'id' => $id));
			}
		}

		$this->render('update',array(
			'schedule' => $schedule,
			'matches' => $matches,
		));
	}


	public function actionDetails($id){
		$schedule = Schedule::model()->findByPk($id);

		$h_match = Match::model()->findByAttributes(array(
			'schedule_id' => $id,
			'player_id' => $schedule->h_player->id
		));
		$a_match = Match::model()->findByAttributes(array(
			'schedule_id' => $id,
			'player_id' => $schedule->a_player->id
		));

		$match_ids['home'] = $h_match->id;
		$match_ids['away'] = $a_match->id;

		$home_match_details = array();
		$away_match_details = array();

		$matches_played = (int)$h_match->legs_won + (int)$h_match->legs_lost;

		foreach(range(1, $matches_played) as $x){
			$home_match_details[$x] = new MatchDetails;
			$away_match_details[$x] = new MatchDetails;
		}

		$details = MatchDetails::model()->findAllByAttributes(array('schedule_id' => $id));

		foreach($details as $detail){
			if($detail['player_id'] == $schedule->h_player->id){
				$home_match_details[$detail['match_num']] = $detail;
			} else {
				$away_match_details[$detail['match_num']] = $detail;
			}
		}

		if(isset($_POST['MatchDetails']))
		{
			foreach($_POST['MatchDetails'] as $player_id => $details){
				foreach($details as $detail){
					// print $id ."<br />";
					// print $player_id ."<br />";
					// print $detail['match_id'] ."<br />";
					// print "-----------";

					$md = MatchDetails::model()->findByAttributes(array(
						'schedule_id' => $id,
						'player_id' => $player_id,
						'match_id' => $detail['match_id'],
						'match_num' => $detail['match_num']
					));

					if(!$md){
						$md = new MatchDetails;
					}

					// echo "<pre>";print_r($detail);echo "</pre>";

					$md->match_id = $detail['match_id'];
					$md->match_num = $detail['match_num'];
					$md->player_id = $player_id;
					$md->schedule_id = $detail['schedule_id'];
					$md->darts_thrown = $detail['darts_thrown'];
					$md->out = $detail['out'];
					$md->points_left = $detail['points_left'];
					$md->save();
				}
			}
			Yii::app()->user->setFlash('success', 'Match Details Updated');
			$this->redirect(array('index'));
		}

		$this->render('_details_form',array(
			'schedule' => $schedule,
			'home_match_details' => $home_match_details,
			'away_match_details' => $away_match_details,
			'match_ids' => $match_ids,
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
		$current_season = Standings::getCurrentSeason();
		$render_options = array();
		foreach(range(1, $current_season->getSeasonWeeks()) as $week){
			$week_schedule = 'week'.$week.'Schedule';

			$$week_schedule = Schedule::model()->findAllByAttributes(array(
				"week" => $week,
				'season_id' => $current_season->id
			));
			$render_options[$week_schedule] = $$week_schedule;
		}

		$this->render('index', $render_options);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Match('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Match']))
			$model->attributes=$_GET['Match'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionEmail(){
		$divisions = Division::model()->findAll();
		$_standings = array();
		foreach($divisions as $division){
			$standings = Standings::getStandings($division->id);
			$stats[$division->id]['ton_eighties'] = Standings::getMostTonEighties($division->id);
			$stats[$division->id]['quality_points'] = Standings::getMostQualityPoints($division->id);
			$stats[$division->id]['high_out'] = Standings::getHighOut($division->id);

			$_standings[$division->id] = $standings;
		}

		$mailer = new JPhpMailer(true);
		$mailer->SingleTo = true;

		$players = Player::model()->findAllByAttributes(array('active' => '1'));
		try{
			$mailer->Subject = "Austin's Premier League Stangings";
			$mailer->SetFrom('standings@austinspremierleague.com');
			$mailer->AddReplyTo('standings@austinspremierleague.com');
			$mailer->MsgHTML($this->renderPartial('standings_email', array('_standings' => $_standings, 'stats' => $stats), true));
			foreach($players as $player){
				//if($player->f_name == 'Colin' /*|| $player->f_name == 'Ryan'*/){
					$mailer->AddAddress($player->email, $player->f_name . ' ' . $player->l_name);
				//}
			}
			$mailer->send();
		} catch(phpmailerException $e){
			$error = $e->errorMessage();
		} catch(Exception $e){
			$error = $e->errorMessage();
		}

		if($error){
			Yii::app()->user->setFlash('error', $error);
		} else {
			Yii::app()->user->setFlash('success', 'Players Notified');
		}
		$this->redirect(array('index'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Match::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='stats-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
