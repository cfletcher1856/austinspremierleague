<?php
    $this->breadcrumbs=array(
        "Admin" => array("//admin"),
    	'Divisions'
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Division','icon' => 'plus','url'=>array('create'))
    );
    $this->page_header = 'Divisions';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'division', 'header'=>'Name'),
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
