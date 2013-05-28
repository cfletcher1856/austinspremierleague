<?php
	$this->breadcrumbs=array(
		'Admin' => array("//admin"),
		'Players'=>array('index'),
		$model->getFullName(),
	);

	$this->menu=array(
		array('label' => 'Actions'),
		array('label'=>'List Players', 'icon' => 'list','url'=>array('index')),
		array('label'=>'Create Player', 'icon' => 'plus','url'=>array('create')),
		array('label'=>'Update Player', 'icon' => 'pencil', 'url'=>array('update','id'=>$model->id)),
        array('label'=>'Update Profile', 'icon' => 'user', 'url'=>array('//admin/profile/view','id'=>$model->profile->id)),
	);
	$this->page_header = "View Player";
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => array('striped', 'bordered', 'condensed'),
	'attributes'=>array(
		'f_name',
		'l_name',
		'email',
		'phone',
	),
)); ?>


<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs'=> array(
    	array(
    		'active' => true,
    		'label' => 'Stats',
    		'content' => $this->renderPartial('_stats', array(
                'dataProvider'=>$matchDataProvider,
                'schedule' => $schedule
            ), true),
    	),
    	array(
    		'label' => 'Payments',
    		'content' => $this->renderPartial('_payments', array(
                'dataProvider'=>$paymentsDataProvider,
                'model' => $model,
                'balance' => $balance,
            ), true),
    	)
    )
)); ?>
