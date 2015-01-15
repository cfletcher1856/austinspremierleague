<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Upcoming Season';
    $this->page_header = 'Upcoming Season';
?>

<?php if(Yii::app()->user->hasFlash('upcomingseason')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('upcomingseason'),
    )); ?>

<?php else: ?>

<h3><center>Upcoming Season - Spring 2015</center></h3>

<h4>Registration</h4>
<p>
If you are interested in playing in the upcoming singles league, please out the form below.  Someone from the league will be in touch with you.
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'upcomingseason-form',
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

    <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

    <?php echo $form->dropDownListRow($model,'qualifier',array('No' => 'No', 'Yes' => 'Yes')); ?>

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
