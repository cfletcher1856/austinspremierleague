<?php
	$this->breadcrumbs=array(
		'Admin' => array('//admin'),
		'Matches'=>array('index'),
		$model->id,
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Matches', 'icon' => 'list','url'=>array('index')),
		//array('label'=>'Create Match', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Match', 'icon' => 'pencil','url'=>array('update','id'=>$schedule->id)),
	);
	$this->page_header = "View Match";
?>

<h3><?php echo Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($schedule->date)); ?> - Board <?php echo $schedule->board; ?></h3>

<h4><?php echo $schedule->h_player->getFullName(); ?></h4>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$matches[0],
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'legs_won',
		'legs_lost',
		'leg_differential',
		'ton_eighties',
		'quality_points',
		'darts_thrown',
	),
)); ?>

<h4><?php echo $schedule->a_player->getFullName(); ?></h4>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$matches[1],
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'legs_won',
		'legs_lost',
		'leg_differential',
		'ton_eighties',
		'quality_points',
		'darts_thrown',
	),
)); ?>
