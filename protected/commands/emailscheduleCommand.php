<?php

Yii::import('application.modules.admin.models.Schedule');
Yii::import('application.modules.admin.models.Bar');
Yii::import('application.modules.admin.models.Player');

class EmailscheduleCommand extends CConsoleCommand
{
    private $this_weeks_schedule;

    public function run($args)
    {
        $players_schedule = $this->getPlayersSchedule();
        $schedule = $this->getThisWeeksSchedule();

        $from_headers = "From: Austin's Premier League <cfletcher1856@gmail.com>";

        foreach($schedule as $s)
        {
            $bar = $s->getBar();
            $board = $s->board;
            $week = $s->week;
            $games = $players_schedule[$s->h_player->email];
            $email_body = $this->generateEmail($week, $bar, $board, $games);
            // For testing
            // if($s->h_player->email == 'cfletcher1856@gmail.com' || $s->h_player->email == 'ryan.bird16@gmail.com')
            // {
                mail($s->h_player->email, "APL Week {$week} schedule", $email_body, $from_headers);
            // }
        }
    }

    private function getPlayersSchedule()
    {
        $schedule = $this->getThisWeeksSchedule();

        $_schedule = array();
        foreach($schedule as $s)
        {
            $_schedule[$s->h_player->email][$s->match] = $s->getMatchup() . " (Chalker: " . $s->getChalker() . ")";
            $_schedule[$s->a_player->email][$s->match] = $s->getMatchup() . " (Chalker: " . $s->getChalker() . ")";
            $_schedule[$s->the_chalker->email][$s->match] = $s->getMatchup() . " (Chalker: " . $s->getChalker() . ")";
        }

        return $_schedule;
    }

    private function generateEmail($week, $bar, $board, $games)
    {
        $now = new DateTime();
        $today = $now->format("m/d/Y");
        $body = <<<EOB
Week #{$week} ({$today})\n\n
You will be playing at {$bar} on board {$board}.\n\n
EOB;

        foreach($games as $match => $matchup)
        {
            $body .= "Match #{$match} {$matchup}\n";
        }

        return $body;
    }

    private function getThisWeeksSchedule()
    {
        if($this->this_weeks_schedule){
            return $this->this_weeks_schedule;
        }

        $now = new DateTime();
        $today = $now->format('Y-m-d');

        $schedule = Schedule::model()->findAllByAttributes(array(
            'date' => $today
        ));

        $this->this_weeks_schedule = $schedule;
        return $this->this_weeks_schedule;
    }
}
