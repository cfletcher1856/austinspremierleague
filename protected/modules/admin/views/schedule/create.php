<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Schedules'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Schedule', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = 'Create Schedule';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
