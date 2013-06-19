<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Players',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Player','icon' => 'plus', 'url'=>array('create')),
    );
    $this->page_header = 'Players';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'f_name', 'header'=>'First name'),
        array('name'=>'l_name', 'header'=>'Last name'),
        array('name'=>'email', 'header'=>'Email'),
        array('name'=>'phone', 'header'=>'Phone'),
        array(
                    'name'=>'active',
                    'header'=>'Active',
                    'value' => '$data->activeChar()'
                ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update} {profile}',
            'buttons'=>array(
                'profile' => array(
                    'icon' => 'user',
                    'url'=>'Yii::app()->createUrl("//admin/profile/view", array("id"=>$data->profile->id))',
                    'options' => array(
                        'title' => 'Profile',
                    )
                ),
            ),
        ),
    ),
)); ?>
