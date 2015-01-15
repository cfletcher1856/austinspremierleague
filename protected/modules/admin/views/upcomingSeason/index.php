<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Upcoming Season',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    );
    $this->page_header = 'Upcoming Season';
?>

<?php
    echo $dataProvider->getTotalItemCount();
    echo " people have signed up<br /><br />";
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'season', 'header'=>'Season'),
        array('name'=>'name', 'header'=>'Name'),
        array(
            'name'=>'qualifier',
            'header'=>'Qualifier',
            'value' => '$data->qualifierChar()'
        ),
        array('name'=>'created', 'header'=>'Date Submitted'),

        // array(
        //     'class'=>'bootstrap.widgets.TbButtonColumn',
        //     'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
        //     'template' => '{view} {update}',
        // ),
    ),
)); ?>
