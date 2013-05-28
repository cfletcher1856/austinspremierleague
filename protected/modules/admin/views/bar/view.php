<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Bars'=>array('index'),
		$model->name,
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Bar', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Bar', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Bar', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = "View Bar";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'name',
		'address',
		'phone',
		array(
            'name'=>'active',
            'header'=>'Active',
            'value' => $model->activeChar()
        ),
),
)); ?>
