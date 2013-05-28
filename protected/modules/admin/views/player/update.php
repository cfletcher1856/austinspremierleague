<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Players'=>array('index'),
    	$model->getFullName()=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Players', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Player', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Player', 'icon' => 'search', 'url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Player';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
