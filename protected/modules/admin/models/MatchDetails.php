<?php

/**
 * This is the model class for table "match_details".
 *
 * The followings are the available columns in table 'match_details':
 * @property integer $id
 * @property integer $match_id
 * @property integer $match_num
 * @property integer $player_id
 * @property integer $schedule_id
 * @property integer $darts_thrown
 * @property integer $out
 * @property integer $points_left
 */
class MatchDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MatchDetails the static model class
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
		return 'match_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('match_num, player_id, schedule_id', 'required'),
			array('match_num, player_id, schedule_id, darts_thrown, out, points_left', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, match_num, player_id, schedule_id, darts_thrown, out, points_left', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'match_id' => 'Match',
			'match_num' => 'Match Num',
			'player_id' => 'Player',
			'schedule_id' => 'Schedule',
			'darts_thrown' => 'Darts Thrown',
			'out' => 'Out',
			'points_left' => 'Points Left',
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
		$criteria->compare('match_id',$this->match_id);
		$criteria->compare('match_num',$this->match_num);
		$criteria->compare('player_id',$this->player_id);
		$criteria->compare('schedule_id',$this->schedule_id);
		$criteria->compare('darts_thrown',$this->darts_thrown);
		$criteria->compare('out',$this->out);
		$criteria->compare('points_left',$this->points_left);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
