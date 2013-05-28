<?php
	$this->breadcrumbs=array(
		'Admin' => array('//admin'),
		'Payments'=>array('index'),
		$model->player->getFullName(),
	);

	$this->menu=array(
		array('label'=>'List Payments', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Payment', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Payment', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = "View Payment";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		array(
			'label' => 'Date',
			'type' => 'raw',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->date)),
		),
		array(
			'label' => 'Amount',
			'type' => 'raw',
			'value' => Payment::displayMoney($model->amount),
		),
		array(
			'label' => 'Transaction Type',
			'type' => 'raw',
			'value' => ucfirst($model->txn_type),
		),
	),
)); ?>
