<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Seasons',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Season','icon' => 'plus','url'=>array('create')),
    );
    $this->page_header = 'Seasons';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'start_date', 'header'=>'Start Date', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->start_date))'),
        array('name'=>'end_date', 'header'=>'End Date', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->end_date))'),
        array('name'=>'dues', 'header'=>'Dues', 'value' => 'Payment::displayMoney($data->dues)'),
        array('name'=>'bar_donation', 'header'=>'Bar Donation', 'value' => 'Payment::displayMoney($data->bar_donation)'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'buttons' => array(
                'players' => array(
                    'label' => 'Players',
                    'icon' => 'user',
                    'url' => 'Yii::app()->createUrl("//admin/playerSeason/update", array("id" => $data->id))',
                ),
            ),
            'template' => '{view} {update} {players}',
        ),
    ),
)); ?>
