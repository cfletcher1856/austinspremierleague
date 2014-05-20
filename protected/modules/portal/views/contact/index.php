<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        'Player Portal' => array('//portal'),
        'Players Contact'
    );

    $this->page_header = "Players Contact";
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
    ),
)); ?>
