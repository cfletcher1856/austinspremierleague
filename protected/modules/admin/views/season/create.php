<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Seasons'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Seasons', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = 'Create Season';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
