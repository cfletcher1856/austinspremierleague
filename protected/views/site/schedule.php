<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Schedule';
    $this->page_header = 'Schedule';
?>

<!--
<table class="table table-bordered table-condensed table-striped">
<thead>
    <tr>
        <th>Week</th>
        <th>Match</th>
        <th>Board 2</th>
        <th>Board 3</th>
        <th>Board 4</th>
        <th>Board 5</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td rowspan="3">1 - 3/18/2013</td>
        <td>1</td>
        <td>Cocjin vs Rouse</td>
        <td>Crain vs Roberts</td>
        <td>Fletcher vs Mitchell</td>
        <td>Hutchens vs McElwee</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Hutchens vs Roberts</td>
        <td>McElwee vs Mitchell</td>
        <td>Adams vs Celestial</td>
        <td>Wellman vs Silva</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Adams vs Wellman</td>
        <td>Cocjin vs Celestial</td>
        <td>Crain vs Silva</td>
        <td>Fletcher vs Rouse</td>
    </tr>
    <tr>
        <td rowspan="3">2 - 3/25/2013</td>
        <td>1</td>
        <td>Crain vs McElwee</td>
        <td>Fletcher vs Hutchens</td>
        <td>Rouse vs Adams</td>
        <td>Silva vs Roberts</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Adams vs Silva</td>
        <td>Celestial vs Rouse</td>
        <td>Wellman vs Roberts</td>
        <td>Cocjin vs Mitchell</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Celestial vs Mitchell</td>
        <td>Wellman vs McElwee</td>
        <td>Cocjin vs Hutchens</td>
        <td>Crain vs Fletcher</td>
    </tr>
    <tr>
        <td rowspan="3">3 - 4/1/2013<br />April Fools!!</td>
        <td>1</td>
        <td>Wellman vs Fletcher</td>
        <td>Cocjin vs Crain</td>
        <td>Mitchell vs Adams</td>
        <td>Roberts vs McElwee</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Adams vs Roberts</td>
        <td>Rouse vs Mitchell</td>
        <td>Silva vs McElwee</td>
        <td>Celestial vs Hutchens</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Rouse vs Hutchens</td>
        <td>Silva vs Fletcher</td>
        <td>Celestial vs Crain</td>
        <td>Wellman vs Cocjin</td>
    </tr>
    <tr>
        <td rowspan="3">4 - 4/8/2013</td>
        <td>1</td>
        <td>Adams vs McElwee</td>
        <td>Mitchell vs Hutchens</td>
        <td>Roberts vs Cocjin</td>
        <td>Rouse vs Crain</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Silva vs Cocjin</td>
        <td>Celestial vs Wellman</td>
        <td>Hutchens vs Adams</td>
        <td>McElwee vs Fletcher</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Mitchell vs Crain</td>
        <td>Roberts vs Fletcher</td>
        <td>Rouse vs Wellman</td>
        <td>Silva vs Celestial</td>
    </tr>
    <tr>
        <td rowspan="3">5 - 4/15/2013<br />Taxes Due!!</td>
        <td>1</td>
        <td>Adams vs Fletcher</td>
        <td>Hutchens vs Crain</td>
        <td>McElwee vs Cocjin</td>
        <td>Mitchell vs Wellman</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Roberts vs Celestial</td>
        <td>Rouse vs Silva</td>
        <td>Crain vs Adams</td>
        <td>Fletcher vs Cocjin</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Hutchens vs Wellman</td>
        <td>McElwee vs Celestial</td>
        <td>Mitchell vs Silva</td>
        <td>Roberts vs Rouse</td>
    </tr>
    <tr>
        <td rowspan="3">6 - 4/22/2013<br />Happy Earth Day!!</td>
        <td>1</td>
        <td>Silva vs Crain</td>
        <td>Rouse vs Fletcher</td>
        <td>Roberts vs Hutchens</td>
        <td>Mitchell vs McElwee</td>
    </tr>
    <tr>
        <td>2</td>
        <td>McElwee vs Rouse</td>
        <td>Mitchell vs Roberts</td>
        <td>Wellman vs Adams</td>
        <td>Celestial vs Cocjin</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Adams vs Cocjin</td>
        <td>Crain vs Wellman</td>
        <td>Fletcher vs Celestial</td>
        <td>Hutchens vs Silva</td>
    </tr>
    <tr>
        <td rowspan="3">7 - 4/29/2013</td>
        <td>1</td>
        <td>Roberts vs Wellman</td>
        <td>Mitchell vs Cocjin</td>
        <td>McElwee vs Crain</td>
        <td>Hutchens vs Fletcher</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Mitchell vs Fletcher</td>
        <td>McElwee vs Hutchens</td>
        <td>Silva vs Adams</td>
        <td>Rouse vs Celestial</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Adams vs Celestial</td>
        <td>Silva vs Wellman</td>
        <td>Rouse vs Cocjin</td>
        <td>Roberts vs Crain</td>
    </tr>
    <tr>
        <td rowspan="3">8 - 5/6/2013</td>
        <td>1</td>
        <td>Hutchens vs Cocjin</td>
        <td>Fletcher vs Crain</td>
        <td>Roberts vs Adams</td>
        <td>Mitchell vs Rouse</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Adams vs Rouse</td>
        <td>Roberts vs Silva</td>
        <td>Mitchell vs Celestial</td>
        <td>McElwee vs Wellman</td>
    </tr>
    <tr>
        <td>3</td>
        <td>McElwee vs Silva</td>
        <td>Hutchens vs Celestial</td>
        <td>Fletcher vs Wellman</td>
        <td>Crain vs Cocjin</td>
    </tr>
    <tr>
        <td rowspan="3">9 - 5/13/2013</td>
        <td>1</td>
        <td>Adams vs Mitchell</td>
        <td>McElwee vs Roberts</td>
        <td>Hutchens vs Rouse</td>
        <td>Fletcher vs Silva</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Crain vs Celestial</td>
        <td>Cocjin vs Wellman</td>
        <td>McElwee vs Adams</td>
        <td>Hutchens vs Mitchell</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Fletcher vs Roberts</td>
        <td>Crain vs Rouse</td>
        <td>Cocjin vs Silva</td>
        <td>Wellman vs Celestial</td>
    </tr>
    <tr>
        <td rowspan="3">10 - 5/20/2013</td>
        <td>1</td>
        <td>Adams vs Hutchens</td>
        <td>Fletcher vs McElwee</td>
        <td>Crain vs Mitchell</td>
        <td>Cocjin vs Roberts</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Wellman vs Rouse</td>
        <td>Celestial vs Silva</td>
        <td>Fletcher vs Adams</td>
        <td>Crain vs Hutchens</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Cocjin vs McElwee</td>
        <td>Wellman vs Mitchell</td>
        <td>Celestial vs Roberts</td>
        <td>Silva vs Rouse</td>
    </tr>
    <tr>
        <td rowspan="3">11 - 5/27/2013<br />Happy Memorial Day!!</td>
        <td>1</td>
        <td>Adams vs Crain</td>
        <td>Cocjin vs Fletcher</td>
        <td>Wellman vs Hutchens</td>
        <td>Celestial vs McElwee</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Silva vs Mitchell </td>
        <td>Rouse vs Roberts</td>
        <td>Cocjin vs Adams</td>
        <td>Wellman vs Crain</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Celestial vs Fletcher</td>
        <td>Silva vs Hutchens</td>
        <td>Rouse vs McElwee</td>
        <td>Roberts vs Mitchell</td>
    </tr>
    <tr class="info">
        <td colspan="6" class="center">Top 8 Players Qualify for the Seeded Tournament</td>
    </tr>
    <tr>
        <td rowspan="4">12 - 6/3/2013</td>
        <td>Quarters</td>
        <td class="center">#1 Seed vs #8 Seed</td>
        <td class="center">#4 Seed vs #5 Seed</td>
        <td class="center">#3 Seed vs #6 Seed</td>
        <td class="center">#2 Seed vs #7 Seed</td>
    </tr>
    <tr>
        <td>Semis</td>
        <td colspan="2" class="center">Winner Board 2 vs Winner Board 3</td>
        <td colspan="2" class="center">Winner Board 4 vs Winner Board 5</td>
    </tr>
    <tr>
        <td>Consol.</td>
        <td colspan="4" class="center">Loser Board 2 vs Loser Board 4</td>
    </tr>
    <tr>
        <td>Finals</td>
        <td colspan="4" class="center">Winner Board 2 vs Winner Board 4</td>
    </tr>
</tbody>
</table>

-->
<?php
    /*
    foreach($schedule as $week => $match){
        print "Week: $week<br />Match";
        print_r($match);
        print "<br /><br />";
        foreach($match as $m => $matchup){
            print "M: $m<br />Matchup";
            print_r($matchup);
            print "<br />";
        }
        print "<br /><br />===============<br /><br />";
    }
    */
?>

<table class="table table-bordered table-condensed table-striped">
<thead>
    <tr>
        <th>Week</th>
        <th>Match</th>
        <th>Board 2</th>
        <th>Board 3</th>
        <th>Board 4</th>
        <th>Board 5</th>
    </tr>
</thead>
<tbody>
    <?php
        $_week = 'x';
        $season = Standings::getCurrentSeason();
        $start_date = new DateTime($season->start_date);
        foreach($schedule as $week => $match):
            if($week != 1){
                $start_date->modify('+7 days');
            }
            foreach($match as $m => $matchup):
    ?>
    <tr>
        <?php
            if($_week != $week):
                $_week = $week;
        ?>
        <td rowspan="3">
            <?php echo $week . ' - ' . $start_date->format('m/d/Y') ?>
        </td>
        <?php endif; ?>
        <td><?php echo $m; ?></td>
        <td><?php echo $matchup[2]; ?></td>
        <td><?php echo $matchup[3]; ?></td>
        <td><?php echo $matchup[4]; ?></td>
        <td><?php echo $matchup[5]; ?></td>
    </tr>
    <?php
            endforeach;
        endforeach;
    ?>
    <tr class="info">
        <td colspan="6" class="center">Top 8 Players Qualify for the Seeded Tournament</td>
    </tr>
    <tr>
        <td rowspan="4">12 - 6/3/2013</td>
        <td>Quarters</td>
        <td class="center">#1 Seed vs #8 Seed</td>
        <td class="center">#4 Seed vs #5 Seed</td>
        <td class="center">#3 Seed vs #6 Seed</td>
        <td class="center">#2 Seed vs #7 Seed</td>
    </tr>
    <tr>
        <td>Semis</td>
        <td colspan="2" class="center">Winner Board 2 vs Winner Board 3</td>
        <td colspan="2" class="center">Winner Board 4 vs Winner Board 5</td>
    </tr>
    <tr>
        <td>Consol.</td>
        <td colspan="4" class="center">Loser Board 2 vs Loser Board 4</td>
    </tr>
    <tr>
        <td>Finals</td>
        <td colspan="4" class="center">Winner Board 2 vs Winner Board 4</td>
    </tr>
<tbody>
</table>
