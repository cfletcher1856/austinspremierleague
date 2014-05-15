<?php

class Reports{

    static function getLeagueBalance()
    {
        $season = Standings::getCurrentSeason();
        $start_date = new DateTime($season->start_date);
        $num_of_players = count(Player::model()->findAll(array(
            'condition' => 'active = :active AND f_name != :fname AND f_name != :fname2',
            'params' => array(
                ':active' => '1',
                ':fname' => 'Raggedy',
                ':fname2' => 'Texas'
            )
        )));

        $player_dues = $season->dues * $num_of_players;

        $payments = Payment::model()->findAll();

        $collected = 0.00;
        $fees = 0.00;
        foreach($payments as $payment)
        {
            $payment_date = new DateTime($payment->date);
            if($payment_date->format('U') >= $start_date->format('U')){
                if($payment->txn_type == 'payment')
                {
                    $collected += $payment->amount;
                }
                else
                {
                    $fees += $payment->amount;
                }
            }
        }

        $season_total = $player_dues + $season->bar_donation;

        return array(
            'player_dues' => $player_dues,
            'bar_donation' => $season->bar_donation,
            'collected' => $collected,
            'season_total' => $season_total,
            'outstanding' => $season_total - $collected,
        );
    }
}
