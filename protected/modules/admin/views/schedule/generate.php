<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
        'Schedules',
    );

    $this->menu=array(
        array('label' => 'Actions'),
        array('label'=>'Create Schedule','icon' => 'plus','url'=>array('create')),
        array('label'=>'Generate Schedule','icon' => 'plus','url'=>array('generate')),
    );
    $this->page_header = 'Generate Schedule';
?>

<h3>Players</h3>
<ul>
    <?php foreach($players as $player): ?>
        <li><?php echo $player->f_name; ?></li>
    <?php endforeach; ?>
</ul>
