<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Bars'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Bars', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Bar";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
