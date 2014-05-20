<?php
Yii::import('application.modules.admin.models.Payment');
Yii::import('application.modules.admin.models.Season');
Yii::import('application.modules.admin.models.Schedule');

class Widget
{
    private static $player;
    private static $widget_data = array();

    static function getWidgetData()
    {
        self::$player = Yii::app()->user->getUser();

        self::getDuesOwed();
        self::getThisWeeksMatch();
        self::getMakeUpGames();
        self::getWeeksMissed();
        self::getPaymentsFees();

        return self::$widget_data;
    }

    private static function getDuesOwed()
    {
        $balance = self::$player->getLeagueBalance();
        self::$widget_data['DuesOwed'] = self::displayMoney($balance);
    }

    private static function getThisWeeksMatch()
    {
        $season_id = self::getCurrentSeason()->id;
        $today = new DateTime();
        $is_monday = $today->format('N') == '1';

        $matches = Schedule::model()->findAll(array(
            'condition' => '(home_player = :player_id or away_player = :player_id or chalker = :player_id) and season_id = :season_id and date >= :today',
            'params' => array(
                ':player_id' => self::$player->id,
                ':season_id' => $season_id,
                ':today' => $today->format('Y-m-d')
                // ':today' => '2014-05-07'
            ),
            'order' => '`date`, `match` ASC'
        ));

        $_matches = array();
        if(count($matches) > 0)
        {
            $_matches[] = $matches[0];
            $_matches[] = $matches[1];
            $_matches[] = $matches[2];
        }

        self::$widget_data['ThisWeeksMatch'] = $_matches;
    }

    private static function getMakeUpGames()
    {
        $season_id = self::getCurrentSeason()->id;
        $today = new DateTime();
        // We dont want to include the matches on match day so we are going to
        // drop the date by one
        $today->modify('-1day');
        $today = $today->format('Y-m-d');
        $player_id = self::$player->id;
        // Player ID 25  = Jim

        $sql = "
            SELECT
                s.id
            FROM `schedule` as s
            LEFT OUTER JOIN `match` as m
            ON s.id = m.schedule_id
            WHERE s.date <= '$today'
            AND (s.home_player = '$player_id'
                 OR s.away_player = '$player_id')
            AND m.id is null
            AND s.season_id = $season_id
            AND (s.home_player != 25 AND s.away_player != 25)
        ";

        $makeups = Yii::app()->db->createCommand($sql)->queryAll();

        $scheduleids = array();
        foreach($makeups as $makeup){
            $scheduleids[] = $makeup['id'];
        }
        $matches = array();
        if(count($scheduleids)){
            $matches = Schedule::model()->findAllByAttributes(array(), 'id IN('. implode(',', $scheduleids) .') ORDER BY week');
        }

        self::$widget_data['MakeUpGames'] = $matches;
    }

    private static function getWeeksMissed()
    {
        self::$widget_data['WeeksMissed'] = array();
    }

    private static function getPaymentsFees()
    {
        $today = new DateTime();
        $season = self::getCurrentSeason();
        $data = Payment::model()->findAll(array(
            'condition' => 'player_id = :player_id AND `date` BETWEEN :season_start AND :season_end',
            'params' => array(
                ':player_id' => self::$player->id,
                ':season_start' => $season->start_date,
                ':season_end' => $season->end_date
            )
        ));

        $payments = array();
        foreach($data as $payment)
        {
            $payment->amount = self::displayMoney($payment->amount);
            $payments[] = $payment;
        }

        self::$widget_data['PaymentsFees'] = $payments;
    }

    private static function displayMoney($amount)
    {
        setlocale(LC_MONETARY, 'en_US');
        return money_format('%(#10n', $amount);
    }

    private static function getCurrentSeason()
    {
        $_today = new DateTime();
        $today = $_today->format('Y-m-d');
        $seasons = Season::model()->findAll(array('order' => 'end_date'));
        //If there is only one season return that one
        if(count($seasons) == 1)
        {
            return $seasons[0];
        }

        //If we are in the middle of a season return that season
        $season = Season::model()->findAll(array(
            'condition' => ":today BETWEEN start_date AND end_date",
            'params' => array(':today'=>$today),
        ));

        if($season)
        {
            return $season[0];
        }

        //If you are between seasons return the next season
        if($seasons[count($seasons) - 2]->end_date <= $today)
        {
            return $seasons[count($seasons) - 1];
        }
    }
}
