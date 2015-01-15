<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Memberships'=>array('index'),
		$model->getFullName(),
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Memberships', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Membership', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Membership', 'icon' => 'pencil', 'url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = "View Membership";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		array(
			'label' => 'Amount',
			'type' => 'raw',
			'value' => Payment::displayMoney($model->amount),
		),
		array(
			'label' => 'Paid On',
			'type' => 'raw',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->date_paid)),
		),
		array(
			'label' => 'Expires On',
			'type' => 'raw',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->expires_on)),
		),
	),
)); ?>
