<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Bars',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Bar','icon' => 'plus','url'=>array('create')),
    );
    $this->page_header = 'Bars';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'address', 'header'=>'Address'),
        array('name'=>'phone', 'header'=>'Phone'),
        array(
            'name'=>'active',
            'header'=>'Active',
            'value' => '$data->activeChar()'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update}',
        ),
    ),
)); ?>
