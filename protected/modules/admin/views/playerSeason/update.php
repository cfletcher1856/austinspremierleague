<?php
    $this->breadcrumbs=array(
        'Admin' => array('//admin'),
    	'Player Seasons'=>array('index'),
    	$model->id=>array('view','id'=>$model->id),
    	'Update',
    );

    $this->menu=array(
        array('label' => 'Actions'),
    );
?>

<h1>Update PlayerSeason <?php echo $model->id; ?></h1>

<?php
    echo $this->renderPartial('_form',array(
        'model'=>$model,
        'divisions' => $divisions,
        'activeDivisions' => $activeDivisions,
        'season' => $season,
        'activePlayers' => $activePlayers,
        'players' => $players,
        'currentPlayers'=>$currentPlayers,
    ));
?>
