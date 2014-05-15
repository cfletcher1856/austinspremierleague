<?php
Yii::import('application.modules.admin.models.Season');
class Standings{

    static function getCurrentSeason()
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

    static function getLastWeek()
    {
        $season_id = Standings::getCurrentSeason()->id;

        $sql = "
            SELECT
                MAX(s.week) as current_week
            FROM `match` as m
            LEFT JOIN `schedule` as s
            ON s.id = m.schedule_id
            WHERE s.season_id = $season_id
        ";

        $details = Yii::app()->db->createCommand($sql)->queryRow();

        return $details['current_week'] - 1;
    }

    static function getStandings($division_id=1, $week=0)
    {
        $season_id = Standings::getCurrentSeason()->id;

        $pids = Standings::getPlayersByDivision($division_id);

        $sql = "
            SELECT
                p.id as player_id,
                CONCAT(f_name, ' ', l_name) as player,
                COUNT( schedule_id ) AS played,
                SUM(
                    CASE WHEN legs_won > legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_won,
                SUM(
                    CASE WHEN legs_won < legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_lost,
                SUM(
                    CASE WHEN legs_won = legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_draw,
                SUM( legs_won - legs_lost ) AS diff,
                SUM( points ) as points,
                SUM( m.quality_points ) as qps
            FROM  `match` as m
            INNER JOIN `player` as p
            ON m.player_id = p.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE s.season_id = $season_id
            AND p.id IN ($pids)
        ";

        if($week > 0){
            $sql .= "AND s.week <= $week";
        }

        $sql .="
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY points DESC , diff DESC, qps DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getMostTonEighties($division_id=1)
    {
        $season_id = Standings::getCurrentSeason()->id;

        $pids = Standings::getPlayersByDivision($division_id);

        $sql = "
            SELECT
                CONCAT(f_name, ' ', l_name) as player,
                SUM(ton_eighties) as ton_eighties
            FROM `match` as m
            INNER JOIN `player` as p
            on m.player_id = p.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE s.season_id = $season_id
            AND p.id IN ($pids)
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY ton_eighties DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getMostQualityPoints($division_id=1)
    {
        $season_id = Standings::getCurrentSeason()->id;

        $pids = Standings::getPlayersByDivision($division_id);

        $sql = "
            SELECT
                CONCAT(f_name, ' ', l_name) as player,
                SUM(quality_points) as quality_points
            FROM `match` as m
            INNER JOIN `player` as p
            on m.player_id = p.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE s.season_id = $season_id
            AND p.id IN ($pids)
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY quality_points DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getMostTonPlusCheckouts($division_id=1){
        $season_id = Standings::getCurrentSeason()->id;

        $pids = Standings::getPlayersByDivision($division_id);

        $sql = "
            SELECT
                CONCAT(f_name, ' ', l_name) as player,
                COUNT(md.id) as ton_plus_checkouts
            FROM `match` as m
            INNER JOIN `match_details` as md
            ON m.id = md.match_id
            INNER JOIN `player` as p
            on m.player_id = p.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE s.season_id = $season_id
            AND p.id IN ($pids)
            AND md.out >= 100
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY ton_plus_checkouts DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getHighOut($division_id=1)
    {
        $season_id = Standings::getCurrentSeason()->id;

        $pids = Standings::getPlayersByDivision($division_id);

        $sql = "
            SELECT
                CONCAT(f_name, ' ', l_name) as player,
                MAX(m.out) as high_out,
                s.date as date
            FROM `match_details` as m
            INNER JOIN `player` as p
            on m.player_id = p.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE s.season_id = $season_id
            AND p.id IN ($pids)
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY high_out DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getSeasonDartAvergae($player_id)
    {
        $season_id = Standings::getCurrentSeason()->id;

        $sql = "
            SELECT
                m.id as id, legs_won, legs_lost
            FROM `match` as m
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE m.player_id = $player_id
            AND s.season_id = $season_id
        ";

        $matches = Yii::app()->db->createCommand($sql)->queryAll();

        $match_ids = array();
        $legs = 0;
        foreach($matches as $match)
        {
            $match_ids[] = $match['id'];
            $legs += $match['legs_won'];
            $legs += $match['legs_lost'];
        }

        $ids = implode($match_ids, ', ');

        $sql = "
            SELECT
                SUM(md.darts_thrown) as darts_thrown,
                SUM(md.points_left) as points_left
            FROM `match_details` as md
            INNER JOIN `match` as m
            ON m.id = md.match_id
            WHERE m.id IN ($ids)
        ";

        $details = Yii::app()->db->createCommand($sql)->queryRow();

        return Player::calculateThreeDartAverage($legs, $details['points_left'],$details['darts_thrown']);
    }

    static function getLifetimeDartAvergae($player_id){
        $sql = "
            SELECT
                m.id as id, legs_won, legs_lost
            FROM `match` as m
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE m.player_id = $player_id
        ";

        $matches = Yii::app()->db->createCommand($sql)->queryAll();

        $match_ids = array();
        $legs = 0;
        foreach($matches as $match)
        {
            $match_ids[] = $match['id'];
            $legs += $match['legs_won'];
            $legs += $match['legs_lost'];
        }

        $ids = implode($match_ids, ', ');

        $sql = "
            SELECT
                SUM(md.darts_thrown) as darts_thrown,
                SUM(md.points_left) as points_left
            FROM `match_details` as md
            INNER JOIN `match` as m
            ON m.id = md.match_id
            WHERE m.id IN ($ids)
        ";

        $details = Yii::app()->db->createCommand($sql)->queryRow();

        return Player::calculateThreeDartAverage($legs, $details['points_left'],$details['darts_thrown']);
    }

    static function getLifetimeRecord($player_id){
        $sql = "
            SELECT
                p.id as player_id,
                CONCAT(f_name, ' ', l_name) as player,
                SUM(
                    CASE WHEN legs_won > legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_won,
                SUM(
                    CASE WHEN legs_won < legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_lost,
                SUM(
                    CASE WHEN legs_won = legs_lost
                    THEN 1 ELSE 0
                    END
                ) AS matches_draw
            FROM  `match` as m
            INNER JOIN `player` as p
            ON m.player_id = p.id
            WHERE p.id = $player_id
            GROUP BY CONCAT(f_name, ' ', l_name)
        ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    private static function twoDartCheckoutPercentage($outs){
        $out_count = count($outs);

        if($out_count == 0){
            return 0;
        }

        $fortyone = 0;
        foreach($outs as $out){
            if($out >= 41){
                $fortyone++;
            }
        }

        return round(($fortyone / $out_count) * 100, 2);
    }

    static function getLifetimeMedianOut($player_id){
        $sql = "
            SELECT
                `out`
            FROM `match_details`
            WHERE `player_id` = $player_id
            AND `out` is not null
            ORDER BY `out` desc
        ";

        $arr = Yii::app()->db->createCommand($sql)->queryAll();

        $_outs = array();
        foreach($arr as $k => $v){
            $_outs[] = $v['out'];
        }

        $return['median'] = self::calculate_median($_outs);
        $return['two_dart_checkouts'] = self::twoDartCheckoutPercentage($_outs);

        return $return;
    }

    static function getSeatsonMedianOut($player_id){
        $season_id = Standings::getCurrentSeason()->id;

        $sql = "
            SELECT
                `out`
            FROM `match_details` as md
            INNER JOIN `match` as m
            ON md.match_id = m.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE m.player_id = $player_id
            AND md.out is not null
            AND s.season_id = $season_id
            ORDER BY `out` desc
        ";

        $arr = Yii::app()->db->createCommand($sql)->queryAll();

        $_outs = array();
        foreach($arr as $k => $v){
            $_outs[] = $v['out'];
        }

        $return['median'] = self::calculate_median($_outs);
        $return['two_dart_checkouts'] = self::twoDartCheckoutPercentage($_outs);

        return $return;
    }

    static function getSeasonTonPlusCheckouts($player_id){
        $season_id = Standings::getCurrentSeason()->id;

        $sql = "
            SELECT
                count(md.id) as ton_plus_checkouts
            FROM `match_details` as md
            INNER JOIN `match` as m
            ON md.match_id = m.id
            INNER JOIN `schedule` as s
            ON m.schedule_id = s.id
            WHERE m.player_id = $player_id
            AND md.out >= 100
            AND s.season_id = $season_id
        ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    static function getTonPlusCheckouts($player_id){
        $sql = "
            SELECT
                count(*) as ton_plus_checkouts
            FROM `match_details`
            WHERE `player_id` = $player_id
            AND `out` >= 100
        ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    static function nextMatchDate()
    {
        $season_id = Standings::getCurrentSeason()->id;
        $today = new DateTime();
        $today->format("Y-m-d");

        $sql = "
            SELECT
                date
            FROM `schedule`
            WHERE season_id = $season_id
            AND date > '$today'
            ORDER BY date ASC
        ";

        $next_match = Yii::app()->db->createCommand($sql)->queryRow();

        return $next_match['date'];
    }

    static function getPlayersByDivision($division_id, $season_id = ''){
        if(!$season_id){
            $season_id = Standings::getCurrentSeason()->id;
        }

        $players = PlayerSeason::model()->findAllByAttributes(array(
            'season_id' => $season_id,
            'division_id' => $division_id
        ));

        $pids = array();
        foreach($players as $player){
            $pids[] = $player->player->id;
        }

        $pids = implode(',', $pids);

        return $pids;
    }

    private static function calculate_median($arr){
        sort($arr);
        $count = count($arr);
        $middleval = floor(($count-1)/2);

        if($count % 2){
            $median = $arr[$middleval];
        } else {
            $low = $arr[$middleval];
            $high = $arr[$middleval+1];
            $median = (($low+$high)/2);
        }

        return $median;
    }
}

