<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Payments'=>array('index'),
    	$model->player->getFullName()=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Payments', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Payment', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Payment', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = "Update Payment";
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
