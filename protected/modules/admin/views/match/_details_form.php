<?php
    $this->breadcrumbs=array(
        'Admin' => array("//admin"),
        'Matches'=>array('index'),
        $schedule->getMatchup()=>array('view','id'=>$schedule->id),
        'Details',
    );

    $this->menu=array(
        array('label' => 'Actions'),
        array('label'=>'List Matches', 'icon' => 'list','url'=>array('index')),
        //array('label'=>'Create Match', 'icon' => 'plus','url'=>array('create')),
        array('label'=>'View Match', 'icon' => 'search','url'=>array('view','id'=>$schedule->id)),
    );
    $this->page_header = "Match Details";
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'match-details-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary(array_merge($home_match_details, $away_match_details)); ?>


    <h4><?php echo $schedule->h_player->getFullName(); ?></h4>
    <table class="table">
    <thead>
        <tr>
            <th>Leg</th>
            <th>Darts Thrown</th>
            <th>Out</th>
            <th>Points Left</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $ctr = 1;
            $h_player_id = $schedule->h_player->id;
            foreach($home_match_details as $m => $match):
        ?>
        <tr>
            <td>
                <?php echo "<input value=\"{$ctr}\" name=\"MatchDetails[$h_player_id][$m][match_num]\" id=\"MatchDetails_{$h_player_id}_{$m}_num\" type=\"hidden\">"; ?>
                <?php echo $ctr++; ?>
                <?php echo "<input value=\"{$schedule->id}\" name=\"MatchDetails[$h_player_id][$m][schedule_id]\" id=\"MatchDetails_{$h_player_id}_{$m}_schedule_id\" type=\"hidden\">"; ?>
                <?php echo "<input value=\"{$match_ids['home']}\" name=\"MatchDetails[$h_player_id][$m][match_id]\" id=\"MatchDetails_{$h_player_id}_{$m}_match_id\" type=\"hidden\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['darts_thrown']}\" class=\"span2\" name=\"MatchDetails[$h_player_id][$m][darts_thrown]\" id=\"MatchDetails_{$h_player_id}_{$m}_darts_thrown\" type=\"text\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['out']}\" class=\"span2\" name=\"MatchDetails[$h_player_id][$m][out]\" id=\"MatchDetails_{$h_player_id}_{$m}_out\" type=\"text\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['points_left']}\" class=\"span2\" name=\"MatchDetails[$h_player_id][$m][points_left]\" id=\"MatchDetails_{$h_player_id}_{$m}_points_left\" type=\"text\">"; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <h4><?php echo $schedule->a_player->getFullName(); ?></h4>
    <table class="table">
    <thead>
        <tr>
            <th>Leg</th>
            <th>Darts Thrown</th>
            <th>Out</th>
            <th>Points Left</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $ctr = 1;
            $a_player_id = $schedule->a_player->id;
            foreach($away_match_details as $m => $match):
        ?>
        <tr>
            <td>
                <?php echo "<input value=\"{$ctr}\" name=\"MatchDetails[$a_player_id][$m][match_num]\" id=\"MatchDetails_{$a_player_id}_{$m}_num\" type=\"hidden\">"; ?>
                <?php echo $ctr++; ?>
                <?php echo "<input value=\"{$schedule->id}\" name=\"MatchDetails[$a_player_id][$m][schedule_id]\" id=\"MatchDetails_{$a_player_id}_{$m}_schedule_id\" type=\"hidden\">"; ?>
                <?php echo "<input value=\"{$match_ids['away']}\" name=\"MatchDetails[$a_player_id][$m][match_id]\" id=\"MatchDetails_{$a_player_id}_{$m}_match_id\" type=\"hidden\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['darts_thrown']}\" class=\"span2\" name=\"MatchDetails[$a_player_id][$m][darts_thrown]\" id=\"MatchDetails_{$a_player_id}_{$m}_darts_thrown\" type=\"text\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['out']}\" class=\"span2\" name=\"MatchDetails[$a_player_id][$m][out]\" id=\"MatchDetails_{$a_player_id}_{$m}_out\" type=\"text\">"; ?>
            </td>

            <td>
                <?php echo "<input value=\"{$match['points_left']}\" class=\"span2\" name=\"MatchDetails[$a_player_id][$m][points_left]\" id=\"MatchDetails_{$a_player_id}_{$m}_points_left\" type=\"text\">"; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
var teams = ko.observableArray(<?php echo ($teams) ? $teams : "[]"; ?>);
$(function(){
    var MatchModel = function(matches) {
        var self = this;
        self.matches = ko.observableArray(matches);

        self.addmatch = function() {
            self.matches.push({
                home: "",
                away: ""
            });
        };

        self.removematch = function(match) {
            self.matches.remove(match);
        };
    };

    var viewModel = new MatchModel(
        <?php echo ($selected_teams) ? $selected_teams : "[]"; ?>
    );
    ko.applyBindings(viewModel);
});

function UpdateTeams(){
    var drop = $("#Schedule_league_id");
    $.getJSON('/setup/schedule/getteams', {
            'league_id': drop.val(),
        },
        function(data){
            setTeams(data);
        }
    );
}

function setTeams(data){
    teams.removeAll();
    for(t in data){
        teams.push(data[t]);
    }
}
</script>
