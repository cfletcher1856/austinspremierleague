<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Divisions'=>array('index'),
    	$model->division=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Division', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Division', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Division', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = "Update Division";
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
