<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APL - Standings</title>
</head>
<body>
    <a href="http://austinspremierleague.com/standings">http://austinspremierleague.com/standings</a>
    <br /><br />
    <table style="width:100%">
    <tbody>
        <tr>
            <td align="center"><strong>#</strong></td>
            <td align="center"><strong>Player</strong></td>
            <td align="center"><strong>Matches Played</strong></td>
            <td align="center"><strong>Won</strong></td>
            <td align="center"><strong>Lost</strong></td>
            <td align="center"><strong>Draw</strong></td>
            <td align="center"><strong>Points</strong></td>
            <td align="center"><strong>Leg Differential</strong></td>
            <td align="center"><strong>Season 3 Dart Avg</strong></td>
        </tr>
        <?php
            if(count($standings)):
            $ctr = 1;
            foreach($standings as $standing):
        ?>
        <tr>
            <td align="center"><?php echo $ctr++; ?></td>
            <td align="center"><?php echo $standing['player']; ?></td>
            <td align="center"><?php echo $standing['played']; ?></td>
            <td align="center"><?php echo $standing['matches_won']; ?></td>
            <td align="center"><?php echo $standing['matches_lost']; ?></td>
            <td align="center"><?php echo $standing['matches_draw']; ?></td>
            <td align="center"><?php echo $standing['points']; ?></td>
            <td align="center">
                <?php
                    if($standing['diff'] > 0) echo "+";
                    echo $standing['diff'];
                ?>
            </td>
            <td align="center"><?php echo Standings::getSeasonDartAvergae($standing['player_id']); ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="8">No matches have been played yet</td>
        </tr>
        <?php endif; ?>
    </tbody>
    </table>
    <br /><hr /><br />
    <table style="width:100%">
    <tbody>
        <tr>
            <td><strong>Highest Out</strong></td>
            <td><strong>Most 93+ Scores</strong></td>
            <td><strong>Most 180's</strong></td>
        </tr>
        <tr>
            <td>
                <?php
                    foreach($stats['high_out'] as $num => $stat){
                        if($stats['high_out'][0]['high_out'] == $stat['high_out']){
                            echo $stat['player'] . " (" . $stat['high_out'] . ")<br />";
                        }
                    }
                ?>
            </td>
            <td>
                <?php
                    foreach($stats['quality_points'] as $num => $stat){
                        if($stats['quality_points'][0]['quality_points'] == $stat['quality_points']){
                            echo $stat['player'] . " (" . $stat['quality_points'] . ")<br />";
                        }
                    }
                ?>
            </td>
            <td>
                <?php
                    foreach($stats['ton_eighties'] as $num => $stat){
                        if($stats['ton_eighties'][0]['ton_eighties'] == $stat['ton_eighties']){
                            echo $stat['player'] . " (" . $stat['ton_eighties'] . ")<br />";
                        }
                    }
                ?>
            </td>
        </tr>
    </tbody>
    </table>
</body>
</html>
