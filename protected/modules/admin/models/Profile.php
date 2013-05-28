<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property integer $id
 * @property integer $player_id
 * @property string $age
 * @property string $how_long
 * @property string $type_dart
 * @property string $handed
 * @property string $fav_player
 * @property string $best_memory
 * @property string $fav_activity
 * @property string $theme_song
 * @property integer $weirdness
 * @property string $fav_movie
 * @property string $invisible
 * @property string $great_less
 * @property string $image
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_id, age, how_long, type_dart, handed, fav_player, best_memory, fav_activity, theme_song, weirdness, fav_movie, invisible, great_less', 'required'),
			array('player_id, weirdness', 'numerical', 'integerOnly'=>true),
			array('type_dart, handed, fav_player, great_less, best_memory, fav_activity, theme_song, fav_movie, invisible, image', 'length', 'max'=>255),
			array('age, how_long', 'length', 'max'=>120),
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, player_id, age, how_long, type_dart, handed, fav_player, best_memory, fav_activity, theme_song, weirdness, fav_movie, invisible, great_less, image', 'safe', 'on'=>'search'),
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
			'player' => array(
					self::BELONGS_TO, 'Player', 'player_id',
				)
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
			'age' => 'Age',
			'how_long' => 'How many years have you been playing darts?',
			'type_dart' => 'What type of dart do you use?',
			'handed' => 'Do you throw right or left handed?',
			'fav_player' => 'Who is your favorite dart player?',
			'best_memory' => 'What is your best darting memory?',
			'fav_activity' => 'What is your favorite activity outside of darts?',
			'theme_song' => 'If your life had a theme song, what would it be?',
			'weirdness' => 'On a scale of 1 (low) to 10 (high), rate yourself on how weird you are:',
			'fav_movie' => 'What is your favorite movie?',
			'invisible' => 'If you could be invisible, where would you go and what would you do?',
			'great_less' => '"Tastes Great" or "Less Filling"',
			'image' => 'Image',
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
		$criteria->compare('age',$this->age,true);
		$criteria->compare('how_long',$this->how_long,true);
		$criteria->compare('type_dart',$this->type_dart,true);
		$criteria->compare('handed',$this->handed,true);
		$criteria->compare('fav_player',$this->fav_player,true);
		$criteria->compare('best_memory',$this->best_memory,true);
		$criteria->compare('fav_activity',$this->fav_activity,true);
		$criteria->compare('theme_song',$this->theme_song,true);
		$criteria->compare('weirdness',$this->weirdness);
		$criteria->compare('fav_movie',$this->fav_movie,true);
		$criteria->compare('invisible',$this->invisible,true);
		$criteria->compare('great_less',$this->great_less,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
