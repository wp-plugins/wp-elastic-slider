
<div class="eslide-tab">
    <ul class="eslide-tab-header">
        <li>
            <a class="active" href="#" data-toggle="shortcode" ><?php _e('Shortcode', 'themeweave'); ?></a>
        </li>
        <li>
            <a href="#" data-toggle="template" ><?php _e('Template', 'themeweave'); ?></a>
        </li>
    </ul>

    <div class="eslide-tab-body">
        <div data-id="shortcode" class="eslide-tab-item">
           <?php _e('Copy & paste the shortcode directly into any WordPress post or page.', 'themeweave'); ?>
           <pre><?php echo htmlentities('[wpeslider id='.get_the_ID().']'); ?></pre>
        </div>

        <div data-id="template" class="eslide-tab-item">
            <?php _e('Copy & paste this code into a template file to include the slideshow within your theme.', 'themeweave'); ?>

            <pre><?php echo htmlentities('<?php 
    echo do_shortcode(
        "[wpeslider id='.get_the_ID().']"); 
?>'); ?></pre>
        </div>
    </div>
</div>
