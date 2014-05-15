<?php
$this->breadcrumbs=array(
	'Player Seasons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PlayerSeason','url'=>array('index')),
	array('label'=>'Create PlayerSeason','url'=>array('create')),
	array('label'=>'Update PlayerSeason','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PlayerSeason','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PlayerSeason','url'=>array('admin')),
);
?>

<h1>View PlayerSeason #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'season_id',
		'division_id',
		'player_id',
	),
)); ?>
