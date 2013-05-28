<?php
Yii::import('application.modules.admin.models.Season');
Yii::import('application.modules.admin.models.Schedule');
Yii::import('application.modules.admin.models.Player');
Yii::import('application.models.Standings');

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionAbout()
	{
		$this->render('about');
	}

	public function actionStandings()
	{
		$standings = Standings::getStandings();
		$stats['ton_eighties'] = Standings::getMostTonEighties();
		$stats['quality_points'] = Standings::getMostQualityPoints();
		$stats['high_out'] = Standings::getHighOut();

		$this->render('standings', array(
			'standings' => $standings,
			'stats' => $stats
		));
	}

	public function actionSchedule()
	{
		$season = Standings::getCurrentSeason();

        $season_id = $season->id;

        $schedule = Schedule::model()->findAll(array(
        	'order' => '`week`, `match`, `board`',
        	'condition' => 'season_id=:season_id',
        	'params' => array(':season_id' => $season_id),
        ));

        $_schedule = array();
        foreach($schedule as $s){
        	$_schedule[$s->week][$s->match][$s->board] = $s->getMatchup() . "<br />(Chalker: " . $s->getChalker() . ")";
        }

		$this->render('schedule', array('schedule' => $_schedule));
	}

	public function actionMakeups()
	{
		$season_id = Standings::getCurrentSeason()->id;
		$today = new DateTime();
		// We dont want to include the matches on match day so we are going to
		// drop the date by one
		$today->modify('-1day');
		$today = $today->format('Y-m-d');

		$sql = "
			SELECT
				s.id
			FROM `schedule` as s
			LEFT OUTER JOIN `match` as m
			ON s.id = m.schedule_id
			WHERE s.date <= '$today'
			AND m.id is null
			AND s.season_id = $season_id
		";

		$makeups = Yii::app()->db->createCommand($sql)->queryAll();

		$scheduleids = array();
		foreach($makeups as $makeup){
			$scheduleids[] = $makeup['id'];
		}
		$matches = array();
		if(count($scheduleids)){
			$matches = Schedule::model()->findAllByAttributes(array(), 'id IN('. implode(',', $scheduleids) .')');
		}

		$this->render('makeups', array(
			'matches' => $matches,
		));
	}

	public function actionPlayers()
	{
		$season = Standings::getCurrentSeason();

		$players = Player::model()->findAll(array(
			'order' => 'l_name',
			'condition' => 'active = :active AND f_name <> :fname',
			'params' => array(':active' => 1, ':fname' => 'Raggedy')
		));

		$this->render('players', array(
			'players' => $players,
			'season' => $season,
		));
	}

	public function actionPlayer($player)
	{
		list($fname, $lname) = split(" ", $player);
		$player = Player::model()->findByAttributes(array(
			'f_name' => $fname,
			'l_name' => $lname
		));

		$matchDataProvider = new CActiveDataProvider('Match', array(
			'criteria' => array(
				'condition' => "player_id = $id"
			)
		));

		$schedule = Schedule::model()->findAllByAttributes(array(),
			$sondition = 'home_player = :player_id OR away_player = :player_id',
			$params = array('player_id' => $player->id));

		$season = Standings::getCurrentSeason();

		$this->render('player', array(
			'player' => $player,
			'profile' => $player->profile,
			'matchDataProvider' => $matchDataProvider,
			'schedule' => $schedule,
			'season' => $season
		));
	}

	public function actionRules()
	{
		$this->render('rules');
	}

	public function actionDoubles()
	{
		$model=new DoublesForm;
		if(isset($_POST['DoublesForm']))
		{
			$model->attributes=$_POST['DoublesForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('doubles',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('//admin'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
