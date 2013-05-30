<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Seasons'=>array('index'),
		$model->name,
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Seasons', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Season', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Season', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = 'View Season';
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'name',
		array(
			'type' => 'raw',
			'name' => 'start_date',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->start_date)),
		),
		array(
			'type' => 'raw',
			'name' => 'end_date',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->end_date)),
		),
		array(
			'type' => 'raw',
			'name' => 'dues',
			'value' => Payment::displayMoney($model->dues),
		),
		array(
			'type' => 'raw',
			'name' => 'bar_donation',
			'value' => Payment::displayMoney($model->bar_donation),
		),
	),
)); ?>
