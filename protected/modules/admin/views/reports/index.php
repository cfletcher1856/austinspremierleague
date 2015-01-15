<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
        'Reports'
    );
    $this->menu=array(
        array('label' => 'Actions'),
        array('label'=>'Players', 'icon' => 'user', 'url'=>array('//admin/player/index')),
        array('label'=>'Membership', 'icon' => 'user', 'url'=>array('//admin/membership/index')),
        array('label'=>'Payments', 'icon' => 'money','url'=>array('//admin/payment/index')),
        array('label'=>'Matches', 'icon' => 'bar-chart','url'=>array('//admin/match/index')),
        array('label'=>'Schedule', 'icon' => 'calendar','url'=>array('//admin/schedule/index')),
        array('label'=>'Seasons', 'icon' => 'star','url'=>array('//admin/season/index')),
        array('label'=>'Division', 'icon' => 'star','url'=>array('//admin/division/index')),
        array('label'=>'Bars', 'icon' => 'beer','url'=>array('//admin/bar/index')),
        array('label'=>'Reports', 'icon' => 'file-alt','url'=>array('//admin/reports/index')),
        array('label'=>'Blind Draw', 'icon' => 'file-alt','url'=>array('//admin/blindDraw/index')),
    );
    $this->page_header = 'Reports';

    $league_balance = Reports::getLeagueBalance();
    $season = Standings::getCurrentSeason();
    $start_date = new DateTime($season->start_date);
?>

<div class="row">
    <div class="span4">
        <h3>Dues</h3>
        <?php
            foreach($players as $player)
            {
                $balance = $player->getLeagueBalance();
                if($balance > 0)
                {
                    echo $player->getFullName();
                    echo " - ";
                    echo Payment::displayMoney($balance);
                    echo "<br />";
                }
            }
        ?>
    </div>
    <div class="span5">
        <h3>Season Payments</h3>
        <?php
            $payments = Payment::model()->findAll(array(
                'order' => 'player_id, date'
            ));
            foreach($payments as $payment)
            {
                $payment_date = new DateTime($payment->date);
                if($payment_date->format('U') >= $start_date->format('U')){
                    echo "{$payment->player->getFullName()} {$payment->date} {$payment->amount} {$payment->txn_type}<br />";
                }
            }
        ?>
    </div>
</div>

<h3>League Balance</h3>
<div class="row">
    <div class="span12">
        Bar Donation - <?php echo Payment::displayMoney($league_balance['bar_donation']) ?><br />
        League Dues - <?php echo Payment::displayMoney($league_balance['player_dues']) ?><br />
        Season Total - <?php echo Payment::displayMoney($league_balance['season_total']) ?><br />
        Collected - <?php echo Payment::displayMoney($league_balance['collected']) ?><br />
        Outstanding - <?php echo Payment::displayMoney($league_balance['outstanding']) ?><br />
    </div>
</div>

