<p><a href="#" class="docopy-slides button"><span class="icon add"></span><?php _e( 'Add New Slide', 'themeweave' );?></a></p> 

 <div class="eslide-list">
    <?php while( $mb->have_fields_and_multi( 'slides' ) ): ?>
    <?php $mb->the_group_open(); ?>

   <div class="eslide-item"> 
        <div class="slide-preview">
            <?php
                $mb->the_field('image'); 
                $img =  wp_get_attachment_image_src(  $mb->get_the_value()  );
                $style = isset( $img[0] ) ? 'style="background-image: url('.$img[0].')"' : '';
            ?>
            <div class="thumb" <?php echo $style; ?> >
                <div class="ovl">
                    <a title="<?php _e('Delete slide', 'themeweave'); ?>" class="eslide-delete dodelete dashicons dashicons-trash" href=""></a>
                    <a href="#" data-title="<?php _e('Upload Image', 'themeweave'); ?>" data-text="<?php _e('Insert Slide', 'themeweave'); ?>" class="eslide-upload-media dashicons dashicons-admin-media"></a>
                    <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value(); ?>" >
                </div>
            </div> 
        </div>

        <div class="eslide-item-content">
            <div class="eslide-tab">
                <ul class="eslide-tab-header">
                    <li>
                        <a class="active" href="#" data-toggle="slide" ><?php _e('Slide', 'themeweave'); ?></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="seo" ><?php _e('Seo', 'themeweave'); ?></a>
                    </li>
                </ul>

                <div class="eslide-tab-body">
                    <div data-id="slide" class="eslide-tab-item">
                        <?php $mb->the_field('title'); ?>
                            <input class="eslide-text" type="text" placeholder="<?php _e('Title', 'themeweave'); ?>" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value(); ?>" >

                        <?php $mb->the_field('caption'); ?>
                            <textarea class="eslide-text" rows="3" placeholder="<?php _e('Caption', 'themeweave'); ?>" name="<?php $mb->the_name(); ?>" rows="3"><?php echo $mb->get_the_value(); ?></textarea>
             
                    </div>

                    <div data-id="seo" class="eslide-tab-item">
                        <?php $mb->the_field('seo_title'); ?>
                            <input class="eslide-text" type="text" placeholder="<?php _e('Image Title', 'themeweave'); ?>" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value(); ?>" >

                        <?php $mb->the_field('alt'); ?>
                            <input class="eslide-text" type="text" placeholder="<?php _e('Image Alt', 'themeweave'); ?>" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value(); ?>" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>

</div><!-- .list -->