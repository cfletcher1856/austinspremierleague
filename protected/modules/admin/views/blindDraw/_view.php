<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('participants')); ?>:</b>
	<?php echo CHtml::encode($data->participants); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('winner')); ?>:</b>
	<?php echo CHtml::encode($data->winner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('double_shot_winner')); ?>:</b>
	<?php echo CHtml::encode($data->double_shot_winner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('double_shot_payout')); ?>:</b>
	<?php echo CHtml::encode($data->double_shot_payout); ?>
	<br />


</div>