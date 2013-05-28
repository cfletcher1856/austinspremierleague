<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Payments',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    	array('label'=>'Create Payment','icon' => 'plus','url'=>array('create')),
    );
    $this->page_header = 'Payments';
?>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'f_name', 'header'=>'Player', 'value' => '$data->player->getFullName()'),
        array('name'=>'date', 'header'=>'Date', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->date))'),
        array('name'=>'amount', 'header'=>'Amount', 'value' => 'Payment::displayMoney($data->amount)'),
        array('name'=>'txn_type', 'header'=>'Transaction Type', 'value' => 'ucfirst($data->txn_type)'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update}',
        ),
    ),
)); ?>
