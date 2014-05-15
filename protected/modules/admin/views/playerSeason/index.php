<?php
$this->breadcrumbs=array(
    'Admin' => array("//admin"),
	'Player Seasons',
);

$this->menu=array(
    array('label' => 'Actions'),
	array('label'=>'Create PlayerSeason', 'icon' => 'plus', 'url'=>array('create'))
);
?>

<h1>Player Seasons</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
