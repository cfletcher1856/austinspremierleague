<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Doubles';
    $this->page_header = 'Doubles League';
?>

<?php if(Yii::app()->user->hasFlash('doubles')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('doubles'),
    )); ?>

<?php else: ?>

<h3><center>Austin's Premier League - Doubles</center></h3>

<h4><center>Austin's Premier League will be forming a new doubles league!</center></h4>

<h4>League Fees and Start Date</h4>
<p>The cost of the season for each player will be $60.00.  The league is tentatively scheduled to start Wednesday, May 22nd, and will be played every Wednesday.</p>

<h4>Team Formation</h4>
<p>Once all players have signed up, registered, and paid for the league, players will be split into two groups as follows:</p>
    <ul>
        <li>There will be a maximum of 24 spots available for players in the league.</li>
        <li>Players will be separated into two groups - an "A" group and a "B" group.</li>
        <li>Players will be placed into groups by:</li>
        <ol>
            <li>Performance in Austin's Premier Singles League</li>
            <li>Performance in the Austin Single Shooters League</li>
            <li>CADA Team Leagues</li>
            <li>Knowlege of player's ability</li>
        </ol>
        <li>A "seeding committee" will be formed to fairly and accurately group the list of entrants.</li>
        <li>A "draw party" will be held to determine the teams.  One "A" player will be paired with one "B" player through a random draw.  Each player will keep their parnter for the course of the season.</li>
    </ul>
</p>

<h4>League Duration</h4>
<p>Depends on the number of teams entered.  Either one or two matches against every other team over the course of the season with a season ending tournament on the last week.</p>

<h4>Match Format</h4>
<p>Each match will consist of 8 singles matches, and 2 doubles matches.  The format for the matches is as follows:</p>
    <ul>
        <li>(4) 501 Singles Matches (Each match best of 5)</li>
        <ul>
            <li>Team 1, Player 1 vs Team 2, Player 1</li>
            <li>Team 1, Player 2 vs Team 2, Player 1</li>
            <li>Team 1, Player 2 vs Team 2, Player 2</li>
            <li>Team 1, Player 1 vs Team 2, Player 2</li>
            <li>***Each match will have a predetermined start order.  Each team will have 2 matches where they throw first in 3 legs, and 2 matches where they throw first in 2 legs.***</li>
        </ul>    
        <li>(4) Cricket Singles Matches (Each match best of 3)</li>
        <ul>
            <li>Team 1, Player 1 vs Team 2, Player 1</li>
            <li>Team 1, Player 2 vs Team 2, Player 1</li>
            <li>Team 1, Player 2 vs Team 2, Player 2</li>
            <li>Team 1, Player 1 vs Team 2, Player 2</li>
            <li>***Each match will have a predetermined start order.  Each team will have 2 matches where they throw first in 2 legs, and 2 matches where they throw first in 1 leg.***</li>
        </ul>
        <li>(1) 501 Doubles Match (Best of 3)</li>
        <li>(1) Cricket Doubles Match (Best of 3)</li>
        <p>***Each doubles match will "cork" for the start of each leg.***</p>
    </ul>    
</p>

<h4>Match Scoring</h4>
<ul>
    <li>Each singles match is worth 1/2 point, for a total of 4 points from singles matches.</li>
    <li>Each doubles match is worth 1 point, for a total of 2 points from doubles matches.</li>
    <li>Each match has a total of 6 possible points.</li>
</ul>

<h4>League Standings</h4>
<ul>
    <li>3 points will be awarded for a match win.</li>
    <li>1 point will be awarded for a match tie.</li>
    <li>0 points will be awarded for a match loss.</li>
    <li>First tie breaker for league standings is head to head competition between teams.</li>
    <li>Second tie breaker for league standings is the total number of match points earned for the season.</li>
</ul>

<h4>Tournament Format</h4>
<ul>
    <li>The number of teams that qualify for the tournament will depend on the total number of teams entered.
        (Note: not all teams will qualify for the tournament)</li>
    <li>The tournament will be seeded based upon the team's finishing position in the league.</li>
    <li>The match format for the tournament will be as follows:</li>
    <ul>
        <li>Each match will be "Best of 7"</li>
        <li>The games are: 501-Cricket-501-Cricket-501-Cricket-Choice</li>
        <li>If a "choice" game is required, one player from each team will throw at the bull.  The player who wins
        the bull will have the option of either (1) choosing the game (501 or cricket), or (2) throwing first in the
        7th and deciding game.</li>
    </ul>
    <li>The tournament will be single elimination.</li>
</ul>    

<h4>Payouts</h4>
<ul>
    <li>Payouts for the league will be determined once all players have signed up and will be announced at the "draw party".</li>
    <li>Payouts for the tournament will be determined once all players have signed up and will be announced at the "draw party".</li>
    <li>There will be a "Mystery Out" payout at the end of the season from all the games played over the course of the season.</li>
</ul>

<h4>Registration</h4>
<p>
If you would like to sign up for the doubles league, please fill out your contact information below.  Someone from the league will be in touch with you.
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'doubles-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name'); ?>

    <?php echo $form->textFieldRow($model,'email'); ?>

    <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
            'hint'=>'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
        )); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
