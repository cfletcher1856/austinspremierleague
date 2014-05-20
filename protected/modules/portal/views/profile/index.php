<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        'Player Portal' => array('//portal'),
        'My Profile'
    );

    $this->page_header = "My Profile";
?>

<h1><?php echo Yii::app()->user->getName(); ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'player-form',
    //'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($player); ?>

    <?php echo $form->textFieldRow($player,'email',array('class'=>'span5','maxlength'=>120)); ?>

    <?php echo $form->textFieldRow($player,'phone',array('class'=>'span5','maxlength'=>15)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$player->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>


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

    <?php echo $form->errorSummary($profile); ?>

    <?php echo $form->textFieldRow($profile,'age',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($profile,'how_long',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($profile,'type_dart',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'handed',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'fav_player',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'best_memory',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'fav_activity',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'theme_song',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'weirdness',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($profile,'fav_movie',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'invisible',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($profile,'great_less',array('class'=>'span5')); ?>

    <?php // echo $form->labelEx($profile,'image'); ?>
    <?php // echo CHtml::activeFileField($profile, 'image'); ?>
    <?php // echo $form->error($profile,'image'); ?>

    <?php if(!$profile->isNewRecord): ?>
    <div class="row">
        <div class="span12">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/profiles/'.$profile->image,"image",array("width"=>200)); ?>
            <p>If you want a new image please send to Colin or Ryan</p>
         </div>
    </div>
    <?php endif; ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$profile->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
