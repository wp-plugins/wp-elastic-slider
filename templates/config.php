<?php $mb->the_field('animation'); ?>

<div class="eslider-config">
	<label><?php _e('Slide Animation', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Choose the animation type', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<option <?php if ( $mb->get_the_value() == 'slide' ) echo "selected='selected'";  ?> value="slides"><?php _e('Slide'); ?></option>
		<option <?php if ( $mb->get_the_value() == 'center' ) echo "selected='selected'";  ?> value="center"><?php _e('Center'); ?></option>
	</select>
</div>


<?php $mb->the_field('autoplay'); ?>

<div class="eslider-config">
	<label><?php _e('Autoplay', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('If true the slider will automatically slide, and it will only stop if the user clicks on a thumb', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<option <?php if ( $mb->get_the_value() == 'true' ) echo "selected='selected'";  ?> value="true"><?php _e('True'); ?></option>
		<option <?php if ( $mb->get_the_value() == 'false' ) echo "selected='selected'";  ?> value="false"><?php _e('False'); ?></option>
	</select>
</div>



<?php 
	$mb->the_field('interval');
	$selected = ( $mb->get_the_value() ) ? $mb->get_the_value() : 3000;
?> 

<div class="eslider-config">
	<label><?php _e('Slideshow Interval', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Speed for the sliding animation', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<?php foreach ( range(500, 10000, 500) as $val ) : ?>
		<option <?php if ( $selected == $val ) echo "selected='selected'";  ?> value="<?php echo $val; ?>"><?php echo $val; ?></option>
	    <?php endforeach; ?>
	</select>
</div>


<?php 
	$mb->the_field('titlespeed');
	$selected = ( $mb->get_the_value() ) ? $mb->get_the_value() : 800;
?> 

<div class="eslider-config">
	<label><?php _e('Title Speed', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Titles animation speed', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<?php foreach (	range(100,3000, 100) as $val ) : ?>
		<option <?php if ( $selected == $val ) echo "selected='selected'";  ?> value="<?php echo $val; ?>"><?php echo $val; ?></option>
	    <?php endforeach; ?>
	</select>
</div>



<?php $mb->the_field('easing'); ?>

<div class="eslider-config">
	<label><?php _e('Background Easing', 'themeweave'); ?></label> 
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Easing for the background image slide', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<?php foreach ( WpElasticSlider::easing() as $key => $val ) : ?>
		<option <?php if ( $mb->get_the_value() == $key ) echo "selected='selected'";  ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
	    <?php endforeach; ?>
	</select>
</div>


<?php $mb->the_field('titleeasing'); ?> 

<div class="eslider-config">
	<label><?php _e('Title Easing', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Easing for the title and caption', 'themeweave'); ?>" ></span>
	<select name="<?php $mb->the_name(); ?>" >
		<?php foreach ( WpElasticSlider::easing() as $key => $val ) : ?>
		<option <?php if ( $mb->get_the_value() == $key ) echo "selected='selected'";  ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
	    <?php endforeach; ?>
	</select>
</div>


<?php
	$mb->the_field('thumb');
	$width = preg_replace("/[^0-9]+/", "", $mb->get_the_value() );
	$width = ( !empty( $width )) ? $width : 150;
?>
 
<div class="eslider-config">
	<label><?php _e('Thumb Max Width', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Maximum width of slider thumbnail', 'themeweave'); ?>" ></span>
	<input type="text" class="eslide-text" name="<?php $mb->the_name(); ?>" value="<?php echo $width; ?>" >
</div>


<?php
	$mb->the_field('height');
	$width = preg_replace("/[^0-9]+/", "", $mb->get_the_value() );
	$width = ( !empty( $width )) ? $width : 400;
?>
 
<div class="eslider-config">
	<label><?php _e('Slider Height', 'themeweave'); ?></label>
	<span class="helper dashicons dashicons-info" original-title="<?php _e('Set the height of the slider', 'themeweave'); ?>" ></span>
	<input type="text" class="eslide-text" name="<?php $mb->the_name(); ?>" value="<?php echo $width; ?>" >
</div>