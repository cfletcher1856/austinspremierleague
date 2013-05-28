<h4>Outstanding Balance - <?php echo Payment::displayMoney($balance); ?></h4>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'date', 'header'=>'Date', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->date))'),
        array('name'=>'amount', 'header'=>'Amount', 'value' => 'Payment::displayMoney($data->amount)'),
        array('name' => 'txn_type', 'header' => 'Transaction Type', 'value' => 'ucfirst($data->txn_type)'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update}',
        ),
    ),
)); ?>
