<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        'Player Portal'
    );

    $this->page_header = "Player Portal";
?>

<div class="row">
    <div class="well widget-well span4">
        <h3>Dues Owed</h3>
        <p><?php echo $data['DuesOwed']; ?></p>
    </div>
    <div class="well widget-well span4">
        <h3>Payments/Fees</h3>
        <p>
            <?php
                foreach($data['PaymentsFees'] as $payment)
                {
                    $date = new DateTime($payment->date);
                    echo $date->format('m/d/Y') . " - " . $payment->amount ." (". ucfirst($payment->txn_type) . ")<br />";
                }
            ?>
        </p>
    </div>
</div>

<div class="row">
    <div class="well widget-well span4">
        <h3>This Weeks Match</h3>
        <?php if(count($data['ThisWeeksMatch']) > 0): ?>
        <p><strong><?php echo $data['ThisWeeksMatch'][0]->bar->name . " - Board " . $data['ThisWeeksMatch'][0]->board . " " . $data['ThisWeeksMatch'][0]->getMatchDate(); ?></stong></p>
        <p>
            <?php
                foreach($data['ThisWeeksMatch'] as $match)
                {
                    echo $match->match . ") " . $match->getMatchup() . " (" . $match->getChalker() . ")<br />";
                }
            ?>
        </p>
        <?php endif; ?>
    </div>
    <div class="well widget-well span4">
        <h3>Make Up Games</h3>
        <?php if(count($data['MakeUpGames']) > 0): ?>
        <p>
        <?php
            foreach($data['MakeUpGames'] as $match){
                $date = new DateTime($match['date']);
                echo "Week " . $match['week'] . " - " . $date->format('m/d/Y') . ' - ' . $match->getMatchup() . "<br />";
            }
        ?>
        </p>
        <?php endif; ?>
    </div>
</div>
