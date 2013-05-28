<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Profiles'=>array('index'),
    	$model->player->getFullName()=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label'=>'Actions'),
    	array('label'=>'List Players', 'icon' => 'list','url'=>array('//admin/players/index')),
    	array('label'=>'View Profile', 'icon' => 'search','url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Profile ' . $model->player->getFullName();
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
