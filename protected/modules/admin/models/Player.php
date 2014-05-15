<?php
Yii::import('application.modules.admin.models.*');
/**
 * This is the model class for table "player".
 *
 * The followings are the available columns in table 'player':
 * @property integer $id
 * @property string $f_name
 * @property string $l_name
 * @property string $email
 * @property string $phone
 * @property integer $active
 */
class Player extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Player the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_name, l_name, email', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('f_name, l_name, email', 'length', 'max'=>120),
			array('phone', 'length', 'max'=>15),
			array('email', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('f_name, l_name, email, phone, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'payments' => array(self::HAS_MANY, 'Payment', 'player_id'),
			'stats' => array(self::HAS_MANY, 'Match', 'player_id'),
			'profile' => array(self::HAS_ONE, 'Profile', 'player_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'f_name' => 'First Name',
			'l_name' => 'Last Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('f_name',$this->f_name,true);
		$criteria->compare('l_name',$this->l_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getFullName()
	{
		return $this->f_name . " " . $this->l_name;
	}

	public function getPlayersDropDown()
	{
		$players = Player::model()->findAllByAttributes(array(
			'active' => '1'
		));

		$_players = array();
		foreach($players as $player){
			$_players[$player->id] = $player->getFullName();
		}

		return $_players;
	}

	public function getChalkerDropDown($match_num, $season_id, $week)
	{
		if(!$match_num && !$season_id && !$week)
		{
			return array();
		}

		$sql = "
			SELECT
				home_player,
				away_player,
				chalker
			FROM schedule
			WHERE `season_id` = $season_id
			AND `week` = $week
			AND `match` = $match_num
		";

		$busy_players = Yii::app()->db->createCommand($sql)->queryAll();

		foreach($busy_players as $player)
		{
			$ids[] = $player['home_player'];
			$ids[] = $player['away_player'];
			//$ids[] = $player['chalker'];
		}

		$_ids = implode(array_unique($ids), ', ');

		$sql = "
			SELECT
				id,
				f_name,
				l_name
			FROM player
			WHERE `id` NOT IN ($_ids)
			AND `active` = 1
			AND `f_name` <> 'Raggedy'
			AND `f_name` <> 'Texas'
		";

		$chalkers = Yii::app()->db->createCommand($sql)->queryAll();

		$_chalkers = array();
		foreach($chalkers as $chalker)
		{
			$_chalkers[$chalker['id']] = $chalker['f_name'] . " " . $chalker['l_name'];
		}

		return $_chalkers;
	}

	public function getTotalPayments()
	{
		$payments = 0.00;
		foreach($this->payments as $payment){
			$payments += $payment->amount;
		}
		return $payments;
	}

	public function getStatsByMatch()
	{
		$season_id = Standings::getCurrentSeason()->id;
		$games = Schedule::model()->findAll(array(
			'condition' => 'season_id = :season_id AND (home_player = :player_id OR away_player = :player_id)',
			'params' => array(
				':season_id' => $season_id,
				':player_id' => $this->id
			),
			'order' => 'date'
		));

		$stats = array();
		foreach($games as $game)
		{
			$match = Match::model()->findByAttributes(array(
				'player_id' => $this->id,
				'schedule_id' => $game->id
			));

			$match_details = MatchDetails::model()->findAllByAttributes(array(
				'player_id' => $this->id,
				'match_id' => $match->id
			));

			$stats[$game->date]['quality_points'] += $match->quality_points;
			$stats[$game->date]['ton_eighties'] += $match->ton_eighties;
			foreach($match_details as $detail)
			{
				$stats[$game->date]['darts_thrown'] += $detail->darts_thrown;
				$stats[$game->date]['points_left'] += $detail->points_left;
			}
			$stats[$game->date]['legs'] += count($match_details);
		}

		foreach($stats as $date => $stat)
		{
			$stats[$date]['three_dart_avg'] = self::calculateThreeDartAverage($stat['legs'], $stat['points_left'], $stat['darts_thrown']);
		}

		return $stats;
	}

	public function getStats()
	{
		$_stats = $this->getStatsByMatch();

		$stats = array();
		$legs = 0;
		$match_points = 0;
		$points_left = 0;
		foreach($_stats as $stat)
		{
			$stats['quality_points'] += $stat['quality_points'];
			$stats['ton_eighties'] += $stat['ton_eighties'];
		}

		return $stats;
	}

	public static function calculateThreeDartAverage($legs, $points_left, $darts_thrown)
	{
		$three_dart_avg = 0.00;

		if($darts_thrown <= 0)
		{
			return number_format($three_dart_avg, 2);
		}

		$match_points = (int)$legs * 501;
		$total_points = (int)$match_points - (int)$points_left;

		$three_dart_avg = $total_points / ((int)$darts_thrown / 3);

		return number_format($three_dart_avg, 2);
	}

	private function paymentBreakDown()
	{
		$season = Standings::getCurrentSeason();
		$start_date = new DateTime($season->start_date);
		$fees = 0.00;
		$payments = 0.00;
		foreach($this->payments as $payment)
		{
			$payment_date = new DateTime($payment->date);
			if($payment_date->format('U') >= $start_date->format('U')){
				if($payment->txn_type == 'fee')
				{
					$fees += $payment->amount;
				}
				elseif($payment->txn_type == 'payment')
				{
					$payments += $payment->amount;
				}
			}
		}

		return array(
			'fees' => number_format($fees, 2),
			'payments' => number_format($payments, 2)
		);
	}

	public function playerFeeTotal()
	{
		$breakdown = $this->paymentBreakDown();

		return $breakdown['fees'];
	}

	public function playerPaymentTotal()
	{
		$breakdown = $this->paymentBreakDown();

		return $breakdown['payments'];
	}

	public function getLeagueBalance()
	{
		$season = Standings::getCurrentSeason();
		$breakdown = $this->paymentBreakDown();

		$total_fees = $season->dues + $breakdown['fees'];

		return number_format($total_fees - $breakdown['payments'], 2);
	}

	public function activeChar(){
        return ($this->active) ? 'Y' : 'N';
    }

    public function getLifetimeStats(){
    	$games = Schedule::model()->findAll(array(
    		'condition' => 'home_player = :player_id OR away_player = :player_id',
    		'params' => array(
    			':player_id' => $this->id
    		),
    		'order' => 'date'
    	));

    	$stats = array();
    	foreach($games as $game)
    	{
    		$match = Match::model()->findByAttributes(array(
    			'player_id' => $this->id,
    			'schedule_id' => $game->id
    		));

    		$match_details = MatchDetails::model()->findAllByAttributes(array(
    			'player_id' => $this->id,
    			'match_id' => $match->id
    		));

    		$stats[$game->date]['quality_points'] += $match->quality_points;
    		$stats[$game->date]['ton_eighties'] += $match->ton_eighties;
    		foreach($match_details as $detail)
    		{
    			$stats[$game->date]['darts_thrown'] += $detail->darts_thrown;
    			$stats[$game->date]['points_left'] += $detail->points_left;
    		}
    		$stats[$game->date]['legs'] += count($match_details);
    	}

    	foreach($stats as $date => $stat)
    	{
    		$stats[$date]['three_dart_avg'] = self::calculateThreeDartAverage($stat['legs'], $stat['points_left'], $stat['darts_thrown']);
    	}

    	$_stats = array();
    	$legs = 0;
    	$match_points = 0;
    	$points_left = 0;
    	foreach($stats as $stat)
    	{
    		$_stats['quality_points'] += $stat['quality_points'];
    		$_stats['ton_eighties'] += $stat['ton_eighties'];
    	}

    	return $_stats;
    }
}
