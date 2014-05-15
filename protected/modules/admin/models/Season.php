<?php
Yii::import('application.models.Standings');
/**
 * This is the model class for table "season".
 *
 * The followings are the available columns in table 'season':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $dues
 * @property string $bar_donation
 */
class Season extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Season the static model class
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
		return 'season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date, end_date, dues, bar_donation', 'required'),
			array('name', 'length', 'max'=>120),
			array('dues, bar_donation', 'length', 'max'=>10),
			array('dues, bar_donation', 'type', 'type' => 'float'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start_date, end_date, dues, bar_donation', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'dues' => 'Dues',
			'bar_donation' => 'Bar Donation',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('dues',$this->dues,true);
		$criteria->compare('bar_donation',$this->bar_donation,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSeasonsDropDown()
	{
		$seasons = Standings::getCurrentSeason();

		return array($seasons->id => $seasons->name);
	}

	public function getSeasonWeeks()
	{
		$start = new DateTime($this->start_date);
		$end = new DateTime($this->end_date);

		$days = round(($end->format('U') - $start->format('U')) / (60*60*24));

		return $days / 7;
	}

	public function getSeasonDatesAsArray($add_quotes=False)
	{
		$current_season = Standings::getCurrentSeason();

		$sql = "
			SELECT
				DISTINCT date
			FROM `schedule`
			WHERE season_id = $current_season->id
			ORDER BY date
		";

		$dates = Yii::app()->db->createCommand($sql)->queryAll();

		$start_date = new DateTime($this->start_date);
	    $weeks = $this->getSeasonWeeks();
	    $_dates = array();
	    foreach($dates as $blah => $date)
	    {
	        $_date = new DateTime($date['date']);
	        $_date = $_date->format('m/d/Y');

	        if($add_quotes)
	    	{
	        	$_date = "'" . $_date . "'";
	        }

	        $_dates[] = $_date;
	    }

	    return $_dates;
	}
}
