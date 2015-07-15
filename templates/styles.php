<br>

<div class="eslider-config-style">
    <div class="eslide-tab">
        <ul class="eslide-tab-header">
            <li>
                <a data-toggle="title" href="#" class="active"><?php _e('Title Settings', 'themeweave'); ?></a>
            </li>
            <li>
                <a data-toggle="content" href="#"><?php _e('Caption Settings', 'themeweave'); ?></a>
            </li>
        </ul>
        <div class="eslide-tab-body">
            <div class="eslide-tab-item" data-id="title">
                <?php 
                    $mb->the_field('title_size');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '1.1';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Font Size', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the font size of slide title in em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.5" data-max="5.1" data-step="0.1" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $mb->the_field('title_lh');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '1.7';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Line Height', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the line height of slide title in  em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.5" data-max="10.1" data-step="0.1" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $mb->the_field('title_color');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '255,255,255';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Title Color', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the color of slide title', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <input type="text" class="eslider-color" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                    </div>
                </div>

                <?php 
                    $mb->the_field('title_bg');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '0,0,0';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Title Background', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the color of slide title', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <input type="text" class="eslider-color" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                    </div>
                </div>


                <?php 
                    $mb->the_field('title_opacity');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '0.7';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Background Opacity', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the line height of slide title in  em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.01" data-max="1.00001" data-step="0.01" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="eslide-tab-item" data-id="content">
                 <?php 
                    $mb->the_field('caption_size');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '1';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Font Size', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the font size of slide title in em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.5" data-max="5.1" data-step="0.1" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $mb->the_field('caption_lh');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '1.2';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Line Height', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the line height of slide title in  em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.5" data-max="10.1" data-step="0.1" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $mb->the_field('caption_color');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '255,255,255';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Title Color', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the color of slide title', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <input type="text" class="eslider-color" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                    </div>
                </div>

                <?php 
                    $mb->the_field('caption_bg');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '0,0,0';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Title Background', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the color of slide title', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <input type="text" class="eslider-color" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                    </div>
                </div>


                <?php 
                    $mb->the_field('caption_opacity');
                    $val = ( $mb->get_the_value() ) ? $mb->get_the_value() : '0.7';
                    ?>
                <div class="eslider-field-item">
                    <div class="eslider-field-label">
                        <label><?php _e('Background Opacity', 'themeweave'); ?></label>
                        <span class="description"><?php _e('Choose the line height of slide title in  em unit', 'themeweave'); ?></span>
                    </div>
                    <div class="eslider-field-input">
                        <div class="ui-slider-wraper">
                            <div class="handler">
                                <div data-min="0.01" data-max="1.00001" data-step="0.01" class="slider-range"></div>
                            </div>
                            <div class="val">
                                <input type="text" class="eslider-ui-val" name="<?php $mb->the_name(); ?>" value="<?php echo $val; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
