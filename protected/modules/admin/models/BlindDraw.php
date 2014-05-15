<?php

/**
 * This is the model class for table "blind_draw".
 *
 * The followings are the available columns in table 'blind_draw':
 * @property integer $id
 * @property string $date
 * @property integer $participants
 * @property string $winner
 * @property string $double_shot_winner
 * @property integer $number_pulled
 * @property integer $double_shot_payout
 * @property integer $pot_adjustment
 */
class BlindDraw extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BlindDraw the static model class
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
		return 'blind_draw';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, participants', 'required'),
			array('participants, number_pulled, double_shot_payout, pot_adjustment', 'numerical', 'integerOnly'=>true),
			array('winner, double_shot_winner', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, participants, winner, double_shot_winner, number_pulled, double_shot_payout, pot_adjustment', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'participants' => 'Participants',
			'winner' => 'Winner',
			'double_shot_winner' => 'Double Shot Winner',
			'number_pulled' => 'Number Pulled',
			'double_shot_payout' => 'Double Shot Payout',
			'pot_adjustment' => 'Pot Adjustment',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('participants',$this->participants);
		$criteria->compare('winner',$this->winner,true);
		$criteria->compare('double_shot_winner',$this->double_shot_winner,true);
		$criteria->compare('number_pulled',$this->number_pulled);
		$criteria->compare('double_shot_payout',$this->double_shot_payout);
		$criteria->compare('pot_adjustment',$this->pot_adjustment);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getDoubleShotPot()
	{
		$sql = "
            SELECT
                sum(participants) as participants,
                sum(double_shot_payout) as double_shot_payout,
                sum(pot_adjustment) as pot_adjustment
            FROM  `blind_draw`
        ";

        $counts = Yii::app()->db->createCommand($sql)->queryRow();

        $total_pot = ($counts['participants'] * 2) + (int)$counts['pot_adjustment'];
        $total_payouts = $counts['double_shot_payout'];

        return (int)$total_pot - (int)$total_payouts;
	}
}
