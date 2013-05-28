<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Matches',
    );

    $this->menu=array(
        array('label' => 'Actions'),
        array('label'=>'Email Players Stats','icon' => 'envelope','url'=>array('email')),
    );
    $this->page_header = 'Matches';
?>

<?php
    $season = Standings::getCurrentSeason();
    $start_date = new DateTime($season->start_date);
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    $tabs = array();
    $set_active = false;
    foreach(range(1, 11) as $week){
        $tab = array();
        $week_schedule = 'week'.$week.'Schedule';
        if($week != 1){
            $start_date->modify('+7 days');
            $switch_date = new DateTime($start_date->format("Y-m-d"));
            $switch_date->modify('+4days');
        }

        if($today < $switch_date && !$set_active){
            $tab['active'] = true;
            $set_active = true;
        }
        $tab['label'] = $start_date->format('m/d/Y')." ($week)";
        $tab['content'] = $this->renderPartial('_matches', array('model'=>$$week_schedule), true);
        $tabs[] = $tab;
    }
    $this->widget('bootstrap.widgets.TbTabs', array(
        'tabs' => $tabs
)); ?>
