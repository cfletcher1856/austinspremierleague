<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Blind Draws'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Blind Draws', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Blind Draw";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
