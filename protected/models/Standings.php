<?php
Yii::import('application.modules.admin.models.Season');
class Standings{

    static function getCurrentSeason()
    {
        $_today = new DateTime();
        $today = $_today->format('Y-m-d');
        $season = Season::model()->findAll(array(
            'condition' => ":today BETWEEN start_date AND end_date",
            'params' => array(':today'=>$today),
        ));

        return $season[0];
    }

    static function getStandings()
    {
        $season_id = Standings::getCurrentSeason()->id;

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
            AND p.active = 1
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY points DESC , diff DESC, qps DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getMostTonEighties()
    {
        $season_id = Standings::getCurrentSeason()->id;

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
            AND p.active = 1
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY ton_eighties DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getMostQualityPoints()
    {
        $season_id = Standings::getCurrentSeason()->id;

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
            AND p.active = 1
            GROUP BY CONCAT(f_name, ' ', l_name)
            ORDER BY quality_points DESC
        ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    static function getHighOut()
    {
        $season_id = Standings::getCurrentSeason()->id;

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
}

