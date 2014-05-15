<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Divisions'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Division','icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Division";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
