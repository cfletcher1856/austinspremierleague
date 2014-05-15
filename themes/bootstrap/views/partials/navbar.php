<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'About', 'url'=>array('/site/about')),
                array('label'=>'Rules', 'url'=>array('/site/rules')),
                array('label'=>'Standings', 'url'=>array('/site/standings')),
                array('label'=>'Schedule', 'url'=>'#', 'items' => array(
                    array('label' => 'Division 1', 'url' => array('/schedule/Spring+2014/Division+1/')),
                    array('label' => 'Division 2', 'url' => array('/schedule/Spring+2014/Division+2/')),
                    array('label' => 'Division 3', 'url' => array('/schedule/Spring+2014/Division+3/')),
                    array('label' => 'Make Up Games', 'url' => array('/site/makeups')),
                    // array('label' => 'Previous Seasons', 'url' => '#', 'items' => array(
                    //     array('label' => 'Spring 2013', 'url' => array('/schedule/Spring+2013/Division+1/')),
                    //     array('label' => 'Fall 2013', 'url' => '#', 'items' => array(
                    //         array('label' => 'Division 1', 'url' => array('/schedule/Fall+2013/Division+1/')),
                    //         array('label' => 'Division 2', 'url' => array('/schedule/Fall+2013/Division+2/')),
                    //     )),
                    // )),
                )),
                array('label'=>'Players', 'url'=>array('/site/players')),
                // array('label'=>'Doubles', 'url'=> array('/site/doubles'), 'visible'=>!Yii::app()->user->isGuest),
                // array('label'=>'Upcoming Season', 'url'=>array('/site/upcomingseason'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Blind Draw', 'url'=>array('/site/blinddraw')),
                // array('label'=>'Womens League', 'url' => 'http://women.austinspremierleague.com/', 'linkOptions' => array('target' => '_blank')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Hello ('.Yii::app()->user->name.')', 'url'=> '#', 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                    array('label' => 'Admin', 'url' => array('//admin')),
                    array('label' => 'Logout', 'url' => array('/site/logout')),
                )),
            ),
        ),
    ),
    'collapse' => true,
)); ?>

