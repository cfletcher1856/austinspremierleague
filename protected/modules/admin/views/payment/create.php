<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Payments'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Payment', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = 'Create Payment';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
