<?php
    if($profile->image){
        $image = Yii::app()->thumb->render(Yii::app()->basePath.'/../profiles/'.$profile->image, array(
            'width' => '250',
            'height' => '250',
            'link' => 'true',
            'hint' => 'false',
            //'crop' => 'false',
            'sharpen' => 'true',
            'longside' => '255',
            'imgOptions' => array(),
            'imgAlt' => $player->getFullName(),
        ));
    }

    $this->page_header = $player->getFullName();
    $stats = $player->getStats();
?>

<div class="row">
    <div class="span3"><?php echo $image; ?></div>
    <div class="span9">
        <strong>Total 93+:</strong> <?php echo $stats['quality_points']; ?> <br />
        <strong>Total Ton Eighties:</strong> <?php echo $stats['ton_eighties']; ?> <br />
        <strong>Season Three Dart Average:</strong> <?php echo Standings::getSeasonDartAvergae($player->id); ?> <br />
    </div>
</div>

<div class="row"><br /></div>

<div class="row clearfix">
    <div class="span12">
        <table class="table">
        <tbody>
            <?php
                foreach($profile->attributeLabels() as $key => $question):
                    if(!in_array($key, array('id', 'player_id', 'image'))):
            ?>
            <tr>
                <td><?php echo $question; ?></td>
                <td><?php echo $profile->$key; ?></td>
            </tr>
            <?php
                    endif;
                endforeach;
            ?>
        </tbody>
        </table>
    </div>
</div>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs'=> array(
        array(
            'active' => true,
            'label' => 'Matches',
            'content' => $this->renderPartial('_stats', array('dataProvider'=>$matchDataProvider, 'schedule' => $schedule), true),
        ),
        array(
            'label' => 'Stats',
            'content' => $this->renderPartial('_player_graphs', array(
                'player' => $player,
                'season' => $season,
            ), true),
        )
    )
)); ?>
