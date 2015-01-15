<?php
$this->breadcrumbs=array(
	'Upcoming Seasons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UpcomingSeason','url'=>array('index')),
	array('label'=>'Create UpcomingSeason','url'=>array('create')),
	array('label'=>'View UpcomingSeason','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UpcomingSeason','url'=>array('admin')),
);
?>

<h1>Update UpcomingSeason <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>