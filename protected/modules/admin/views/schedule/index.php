<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Schedules',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Schedule','icon' => 'plus','url'=>array('create')),
        //array('label'=>'Generate Schedule','icon' => 'plus','url'=>array('generate')),
    );
    $this->page_header = 'Schedules';
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
        $provider = 'week'.$week.'DataProvider';
        if($week != 1){
            $switch_date = new DateTime($date);
            $switch_date->modify('+4 days');
        } else {
            $tab['active'] = true;
            $set_active = true;
        }

        if($today <= $switch_date && !$set_active){
            $tab['active'] = true;
            $set_active = true;
        }

        $_date = new DateTime($date);
        $tab['label'] = $_date->format('m/d/Y')." ($week)";
        $tab['content'] = $this->renderPartial('_schedule', array('dataProvider'=>$$provider), true);
        $tabs[] = $tab;
        $week++;
    }

    $this->widget('bootstrap.widgets.TbTabs', array(
        'tabs' => $tabs
)); ?>
