<?php
    /* @var $this SiteController */
    Yii::import('application.models.Standings');
    $this->pageTitle='APL - Standings';
    $this->page_header = 'Standings <a href="/statistics/" class="btn btn-info pull-right"><i class="icon-tasks"></i>  Seasons Statistics</a> <a style="margin-right: 10px" href="/division-statistics/" class="btn btn-info pull-right"><i class="icon-tasks"></i>  Division Statistics</a>';
?>


<?php
    foreach($_standings as $division => $standings):
?>
<h3>Division <?php echo $division; ?></h3>
<table class="table table-condensed">
<thead>
    <tr>
        <th>#</th>
        <th>&nbsp;</th>
        <th>Player</th>
        <th>Matches Played</th>
        <th>Won</th>
        <th>Lost</th>
        <th class="right-divider">Draw</th>
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
        <td><?php echo $ctr; ?></td>
        <td>
            <?php
                if($blah[$division][$standing['player']] > $ctr)
                {
                    echo "<span style=\"color: #38B44A;\">";
                    echo "<i class=\"icon icon-caret-up\"></i>&nbsp;";
                    echo "<small>" . abs($blah[$division][$standing['player']] - $ctr) . "</small>";
                    echo "</span>";
                } elseif($blah[$division][$standing['player']] < $ctr)
                {
                    echo "<span style=\"color: #C4291E;\">";
                    echo "<i class=\"icon icon-caret-down\"></i>&nbsp";
                    echo "<small>" . abs($blah[$division][$standing['player']] - $ctr) . "</small>";
                    echo "</span>";
                } else
                {
                    echo "<i class=\"icon icon-caret-right\"></i>&nbsp";
                }
            ?>
        </td>
        <td>
            <?php echo CHtml::link($standing['player'], array('//site/player', 'player' => $standing['player'])); ?>
        </td>
        <td><?php echo $standing['played']; ?></td>
        <td><?php echo $standing['matches_won']; ?></td>
        <td><?php echo $standing['matches_lost']; ?></td>
        <td class="right-divider"><?php echo $standing['matches_draw']; ?></td>
        <td><?php echo $standing['points']; ?></td>
        <td>
            <?php
                if($standing['diff'] > 0) echo "+";
                echo $standing['diff'];
            ?>
        </td>
        <td><?php echo Standings::getSeasonDartAvergae($standing['player_id']); ?></td>
    </tr>
    <?php $ctr++; endforeach; ?>
    <?php else: ?>
    <tr>
        <td colspan="10">No matches have been played yet</td>
    </tr>
    <?php endif; ?>
</tbody>
</table>


<div class="row">
    <div class="span2">
        <strong>Highest Out</strong><br />
        <?php
            foreach($stats[$division]['high_out'] as $num => $stat){
                if($stats[$division]['high_out'][0]['high_out'] == $stat['high_out']){
                    echo $stat['player'] . " (" . $stat['high_out'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span2">
        <strong>Most 93+ Scores</strong><br />
        <?php
            foreach($stats[$division]['quality_points'] as $num => $stat){
                if($stats[$division]['quality_points'][0]['quality_points'] == $stat['quality_points']){
                    echo $stat['player'] . " (" . $stat['quality_points'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span2">
        <strong>Avg 93+ Score per leg</strong><br />
        <?php
            foreach($stats[$division]['average_quality_points'] as $num => $stat){
                if($stats[$division]['average_quality_points'][0]['avg_qps'] == $stat['avg_qps']){
                    echo $stat['player'] . " (" . $stat['avg_qps'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span2">
        <strong>Most 100+ Checkouts</strong><br />
        <?php
            foreach($stats[$division]['ton_plus_checkouts'] as $num => $stat){
                if($stats[$division]['ton_plus_checkouts'][0]['ton_plus_checkouts'] == $stat['ton_plus_checkouts'] && $stat['ton_plus_checkouts'] > 0){
                    echo $stat['player'] . " (" . $stat['ton_plus_checkouts'] . ")<br />";
                }
            }
        ?>
    </div>
    <div class="span2">
        <strong>Most 180's</strong><br />
        <?php
            foreach($stats[$division]['ton_eighties'] as $num => $stat){
                if($stats[$division]['ton_eighties'][0]['ton_eighties'] == $stat['ton_eighties'] && $stat['ton_eighties'] > 0){
                    echo $stat['player'] . " (" . $stat['ton_eighties'] . ")<br />";
                }
            }
        ?>
    </div>
</div>
<?php endforeach; ?>
