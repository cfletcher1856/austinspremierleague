<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Memberships'=>array('index'),
    	'Create',
    );

    $this->menu=array(
    	array('label' => 'Actions'),
        array('label'=>'List Memberships', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Membership";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
