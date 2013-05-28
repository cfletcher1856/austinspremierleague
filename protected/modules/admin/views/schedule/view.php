<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Schedules'=>array('index'),
		$model->getMatchup(),
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Schedule', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Schedule', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Schedule', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = 'View Schedule';
?>

<?php
	$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		array(
			'label' => 'Season',
			'type' => 'raw',
			'value' => $model->season->name
		),
		'week',
		array(
			'label' => 'Date',
			'type' => 'raw',
			'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($model->date)),
		),
		'match',
		'board',
		array(
			'label' => 'Matchup',
			'type' => 'raw',
			'value' => $model->getMatchup()
		),
		array(
			'label' => 'Chalker',
			'type' => 'raw',
			'value' => $model->getChalker()
		)
	),
)); ?>
