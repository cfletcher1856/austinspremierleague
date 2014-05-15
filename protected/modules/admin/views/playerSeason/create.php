<?php
$this->breadcrumbs=array(
	'Player Seasons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PlayerSeason','url'=>array('index')),
	array('label'=>'Manage PlayerSeason','url'=>array('admin')),
);
?>

<h1>Create PlayerSeason</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>