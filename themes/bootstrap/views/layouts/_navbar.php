<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'About', 'url'=>array('/site/about')),
                array('label'=>'Standings', 'url'=>array('/site/standings')),
                array('label'=>'Schedule', 'url'=>array('/site/schedule')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Hello ('.Yii::app()->user->name.')', 'url'=> '#', 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                    array('label' => 'Admin', 'url' => array('//admin')),
                    array('label' => 'Logout', 'url' => array('/site/logout')),
                )),
            ),
        ),
    ),
)); ?>
