<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'profile-form',
	//'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'age',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'how_long',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'type_dart',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'handed',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fav_player',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'best_memory',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fav_activity',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'theme_song',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'weirdness',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fav_movie',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'invisible',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'great_less',array('class'=>'span5')); ?>

	<?php echo $form->labelEx($model,'image'); ?>
    <?php echo CHtml::activeFileField($model, 'image'); ?>
    <?php echo $form->error($model,'image'); ?>

	<?php if(!$model->isNewRecord): ?>
	<div class="row">
		<div class="span12">
	     	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/profiles/'.$model->image,"image",array("width"=>200)); ?>
	     </div>
	</div>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
