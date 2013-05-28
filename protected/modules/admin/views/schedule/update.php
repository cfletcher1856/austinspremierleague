<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Schedules'=>array('index'),
    	$model->getMatchup()=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Schedule', 'icon' => 'list','url'=>array('index')),
    	array('label'=>'Create Schedule', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Schedule', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Schedule';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
