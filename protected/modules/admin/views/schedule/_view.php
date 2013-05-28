<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('week')); ?>:</b>
	<?php echo CHtml::encode($data->week); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_player')); ?>:</b>
	<?php echo CHtml::encode($data->home_player); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_player')); ?>:</b>
	<?php echo CHtml::encode($data->away_player); ?>
	<br />


</div>