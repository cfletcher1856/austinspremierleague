<?php
Yii::import('application.modules.admin.models.Division');
Yii::import('application.modules.admin.models.Season');
Yii::import('application.models.Standings');

class Statistics{

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

    static function getDivisionStats()
    {
        $divisions = Division::model()->findAll();
        $season_id = Standings::getCurrentSeason()->id;

        $total_stats = array();
        foreach($divisions as $division)
        {
            $pids = Standings::getPlayersByDivision($division->id, $season_id);
            // echo "<pre>";print_r($pids);echo "</pre>";
            $sql = "
                SELECT
                    CONCAT(f_name, ' ', l_name) as player,
                    SUM( m.ton_eighties ) AS ton_eighties,
                    SUM( m.quality_points ) as qps
                FROM  `match` as m
                INNER JOIN `player` as p
                ON m.player_id = p.id
                INNER JOIN `schedule` as s
                ON m.schedule_id = s.id
                WHERE s.season_id = $season_id
                AND p.id IN ($pids)
                GROUP BY CONCAT(f_name, ' ', l_name)
            ";

            $thing = Yii::app()->db->createCommand($sql)->queryAll();
            foreach($thing as $key => $stat){
                $total_stats[$division->id]['ton_eighties'][$stat['player']] = $stat['ton_eighties'];
                $total_stats[$division->id]['qps'][$stat['player']] = $stat['qps'];
            }

            $sql = "
                SELECT
                    CONCAT(f_name, ' ', l_name) as player,
                    MAX( md.out ) as high_out
                FROM  `match` as m
                INNER JOIN `match_details` as md
                ON m.id = md.match_id
                INNER JOIN `player` as p
                ON m.player_id = p.id
                INNER JOIN `schedule` as s
                ON m.schedule_id = s.id
                WHERE s.season_id = $season_id
                AND p.id IN ($pids)
                GROUP BY CONCAT(f_name, ' ', l_name)
            ";

            $thing = Yii::app()->db->createCommand($sql)->queryAll();
            foreach($thing as $key => $stat){
                $total_stats[$division->id]['high_out'][$stat['player']] = $stat['high_out'];
            }

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
            ";

            $thing = Yii::app()->db->createCommand($sql)->queryAll();
            foreach($thing as $key => $stat){
                $total_stats[$division->id]['ton_plus'][$stat['player']] = $stat['ton_plus_checkouts'];
            }
        }
        return $total_stats;
        // echo "<pre>";print_r($total_stats);echo "</pre>";
    }

    static function getStats(){

        $divisions = Division::model()->findAll();
        $seasons = Season::model()->findAll();

        $total_stats = array();
        foreach($seasons as $season){
            foreach($divisions as $division)
            {
                $pids = Standings::getPlayersByDivision($division->id, $season->id);

                if($pids){
                    $sql = "
                        SELECT
                            sum(ton_eighties) as ton_eighties,
                            sum(quality_points) as quality_points,
                            s.season_id
                        FROM `match` as m
                        INNER JOIN `schedule` as s
                        ON m.schedule_id = s.id
                        WHERE m.player_id IN ($pids)
                        AND s.season_id = {$season->id}
                        GROUP BY s.season_id
                    ";

                    $stats = Yii::app()->db->createCommand($sql)->queryRow();
                    $total_stats[$season->id][$division->id]['ton_eighties'] = $stats['ton_eighties'];
                    $total_stats[$season->id][$division->id]['quality_points'] = $stats['quality_points'];

                    $sql = "
                        SELECT
                            avg(md.darts_thrown) as darts_thrown,
                            sum(md.darts_thrown) as total_darts_thrown,
                            sum(md.points_left) as total_points_left,
                            count(*) as legs_played,
                            s.season_id
                        FROM `match` as m
                        INNER JOIN `schedule` as s
                        ON m.schedule_id = s.id
                        INNER JOIN `match_details` as md
                        ON md.match_id = m.id
                        WHERE m.player_id IN ($pids)
                        AND s.season_id = {$season->id}
                        GROUP BY s.season_id
                    ";

                    $stats = Yii::app()->db->createCommand($sql)->queryRow();
                    $match_points = $stats['legs_played'] * 501;
                    $total_points = (int)$match_points - (int)$stats['total_points_left'];
                    $three_dart_avg = $total_points / ((int)$stats['total_darts_thrown'] / 3);

                    $total_stats[$season->id][$division->id]['darts_thrown'] = round($stats['darts_thrown'], 2);
                    $total_stats[$season->id][$division->id]['three_dart_avg'] = number_format($three_dart_avg, 2);
                }
            }
        }

        // echo "<pre>";print_r($total_stats);echo "</pre>";

        return $total_stats;
    }
}

