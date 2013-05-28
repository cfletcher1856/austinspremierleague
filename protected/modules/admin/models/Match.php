<?php

/**
 * This is the model class for table "match".
 *
 * The followings are the available columns in table 'match':
 * @property integer $id
 * @property integer $player_id
 * @property integer $schedule_id
 * @property integer $legs_won
 * @property integer $legs_lost
 * @property integer $leg_differential
 * @property integer $ton_eighties
 * @property integer $quality_points
 * @property integer $darts_thrown
 * @property integer $points
 */
class Match extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Match the static model class
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
		return 'match';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_id, schedule_id, legs_won, legs_lost, leg_differential', 'required'),
			array('player_id, schedule_id, legs_won, legs_lost, leg_differential, ton_eighties, quality_points, darts_thrown, points', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, player_id, schedule_id, legs_won, legs_lost, leg_differential, ton_eighties, quality_points, darts_thrown, points', 'safe', 'on'=>'search'),
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
			'schedule' => array(self::BELONGS_TO, 'Schedule', 'schedule_id'),
			'player' => array(self::BELONGS_TO, 'Player', 'player_id,'),
			'details' => array(self::HAS_MANY, 'MatchDetails', 'match_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'player_id' => 'Player',
			'schedule_id' => 'Schedule',
			'legs_won' => 'Legs Won',
			'legs_lost' => 'Legs Lost',
			'leg_differential' => 'Leg Differential',
			'ton_eighties' => 'Ton Eighties',
			'quality_points' => 'Quality Points',
			'darts_thrown' => 'Darts Thrown',
			'points' => 'Points',
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
		$criteria->compare('player_id',$this->player_id);
		$criteria->compare('schedule_id',$this->schedule_id);
		$criteria->compare('legs_won',$this->legs_won);
		$criteria->compare('legs_lost',$this->legs_lost);
		$criteria->compare('leg_differential',$this->leg_differential);
		$criteria->compare('ton_eighties',$this->ton_eighties);
		$criteria->compare('quality_points',$this->quality_points);
		$criteria->compare('darts_thrown',$this->darts_thrown);
		$criteria->compare('points',$this->points);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getDartAverage($player_id)
	{
		// echo "Player ID: $player_id<br />";
		// echo "Match ID: $this->id<br />";
		$legs = (int)$this->legs_won + (int)$this->legs_lost;

		$match_details = MatchDetails::model()->findAllByAttributes(array(
			'match_id' => $this->id,
			'player_id' => $player_id
		));

		$darts_thrown = 0;
		$points_left = 0;
		foreach($match_details as $detail)
		{
			$darts_thrown += $detail['darts_thrown'];
			$points_left += $detail['points_left'];
		}

		return Player::calculateThreeDartAverage($legs, $points_left, $darts_thrown);
	}
}
