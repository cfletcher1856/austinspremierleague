<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'match-form',
	//'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($matches); ?>

    <?php
        $players = array(
            array(
                'name' => $schedule->h_player->getFullName(),
                'id' => $schedule->h_player->id
            ),
            array(
                'name' => $schedule->a_player->getFullName(),
                'id' => $schedule->a_player->id
            )
        );
        foreach($matches as $m => $match):
    ?>
        <h4><?php echo $players[$m]['name']; ?></h4>
    	<?php echo $form->textFieldRow($match,"[$m]legs_won",array('class'=>'span5')); ?>

    	<?php echo $form->textFieldRow($match,"[$m]legs_lost",array('class'=>'span5')); ?>

    	<?php echo $form->textFieldRow($match,"[$m]leg_differential",array('class'=>'span5')); ?>

    	<?php echo $form->textFieldRow($match,"[$m]ton_eighties",array('class'=>'span5')); ?>

    	<?php echo $form->textFieldRow($match,"[$m]quality_points",array('class'=>'span5')); ?>

    	<?php //echo $form->textFieldRow($match,"[$m]darts_thrown",array('class'=>'span5')); ?>

        <?php echo $form->hiddenField($match, "[$m]player_id",array('value'=>$players[$m]['id'])); ?>

        <?php echo $form->hiddenField($match, "[$m]schedule_id",array('value'=>$schedule->id)); ?>

    <?php endforeach; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=> 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
	$(function(){
        var h_wins, h_losses, h_diff, a_wins, a_losses, a_diff;
		$("#Match_0_legs_won").on('blur', function(){
            h_wins = parseInt($(this).val(), 10);
            a_losses = h_wins;
            $("#Match_1_legs_lost").val(a_losses);
        });

        $("#Match_0_legs_lost").on('blur', function(){
            h_losses = parseInt($(this).val(), 10);
            a_wins = h_losses;
            $("#Match_1_legs_won").val(a_wins);

            h_diff = h_wins - h_losses;
            a_diff = a_wins - a_losses;
            $("#Match_0_leg_differential").val(h_diff);
            $("#Match_1_leg_differential").val(a_diff);
        });
	});
</script>
