<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Blind Draws'=>array('index'),
    	$model->id=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List BlindDraw','url'=>array('index')),
    	array('label'=>'Create BlindDraw','url'=>array('create')),
    	array('label'=>'View BlindDraw','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Blind Draw';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
