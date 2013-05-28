<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Match'=>array('index'),
    	'Create',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Matchs', 'icon' => 'list','url'=>array('index')),
    );
    $this->page_header = "Create Match";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
