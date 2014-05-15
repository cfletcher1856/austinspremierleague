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
    $dates = $season->getSeasonDatesAsArray();
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    $tabs = array();
    $set_active = false;
    $week = 1;

    foreach($dates as $date){
        $tab = array();
        $week_schedule = 'week'.$week.'Schedule';
        if($week != 1){
            $switch_date = new DateTime($date);
            $switch_date->modify('+4 days');
        }

        if($today <= $switch_date && !$set_active){
            $tab['active'] = true;
            $set_active = true;
        }

        $_date = new DateTime($date);
        $tab['label'] = $date." ($week)";
        $tab['content'] = $this->renderPartial('_matches', array('model'=>$$week_schedule), true);
        $tabs[] = $tab;
        $week++;
    }

    $this->widget('bootstrap.widgets.TbTabs', array(
        'tabs' => $tabs
)); ?>
