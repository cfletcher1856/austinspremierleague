<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'payment-form',
	//'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'player_id', Player::model()->getPlayersDropDown(), array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'amount',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->dropDownListRow($model,'txn_type', $model->getTransactionDropDown(), array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
