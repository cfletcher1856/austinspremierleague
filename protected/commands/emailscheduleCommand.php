<?php

Yii::import('application.modules.admin.models.Schedule');
Yii::import('application.modules.admin.models.Bar');
Yii::import('application.modules.admin.models.Player');


class ScheduleData
{
    private $this_weeks_schedule;

    public function getPlayersSchedule()
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

    public function generateEmail($week, $bar, $board, $games)
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

    public function getThisWeeksSchedule()
    {
        if($this->this_weeks_schedule){
            return $this->this_weeks_schedule;
        }

        $now = new DateTime();
        $today = $now->format('Y-m-d');

        $today = '2015-01-19';

        $schedule = Schedule::model()->findAllByAttributes(array(
            'date' => $today
        ));

        $this->this_weeks_schedule = $schedule;
        return $this->this_weeks_schedule;
    }
}


class EmailscheduleCommand extends CConsoleCommand
{
    public function run($args)
    {
        $sd = new ScheduleData();

        $players_schedule = $sd->getPlayersSchedule();
        $schedule = $sd->getThisWeeksSchedule();

        $from_headers = "From: Austin's Premier League <schedule@austinspremierleague.com>";

        foreach($schedule as $s)
        {
            $bar = $s->getBar();
            $board = $s->board;
            $week = $s->week;
            $games = $players_schedule[$s->h_player->email];
            $email_body = $sd->generateEmail($week, $bar, $board, $games);
            // Adding league balance
            $email_body .= "\n\n";
            $email_body .= "Your League Balance: $".$s->h_player->getLeagueBalance();
            // For testing
            // if($s->h_player->email == 'cfletcher1856@gmail.com' || $s->h_player->email == 'ryan.bird16@gmail.com')
            // if($s->h_player->email == 'cfletcher1856@gmail.com')
            // {
                // echo "sending email to " . $s->h_player->email . "\n" . "APL Week {$week} schedule\n";
                 mail($s->h_player->email, "APL Week {$week} schedule", $email_body, $from_headers, '-fschedule@austinspremierleague.com');
                // mail('colin@protectamerica.com', "APL Week {$week} schedule", $email_body, $from_headers, '-fschedule@austinspremierleague.com');
            // }
        }

        mail('cfletcher1856@gmail.com', "Done sending schedule", 'Script done running', $from_headers, '-fschedule@austinspremierleague.com');
    }
}
