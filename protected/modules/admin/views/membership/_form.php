<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'membership-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'player_id', Player::model()->getPlayersDropDown(), array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'amount',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'date_paid',array('class'=>'span5, datepicker')); ?>

	<?php
		if(!$model->isNewRecord){
			echo $form->textFieldRow($model,'expires_on',array('class'=>'span5, datepicker'));
		}
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
