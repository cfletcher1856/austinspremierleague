<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property integer $id
 * @property integer $player_id
 * @property integer $player_season_id
 * @property string $date
 * @property string $amount
 * @property string $txn_type
 * @property integer $collected_by
 */
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_id, amount, txn_type, collected_by', 'required'),
			array('player_id, collected_by', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
			array('amount', 'type', 'type' => 'float'),
			array('txn_type', 'length', 'max'=>15),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('player_id, date, amount, collected_by', 'safe', 'on'=>'search'),
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
			'collector' => array(self::BELONGS_TO, 'Player', 'collected_by')
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
			'date' => 'Date',
			'amount' => 'Amount',
			'txn_type' => 'Transaction Type',
			'collected_by' => 'Collected By',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('collected_by',$this->collected_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function displayMoney($amount)
	{
		setlocale(LC_MONETARY, 'en_US');
		return money_format('%(#10n', $amount);
	}

	public function getTransactionDropDown()
	{
		return array('payment' => "Payment", 'fee' => 'Fee');
	}

	public function getCollectedByName()
	{
		if($this->collector){
			return $this->collector->getFullName();
		}
	}
}
