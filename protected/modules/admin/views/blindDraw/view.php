<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Blind Draws'=>array('index'),
		$model->id,
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List BlindDraw', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create BlindDraw', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update BlindDraw', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = "View Blind Draw";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		array(
			'type' => 'raw',
			'name' => 'date',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy", strtotime($model->date)),
		),
		'participants',
		'winner',
		'double_shot_winner',
		'double_shot_payout',
	),
)); ?>
