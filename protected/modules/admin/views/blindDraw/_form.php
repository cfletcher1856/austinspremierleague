<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-datepicker.js');
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'blind-draw-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'participants',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'winner',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'double_shot_winner',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'number_pulled',array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'double_shot_payout',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pot_adjustment',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
