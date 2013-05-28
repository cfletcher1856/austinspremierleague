<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Matches'=>array('index'),
    	$schedule->getMatchup()=>array('view','id'=>$schedule->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'List Matches', 'icon' => 'list','url'=>array('index')),
    	//array('label'=>'Create Match', 'icon' => 'plus','url'=>array('create')),
    	array('label'=>'View Match', 'icon' => 'search','url'=>array('view','id'=>$schedule->id)),
    );
    $this->page_header = 'Update Match';
?>

<?php echo $this->renderPartial('_form',array('matches'=>$matches, 'schedule' => $schedule)); ?>
