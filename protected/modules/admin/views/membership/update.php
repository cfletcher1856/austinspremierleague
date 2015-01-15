<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Memberships'=>array('index'),
        $model->getFullName()=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Memberships', 'icon' => 'list','url'=>array('index')),
        array('label'=>'Create Membership', 'icon' => 'plus','url'=>array('create')),
        array('label'=>'View Membership', 'icon' => 'search', 'url'=>array('view','id'=>$model->id)),
    );
    $this->page_header = 'Update Membership';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
