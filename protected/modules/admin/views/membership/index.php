<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
    	'Memberships',
    );

    $this->menu=array(
    	array('label' => 'Actions'),
        array('label'=>'Create Membership','icon' => 'plus', 'url'=>array('create')),
    );
    $this->page_header = 'Memberships';
?>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'f_name', 'header'=>'Player', 'value' => '$data->player->getFullName()'),
        array('name'=>'amount', 'header'=>'Amount', 'value' => 'Payment::displayMoney($data->amount)'),
        array('name'=>'date_paid', 'header'=>'Paid On', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->date_paid))'),
        array('name'=>'expires_on', 'header'=>'Expires On', 'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->expires_on))'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update} {delete}',
        ),
    ),
)); ?>
