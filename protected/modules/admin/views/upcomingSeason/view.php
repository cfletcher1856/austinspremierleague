<?php
$this->breadcrumbs=array(
	'Upcoming Seasons'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UpcomingSeason','url'=>array('index')),
	array('label'=>'Create UpcomingSeason','url'=>array('create')),
	array('label'=>'Update UpcomingSeason','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete UpcomingSeason','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UpcomingSeason','url'=>array('admin')),
);
?>

<h1>View UpcomingSeason #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'season',
		'created',
		'name',
		'qualifier',
	),
)); ?>
