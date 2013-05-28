<?php
	$this->breadcrumbs=array(
		'Admin' => array('//admin'),
		'Profiles'=>array('index'),
		$model->player->getFullName(),
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'Update Profile','icon' => 'pencil', 'url'=>array('update','id'=>$model->id)),
	);
?>

<h1><?php echo $model->player->getFullName(); ?></h1>

<?php
	if($model->image){
		$image = Yii::app()->thumb->render(Yii::app()->basePath.'/../profiles/'.$model->image, array(
			'width' => '250',
			'height' => '250',
			'link' => 'true',
			'hint' => 'false',
			//'crop' => 'false',
			'sharpen' => 'true',
			'longside' => '255',
			'imgOptions' => array(),
			'imgAlt' => $model->player->f_name . " " . $model->player->l_name,
		));
	}

	$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			'age',
			'how_long',
			'type_dart',
			'handed',
			'fav_player',
			'best_memory',
			'fav_activity',
			'theme_song',
			'weirdness',
			'fav_movie',
			'invisible',
			'great_less',
			array(
				'name' => 'image',
				'type' => 'html',
				'value' => $image
			),
		),
	));
?>
