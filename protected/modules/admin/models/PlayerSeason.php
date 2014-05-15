<?php

/**
 * This is the model class for table "player_season".
 *
 * The followings are the available columns in table 'player_season':
 * @property integer $id
 * @property integer $season_id
 * @property integer $division_id
 * @property integer $player_id
 */
class PlayerSeason extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PlayerSeason the static model class
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
		return 'player_season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('season_id, division_id, player_id', 'required'),
			array('season_id, division_id, player_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, season_id, division_id, player_id', 'safe', 'on'=>'search'),
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
			'player' => array(self::BELONGS_TO, 'Player', 'player_id'),
			'division' => array(self::BELONGS_TO, 'Division', 'division_id'),
			'season' => array(self::BELONGS_TO, 'Season', 'season_id'),
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
			'division_id' => 'Division',
			'player_id' => 'Player',
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
		$criteria->compare('division_id',$this->division_id);
		$criteria->compare('player_id',$this->player_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
