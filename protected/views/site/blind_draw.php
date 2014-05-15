<?php
    /* @var $this SiteController */
    Yii::import('application.modules.admin.models.BlindDraw');
    $this->pageTitle='APL - Blind Draw';
    $this->page_header = 'Blind Draw';
    $this->sub_header = 'Sundays 3:00 pm Texas Bar & Grill (2:30 pm Sign Up)';
    $doubles_pot = BlindDraw::model()->getDoubleShotPot();
?>

<div class="row">
    <div class="span12">
        <p>
            The APL would like to give a special THANK YOU to Rick Crain and
            Keith Hutchens for donating their own money to grow the Doubles Shot Pot
        </p>
    </div>
</div>

<div class="row">
    <div class="span9">
        <table class="table table-condensed table-striped table-bordered">
        <tr>
            <th>Date</th>
            <th>Participants</th>
            <th>Winner</th>
            <th>Doubles Shot Winner</th>
            <th>Number Pulled</th>
            <th>Doubles Shot Amount Won</th>
        </tr>
        <?php foreach($blind_draws as $blind_draw): ?>
        <tr>
            <td>
                <?php
                    $date = new DateTime($blind_draw->date);
                    echo $date->format('m/d/Y');
                ?>
            </td>
            <td><?php echo $blind_draw->participants;?></td>
            <td><?php echo $blind_draw->winner;?></td>
            <td><?php echo $blind_draw->double_shot_winner;?></td>
            <td><?php echo $blind_draw->number_pulled;?></td>
            <td>$<?php echo money_format("%i", $blind_draw->double_shot_payout);?></td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <div class="span3">
        <div class=" doubles_pot">
            <h4>Current Double Shot Pot</h4>
            <span class="pot_amount">
                <?php echo "$".money_format("%i", $doubles_pot); ?>
            </span>
        </div>
        <div class="doubles_pot_breakdown">
            <h4>Breakdown</h4>
            First Dart: $<?php echo money_format("%i", floor($doubles_pot * .9)); ?><br />
            Second Dart: $<?php echo money_format("%i", floor($doubles_pot * .6)); ?><br />
            Third Dart: $<?php echo money_format("%i", floor($doubles_pot * .3)); ?><br />
        </div>
    </div>
</div>
