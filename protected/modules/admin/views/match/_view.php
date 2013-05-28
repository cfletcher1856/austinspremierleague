<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('player_id')); ?>:</b>
	<?php echo CHtml::encode($data->player_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legs_won')); ?>:</b>
	<?php echo CHtml::encode($data->legs_won); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legs_lost')); ?>:</b>
	<?php echo CHtml::encode($data->legs_lost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg_differential')); ?>:</b>
	<?php echo CHtml::encode($data->leg_differential); ?>
	<br />


</div>