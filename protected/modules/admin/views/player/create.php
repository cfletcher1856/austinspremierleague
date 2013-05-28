<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Players'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Players', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Player";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
