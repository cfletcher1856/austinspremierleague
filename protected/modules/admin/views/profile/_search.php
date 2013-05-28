<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'player_id',array('class'=>'span5')); ?>

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

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
