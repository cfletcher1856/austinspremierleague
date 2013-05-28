<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'schedule-form',
	//'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'season_id', Season::model()->getSeasonsDropDown(),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'week',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'match',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5 datepicker')); ?>

	<?php echo $form->dropDownListRow($model,'home_player', Player::model()->getPlayersDropDown(),array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'away_player', Player::model()->getPlayersDropDown(),array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'chalker',Player::model()->getChalkerDropDown($model->match, $model->season_id, $model->week),array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'board', array("2" => "Board 2", "3" => 'Board 3', "4" => 'Board 4', '5' => 'Board 5'), array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>


		<?php
			if($model->isNewRecord){
				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'inputSubmit',
					'type'=>'primary',
					'label'=>'Save and Create Another',
					'htmlOptions' => array(
						'name' => 'SaveContinue'
					)
				));
			}
		?>
	</div>

<?php $this->endWidget(); ?>
