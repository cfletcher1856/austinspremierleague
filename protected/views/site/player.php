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
    $lifetime_stats = $player->getLifetimeStats();
    $record = Standings::getLifetimeRecord($player->id);
    $ton_plus_checkout = Standings::getTonPlusCheckouts($player->id);
    $season_ton_plus_checkout = Standings::getSeasonTonPlusCheckouts($player->id);
    $season_checkout = Standings::getSeatsonMedianOut($player->id);
    $lifetime_checkout = Standings::getLifetimeMedianOut($player->id);
?>

<div class="row">
    <div class="span3"><?php echo $image; ?></div>
    <div class="span4">
        <h4><?php echo $season->name; ?></h4>
        <strong>Total 93+:</strong> <?php echo $stats['quality_points']; ?> <br />
        <strong>Total Ton Eighties:</strong> <?php echo $stats['ton_eighties']; ?> <br />
        <strong>Season Three Dart Average:</strong> <?php echo Standings::getSeasonDartAvergae($player->id); ?> <br />
        <strong>100+ Checkouts:</strong> <?php echo $season_ton_plus_checkout['ton_plus_checkouts']; ?> <br />
        <strong>Median Checkout:</strong> <?php echo $season_checkout['median']; ?> <br />
        <strong>Combo Dart Checkout:</strong> <?php echo $season_checkout['two_dart_checkouts']; ?> % <br />
    </div>
    <div class="span5">
        <h4>Lifetime APL Stats</h4>
        <strong>Total 93+:</strong> <?php echo $lifetime_stats['quality_points']; ?> <br />
        <strong>Total Ton Eighties:</strong> <?php echo $lifetime_stats['ton_eighties']; ?> <br />
        <strong>Season Three Dart Average:</strong> <?php echo Standings::getLifetimeDartAvergae($player->id); ?> <br />
        <strong>100+ Checkouts:</strong> <?php echo $ton_plus_checkout['ton_plus_checkouts']; ?> <br />
        <strong>Median Checkout:</strong> <?php echo $lifetime_checkout['median']; ?> <br />
        <strong>Combo Dart Checkout:</strong> <?php echo $lifetime_checkout['two_dart_checkouts']; ?> % <br />
        <strong>Record <em><small>(Matches)</small></em>:</strong> <?php echo $record['matches_won'] . " - " . $record['matches_lost'] . " - " . $record['matches_draw']; ?> <br />
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
            'content' => $this->renderPartial('player_graphs', array(
                'player' => $player,
                'season' => $season,
            ), true),
        )
    )
)); ?>
