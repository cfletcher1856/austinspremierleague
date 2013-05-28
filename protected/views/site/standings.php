<?php
    /* @var $this SiteController */
    Yii::import('application.models.Standings');
    $this->pageTitle='APL - Standings';
    $this->page_header = 'Standings';
?>


<table class="table table-condensed">
<thead>
    <tr>
        <th>#</th>
        <th>Player</th>
        <th>Matches Played</th>
        <th>Won</th>
        <th>Lost</th>
        <th>Draw</th>
        <th>Points</th>
        <th>Leg Differential</th>
        <th>Season 3 Dart Avg</th>
    </tr>
</thead>
<tbody>
    <?php
        if(count($standings)):
        $ctr = 1;
        foreach($standings as $standing):
    ?>
    <tr>
        <td><?php echo $ctr++; ?></td>
        <td><?php echo $standing['player']; ?></td>
        <td><?php echo $standing['played']; ?></td>
        <td><?php echo $standing['matches_won']; ?></td>
        <td><?php echo $standing['matches_lost']; ?></td>
        <td><?php echo $standing['matches_draw']; ?></td>
        <td><?php echo $standing['points']; ?></td>
        <td>
            <?php
                if($standing['diff'] > 0) echo "+";
                echo $standing['diff'];
            ?>
        </td>
        <td><?php echo Standings::getSeasonDartAvergae($standing['player_id']); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td colspan="8">No matches have been played yet</td>
    </tr>
    <?php endif; ?>
</tbody>
</table>


<div class="row">
    <div class="span4">
        <strong>Highest Out</strong><br />
        <?php
            foreach($stats['high_out'] as $num => $stat){
                if($stats['high_out'][0]['high_out'] == $stat['high_out']){
                    echo $stat['player'] . " (" . $stat['high_out'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span4">
        <strong>Most 93+ Scores</strong><br />
        <?php
            foreach($stats['quality_points'] as $num => $stat){
                if($stats['quality_points'][0]['quality_points'] == $stat['quality_points']){
                    echo $stat['player'] . " (" . $stat['quality_points'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span4">
        <strong>Most 180's</strong><br />
        <?php
            foreach($stats['ton_eighties'] as $num => $stat){
                if($stats['ton_eighties'][0]['ton_eighties'] == $stat['ton_eighties']){
                    echo $stat['player'] . " (" . $stat['ton_eighties'] . ")<br />";
                }
            }
        ?>
    </div>
</div>
