<?php

class Reports{

    static function getLeagueBalance()
    {
        $season = Standings::getCurrentSeason();
        $num_of_players = count(Player::model()->findAll(array(
            'condition' => 'active = :active AND f_name != :fname',
            'params' => array(
                ':active' => '1',
                ':fname' => 'Raggedy'
            )
        )));

        $player_dues = $season->dues * $num_of_players;

        $payments = Payment::model()->findAll();

        $collected = 0.00;
        $fees = 0.00;
        foreach($payments as $payment)
        {
            if($payment->txn_type == 'payment')
            {
                $collected += $payment->amount;
            }
            else
            {
                $fees += $payment->amount;
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
