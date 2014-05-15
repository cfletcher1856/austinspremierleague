<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {pager}",
    'columns'=>array(
        array('name'=>'match', 'header'=>'Bar', 'value'=>'$data->getBar()'),
        array('name'=>'board', 'header'=>'Board'),
        array('name'=>'match', 'header'=>'Match'),
        array('name' => 'matchup', 'header' => 'Matchup', 'value' => '$data->getMatchup()'),
        array('name' => 'chalker', 'header' => 'Chalker', 'value' => '$data->getChalker()'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
            'template' => '{view} {update}',
        ),
    ),
)); ?>
