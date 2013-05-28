<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Bars'=>array('index'),
    	$model->name=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Bars', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Bar', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Bar', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Bar';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
