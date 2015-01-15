<?php

/**
 * This is the model class for table "upcoming_season".
 *
 * The followings are the available columns in table 'upcoming_season':
 * @property integer $id
 * @property string $season
 * @property string $created
 * @property string $name
 * @property integer $qualifier
 * @property string $email
 * @property string $body
 */
class UpcomingSeason extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UpcomingSeason the static model class
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
		return 'upcoming_season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('season, created, name, email, body', 'required'),
			array('qualifier', 'numerical', 'integerOnly'=>true),
			array('season, name, email', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, season, created, name, email, body, qualifier', 'safe', 'on'=>'search'),
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
			'season' => 'Season',
			'created' => 'Created',
			'name' => 'Name',
			'email' => 'Email',
			'body' => 'Body',
			'qualifier' => 'Qualifier',
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
		$criteria->compare('season',$this->season,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('qualifier',$this->qualifier);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function qualifierChar(){
        return ($this->qualifier) ? 'Y' : 'N';
    }
}
