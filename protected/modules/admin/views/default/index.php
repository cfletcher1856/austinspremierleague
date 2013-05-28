<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        'Admin'
    );
    $this->menu=array(
        array('label' => 'Actions'),
        array('label'=>'Players', 'icon' => 'user', 'url'=>array('//admin/player/index')),
        array('label'=>'Payments', 'icon' => 'money','url'=>array('//admin/payment/index')),
        array('label'=>'Matches', 'icon' => 'bar-chart','url'=>array('//admin/match/index')),
        array('label'=>'Schedule', 'icon' => 'calendar','url'=>array('//admin/schedule/index')),
        array('label'=>'Seasons', 'icon' => 'star','url'=>array('//admin/season/index')),
        array('label'=>'Bars', 'icon' => 'beer','url'=>array('//admin/bar/index')),
        array('label'=>'Reports', 'icon' => 'file-alt','url'=>array('//admin/reports/index')),
    );
    $this->page_header = 'Admin';
?>


<p>
    Manage the leage with the links to the left
</p>
