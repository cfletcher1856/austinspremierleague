<?php

/**
 * This is the model class for table "schedule".
 *
 * The followings are the available columns in table 'schedule':
 * @property integer $id
 * @property integer $season_id
 * @property integer $week
 * @property string $date
 * @property integer $home_player
 * @property integer $away_player
 * @property integer $chalker
 * @property integer $board
 * @property integer $match
 * @property integer $bar_id
 */
class Schedule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Schedule the static model class
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
		return 'schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('season_id, week, date, home_player, away_player, board, match, bar_id', 'required'),
			array('season_id, week, home_player, away_player, chalker, board, match, bar_id', 'numerical', 'integerOnly'=>true),
			array('home_player', 'compare', 'operator' => '!=', 'compareAttribute' => 'away_player', 'message' => 'Home Player must not be the same as the Away Player'),
			array('chalker', 'compare', 'operator' => '!=', 'compareAttribute' => 'away_player', 'message' => 'Chalker must not be the same as the Away Player'),
			array('chalker', 'compare', 'operator' => '!=', 'compareAttribute' => 'home_player', 'message' => 'Chalker must not be the same as the Home Player'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, season_id, week, date, home_player, away_player, chalker, board, match, bar_id', 'safe', 'on'=>'search'),
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
			'h_player' => array(self::BELONGS_TO, 'Player', 'home_player'),
			'a_player' => array(self::BELONGS_TO, 'Player', 'away_player'),
			'season' => array(self::BELONGS_TO, 'Season', 'season_id'),
			'matches' => array(self::HAS_MANY, 'Match', 'schedule_id'),
			'the_chalker' => array(self::BELONGS_TO, 'Player', 'chalker'),
			'bar' => array(self::BELONGS_TO, 'Bar', 'bar_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'season_id' => 'Season',
			'week' => 'Week',
			'date' => 'Date',
			'home_player' => 'Home Player',
			'away_player' => 'Away Player',
			'chalker' => 'Chalker',
			'board' => 'Board',
			'match' => 'Match',
			'bar_id' => 'Bar',
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
		$criteria->compare('season_id',$this->season_id);
		$criteria->compare('week',$this->week);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('home_player',$this->home_player);
		$criteria->compare('away_player',$this->away_player);
		$criteria->compare('chalker',$this->chalker);
		$criteria->compare('board',$this->board);
		$criteria->compare('match',$this->match);
		$criteria->compare('bar_id',$this->bar_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMatchup()
	{
		return $this->h_player->getFullName() . ' vs ' . $this->a_player->getFullName();
	}

	public function getMatchDate()
	{
		$date = new DateTime($this->date);

		return $date->format('m/d/Y');
	}

	public function getHomeMatch()
	{
		return Match::model()->findByAttributes(array(
			'schedule_id' => $this->id,
			'player_id' => $this->home_player
		));
	}

	public function getAwayMatch()
	{
		return Match::model()->findByAttributes(array(
			'schedule_id' => $this->id,
			'player_id' => $this->away_player
		));
	}

	public function getChalker()
	{
		if($this->the_chalker){
			return $this->the_chalker->getFullName();
		}

		return "No Chalker Assigned";
	}

	public function getBars()
	{
		$bars = Bar::model()->findAllByAttributes(array(
			'active' => 1
		));
		$_bars = array();
		foreach($bars as $bar){
			$_bars[$bar->id] = $bar->name;
		}

		return $_bars;
	}

	public function getBar()
	{
		return $this->bar->name;
	}
}
