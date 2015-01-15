<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Schedule';
    $this->page_header = 'Schedule - '.$division;
?>

<div class="row">
    <div class="span1">
        <a href="/schedule/Spring+2015/Division+1" class="btn btn-mini btn-primary">Division 1</a>
    </div>

    <div class="span1">
        <a href="/schedule/Spring+2015/Division+2" class="btn btn-mini btn-primary">Division 2</a>
    </div>

    <div class="span3">
        <a href="/schedule/Spring+2015/Division+3" class="btn btn-mini btn-primary">Division 3</a>
    </div>
</div>

<p>&nbsp;</p>

<table class="table table-bordered table-condensed table-striped">
<thead>
    <tr>
        <th>Week</th>
        <th>Match</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
    <?php
        // echo "<pre>";
        // print_r($schedule);
        // echo "</pre>";
        $_week = 'x';
        $season = Standings::getCurrentSeason();
        $week = 1;
        $today = new DateTime();
        $today->setTime(0, 0);
        foreach($schedule as $date => $match):
            // print sizeof($match);
            foreach($match as $m => $matchup):
                $strikethrough = false;
                $match_date = new DateTime($date);
                if($today > $match_date){
                    $strikethrough = true;
                }
    ?>
    <tr>
        <?php
            if($_week != $week):
                $_week = $week;
        ?>
        <td rowspan="3">
            <?php
                if($strikethrough) echo "<strike>";
                echo $week . ' - ' . $date;
            ?>
            <br /><?php echo $bar_list[$date]; ?>
            <?php
                echo $schedule->bar->name;
                if($strikethrough) echo "</strike>";
            ?>
        </td>
        <?php endif; ?>
        <td><?php echo $m; ?></td>
        <?php foreach($matchup as $board => $players): ?>
        <td><?php echo $players; ?> - <strong>Board <?php echo $board; ?></strong></td>
        <?php endforeach; ?>
    </tr>
    <?php
            endforeach;
            $week++;
        endforeach;
    ?>
    <?php //$this->renderPartial('webroot.themes.' . Yii::app()->theme->name . '.views.partials.schedule_tournament'); ?>

<tbody>
</table>
