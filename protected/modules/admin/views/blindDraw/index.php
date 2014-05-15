<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Blind Draws',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Blind Draw','icon' => 'plus','url'=>array('create')),
    );
    $this->page_header = 'Bars';
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array(
            'name'=>'date',
            'header'=>'Date',
            'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->date))'
        ),
        'participants',
        'winner',
        'double_shot_winner',
        array(
            'name'=>'double_shot_payout',
            'header'=>'Double Shot Payout',
            'value' => 'Yii::app()->numberFormatter->formatCurrency($data->double_shot_payout, "USD")'
        ),
        'number_pulled',
        array(
            'name'=>'pot_adjustment',
            'header'=>'Pot Adjustment',
            'value' => 'Yii::app()->numberFormatter->formatCurrency($data->pot_adjustment, "USD")'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update}',
        ),
    ),
)); ?>
