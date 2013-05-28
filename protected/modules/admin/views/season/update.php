<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Seasons'=>array('index'),
    	$model->name=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Seasons', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Season', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Season', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Season';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
