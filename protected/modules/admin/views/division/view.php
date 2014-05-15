<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Divisions'=>array('index'),
		$model->id,
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Division', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Division', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Division', 'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
	);
	$this->page_header = "View Division";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'division',
		array(
            'name'=>'active',
            'header'=>'Active',
            'value' => $model->activeChar()
        ),
),
)); ?>
