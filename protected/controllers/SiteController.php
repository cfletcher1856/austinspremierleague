<?php
Yii::import('application.modules.admin.models.Season');
Yii::import('application.modules.admin.models.Division');
Yii::import('application.modules.admin.models.Schedule');
Yii::import('application.modules.admin.models.Player');
Yii::import('application.modules.admin.models.PlayerSeason');
Yii::import('application.modules.admin.models.BlindDraw');
Yii::import('application.models.Standings');
Yii::import('application.models.Statistics');
Yii::import('application.models.UpcomingSeason');
Yii::import('ext.phpmailer.JPhpMailer');
Yii::import('application.commands.emailscheduleCommand', true);

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

	public function actionSummerSeason()
	{
		$this->render('summerseason');
	}

	public function actionTest()
	{
		$mail = new JPhpMailer();
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		$mail->SingleTo = true;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = "mail.austinspremierleague.com";
		$mail->Hostname = 'austinspremierleague.com';
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 465;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		//Username to use for SMTP authentication
		$mail->Username = "schedule@austinspremierleague.com";
		//Password to use for SMTP authentication
		$mail->Password = "RqUXQCiem(13";
		//Set who the message is to be sent from
		$mail->setFrom('schedule@austinspremierleague.com', 'APL');
		//Set an alternative reply-to address
		$mail->addReplyTo('schedule@austinspremierleague.com', 'APL');
		//Set who the message is to be sent to
		// $mail->addAddress('colin@protectamerica.com', 'Colin Fletcher');
		$mail->addAddress('cfletcher1856@gmail.com', 'Colin Fletcher');
		//Set the subject line
		$mail->Subject = 'PHPMailer SMTP test Next one';
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML('Tomorrow meeting is canceled');
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';

		// v=spf1 +a +mx +ip4:74.220.215.54 ?all

		//send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}


		mail('cfletcher1856@gmail.com', 'from php mail', 'from php mail', '', '-fschedule@austinspremierleague.com');


		// $mail->isSMTP();
		// try{
		// 	$mail->SMTPDebug = 2;
		// 	$mail->Debugoutput = 'html';
		// 	$mail->SMTPAuth = true;
		// 	$mail->SMTPSecure = 'ssl';
		// 	$mail->Hostname = 'austinspremierleague.com';
		// 	$mail->Host = 'host254.hostmonster.com';
		// 	// $mail->Host = 'mail.colin-fletcher.com';
		// 	$mail->Port = 465;
		// 	// $mail->Username = 'colin@colin-fletcher.com';
		// 	// $mail->Password = '2IPVMD=7]OEA';
		// 	$mail->Username = 'schedule@austinspremierleague.com';
		// 	$mail->password = '7)L7+?3}ci^*';

		// 	$mail->setFrom('schedule@austinspremierleague.com', "Austin's Premier League");
		// 	// $mail->AddReplyTo('colin@colin-fletcher.com', 'Testing');

		// 	$mail->Subject = "PHPMailer through gmail";
		// 	$mail->msgHTML("hi");

		// 	$mail->addAddress('cfletcher1856@gmail.com', 'Colin Fletcher');
		// 	$mail->Send();

		// } catch (phpmailerException $e) {
		// 	echo $e->errorMessage(); //Pretty error messages from PHPMailer
		// } catch (Exception $e) {
		// 	echo $e->getMessage(); //Boring error messages from anything else!
		// }

		echo "<pre>";
		print_r($mail);
		echo "</pre>";

		$this->render('summerseason');
	}

	public function actionStandings()
	{
		$divisions = Division::model()->findAllByAttributes(array('active' => 1));
		$_standings = array();
		$previous_standings = array();
		$last_week = Standings::getLastWeek();
		foreach($divisions as $division){
			$standings = Standings::getStandings($division->id);
			$_previous_weeks_standings = Standings::getStandings($division->id, $last_week);
			$stats[$division->id]['ton_eighties'] = Standings::getMostTonEighties($division->id);
			$stats[$division->id]['quality_points'] = Standings::getMostQualityPoints($division->id);
			$stats[$division->id]['average_quality_points'] = Standings::getAvgQualityPoints($division->id);
			$stats[$division->id]['high_out'] = Standings::getHighOut($division->id);
			$stats[$division->id]['ton_plus_checkouts'] = Standings::getMostTonPlusCheckouts($division->id);
			$_standings[$division->id] = $standings;
			$previous_standings[$division->id] = $_previous_weeks_standings;
		}

		foreach($previous_standings as $division => $players)
		{
			$ctr = 1;
			foreach($players as $player)
			{
				$blah[$division][$player['player']] = $ctr;
				$ctr++;
			}
		}

		$this->render('standings', array(
			'_standings' => $_standings,
			'stats' => $stats,
			'blah' => $blah
		));
	}

	public function actionSchedule($season, $division)
	{
		$season = Season::model()->findByAttributes(array('name' => $season));
		$_division = Division::model()->findByAttributes(array('division' => $division));

        $season_id = $season->id;

        $players = PlayerSeason::model()->findAllByAttributes(array(
        	'season_id' => $season_id,
        	'division_id' => $_division->id
        ));

        $players_id = array();
        foreach($players as $player){
        	$players_id[] = $player->player->id;
        }

        //echo "<pre>";print $season_id;print_r(implode(', ', $players_id));echo "</pre>";

        $schedule = Schedule::model()->findAll(array(
        	'order' => '`week`, `match`, `board`',
        	'condition' => '`season_id` = :season_id AND (`home_player` IN ('.implode(', ', $players_id).') OR `away_player` IN ('. implode(', ', $players_id).'))',
        	'params' => array(':season_id' => (int)$season_id),
        ));

        $_schedule = array();
        foreach($schedule as $s){
        	//echo "{$s->week} => {$s->match} => {$s->board} => {$s->getMatchup()}<br />";
        	$_date = new DateTime($s->date);
        	$_schedule[$_date->format('m/d/Y')][$s->match][$s->board] = $s->getMatchup() . "<br />(Chalker: " . $s->getChalker() . ")";
        	$bar_list[$_date->format('m/d/Y')] = $s->getBar();
        }

        //echo "<pre>";print_r($schedule);echo "</pre>";

		$this->render('schedule', array(
			'schedule' => $_schedule,
			'division' => $division,
			'bar_list' => $bar_list,
		));
	}

	public function actionMakeups()
	{
		$season_id = Standings::getCurrentSeason()->id;
		$today = new DateTime();
		// We dont want to include the matches on match day so we are going to
		// drop the date by one
		$today->modify('-1day');
		$today = $today->format('Y-m-d');

		// Player ID 25  = Jim

		$sql = "
			SELECT
				s.id
			FROM `schedule` as s
			LEFT OUTER JOIN `match` as m
			ON s.id = m.schedule_id
			WHERE s.date <= '$today'
			AND m.id is null
			AND s.season_id = $season_id
			AND (s.home_player != 25 AND s.away_player != 25)
		";

		$makeups = Yii::app()->db->createCommand($sql)->queryAll();

		$scheduleids = array();
		foreach($makeups as $makeup){
			$scheduleids[] = $makeup['id'];
		}
		$matches = array();
		if(count($scheduleids)){
			$matches = Schedule::model()->findAllByAttributes(array(), 'id IN('. implode(',', $scheduleids) .') ORDER BY week');
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
			'condition' => 'active = :active AND f_name <> :fname AND f_name <> :fname2',
			'params' => array(':active' => 1, ':fname' => 'Raggedy', ':fname2' => 'Texas')
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

	public function actionFixSchedule()
	{

		$players = PlayerSeason::model()->findAllByAttributes(array(
			'season_id' => 1
		));

		$home_player_sql = "
			UPDATE schedule SET home_player = %d WHERE home_player = %d and season_id = 1
		";

		$away_player_sql = "
			UPDATE schedule SET away_player = %d WHERE away_player = %d and season_id = 1
		";

		$chalker_sql = "
			UPDATE schedule SET chalker = %d WHERE chalker = %d and season_id = 1
		";


		foreach($players as $player){
			print $player->player->getFullName() . " => ".sprintf($home_player_sql, $player->id, $player->player_id)."<br />";
			print $player->player->getFullName() . " => ".sprintf($away_player_sql, $player->id, $player->player_id)."<br />";
			print $player->player->getFullName() . " => ".sprintf($chalker_sql, $player->id, $player->player_id)."<br />";
		}

		$this->render('fix');
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

	public function actionScheduleJson()
	{
		$sd = new ScheduleData();
		$players_schedule = $sd->getPlayersSchedule();
        $schedule = $sd->getThisWeeksSchedule();

        $thisjson = array();

        foreach($schedule as $s)
        {
            $bar = $s->getBar();
            $board = $s->board;
            $week = $s->week;
            $games = $players_schedule[$s->h_player->email];
            $email_body = $sd->generateEmail($week, $bar, $board, $games);
            // Adding league balance
            $email_body .= "\n\n";
            $email_body .= "Your League Balance: $".$s->h_player->getLeagueBalance();

            $thisjson[$s->h_player->email]['message'] = $email_body;
            $thisjson[$s->h_player->email]['subject'] = "APL Week {$week} schedule";
        }

		header('Content-type: application/json');
		print CJSON::encode($thisjson);
		foreach (Yii::app()->log->routes as $route) {
	        if($route instanceof CWebLogRoute) {
	            $route->enabled = false; // disable any weblogroutes
	        }
	    }
	    Yii::app()->end();
	}

	public function actionUpcomingSeason()
	{
		$model=new UpcomingSeasonForm;
		$m = new UpcomingSeason;
		if(isset($_POST['UpcomingSeasonForm']))
		{
			$model->attributes=$_POST['UpcomingSeasonForm'];
			if($model->validate())
			{
				$now = new DateTime();
				$m->name = $model->name;
				$m->season = 'Spring 2015';
				$m->qualifier = ($model->qualifier == 'Yes') ? 1 : 0;
				$m->email = $model->email;
				$m->body = $model->body;
				$m->created = $now->format('Y-m-d H:i:s');
				if(!$m->save()){
					Yii::app()->user->setFlash('error','Error saving model: ' . print_r($m->getErrors(), true));
				}

				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode("Spring 2015 League Signup").'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				foreach(Yii::app()->params['adminEmail'] as $email){
					mail($email,$subject,$model->body . "  Qualifier: $model->qualifier", $headers);
				}
				Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('upcomingseason',array('model'=>$model));
	}

	public function actionSummersignup()
	{
		$model=new UpcomingSeasonForm;
		if(isset($_POST['UpcomingSeasonForm']))
		{
			$model->attributes=$_POST['UpcomingSeasonForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode("Summer 2014 League").'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('summersignup',array('model'=>$model));
	}

	public function actionDivisionStatistics()
	{
		$divisions = Division::model()->findAllByAttributes(array('active' => 1));
		$season = Standings::getCurrentSeason();
		$stats = Statistics::getDivisionStats();

		$this->render('division_statistics', array(
			'divisions' => $divisions,
			'stats' => $stats,
			'season' => $season
		));
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
			{
				$this->redirect(array($model->get_redirect()));
			}
		}
		// display the login form
		$model->password = '';
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

	public function actionStatistics()
	{
		$stats = Statistics::getStats();

		$divisions = Division::model()->findAll();
		$seasons = Season::model()->findAll();

		foreach($seasons as $season)
		{
			$_seasons .= "'".$season->name."',";
		}

		$_seasons = rtrim($_seasons, ',');

		$ton_eighties = array();
		$quality_points = array();
		$avg_darts = array();
		$three_dart_avg = array();
		foreach($stats as $season_id => $division)
		{
			foreach($division as $division_id => $stuff){
				// print $season_id."<br />";
				// print $division_id."<br />";
				// print $stuff."<br />";
				$ton_eighties[$division_id][] = $stats[$season_id][$division_id]['ton_eighties'];
				$quality_points[$division_id][] = $stats[$season_id][$division_id]['quality_points'];
				$avg_darts[$division_id][] = $stats[$season_id][$division_id]['darts_thrown'];
				$three_dart_avg[$division_id][] = $stats[$season_id][$division_id]['three_dart_avg'];
			}
		}

		$this->render('statistics', array(
			'stats' => $stats,
			'seasons' => $_seasons,
			'divisions' => $divisions,
			'ton_eighties' => $ton_eighties,
			'avg_darts' => $avg_darts,
			'three_dart_avg' => $three_dart_avg,
			'quality_points' => $quality_points
		));
	}

	public function actionBlindDraw()
	{
		$blind_draws = BlindDraw::model()->findAll(array(
			'order' => "date desc"
		));

		$this->render('blind_draw', array(
			'blind_draws' => $blind_draws
		));
	}

	public function actionBlah()
	{
		//echo phpinfo();
		echo uniqid();
	}

	public function actionForgotPassword()
	{
		$model = new ForgotPasswordForm;

		if(isset($_POST['ForgotPasswordForm']))
		{
			$model->attributes=$_POST['ForgotPasswordForm'];

			// validate user input and redirect to the previous page if valid
			if($model->set_reset_token($this))
			{
				$this->redirect(array('//login'));
			}
		}

		$this->render('forgot_password', array(
			'model' => $model
		));
	}

	public function actionResetPassword($uuid)
	{
		$model = new ResetPasswordForm;

		$user = Player::model()->findByAttributes(array(
			'reset_token' => $uuid
		));

		if(isset($_POST['ResetPasswordForm']) && !is_null($user))
		{
			$user->password = md5($_POST['ResetPasswordForm']['password']);
			$user->reset_token = null;
			$user->reset_time = null;
			if($user->save()){
				Yii::app()->user->setFlash('success', 'Your password has been updated.  Please login now.');
				$this->redirect(array('//login'));
			}

			Yii::app()->user->setFlash('error', 'There was a problem resetting your password.  Please try again.');
		}

		if(is_null($user)){
			Yii::app()->user->setFlash('error', 'We could not find a record of you wanting to change your password.  Please fill out the forgot password form again.');
			$this->redirect(array('//forgotpassword'));
		}

		$this->render('reset_password', array(
			'model' => $model
		));
	}
}

