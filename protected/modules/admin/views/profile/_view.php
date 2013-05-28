<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('player_id')); ?>:</b>
	<?php echo CHtml::encode($data->player_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('how_long')); ?>:</b>
	<?php echo CHtml::encode($data->how_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_dart')); ?>:</b>
	<?php echo CHtml::encode($data->type_dart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('handed')); ?>:</b>
	<?php echo CHtml::encode($data->handed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_player')); ?>:</b>
	<?php echo CHtml::encode($data->fav_player); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('best_memory')); ?>:</b>
	<?php echo CHtml::encode($data->best_memory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_activity')); ?>:</b>
	<?php echo CHtml::encode($data->fav_activity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_song')); ?>:</b>
	<?php echo CHtml::encode($data->theme_song); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weirdness')); ?>:</b>
	<?php echo CHtml::encode($data->weirdness); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_movie')); ?>:</b>
	<?php echo CHtml::encode($data->fav_movie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invisible')); ?>:</b>
	<?php echo CHtml::encode($data->invisible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('great_less')); ?>:</b>
	<?php echo CHtml::encode($data->great_less); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	*/ ?>

</div>