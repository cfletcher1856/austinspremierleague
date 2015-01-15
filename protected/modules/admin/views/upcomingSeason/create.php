<?php
$this->breadcrumbs=array(
	'Upcoming Seasons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UpcomingSeason','url'=>array('index')),
	array('label'=>'Manage UpcomingSeason','url'=>array('admin')),
);
?>

<h1>Create UpcomingSeason</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>