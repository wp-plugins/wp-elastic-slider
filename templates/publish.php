<p class="meta-save"></p>

<div class="misc-pub-section curtime misc-pub-curtime">
	<span id="timestamp">
		<?php if ( get_post_status( get_the_ID() ) == 'publish' ) : ?>
			<?php printf( __( 'Published on: <b>%s</b>', 'themeweave' ), date( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ); ?>
		<?php else : ?>
			<?php _e( 'Not published yet.', 'themeweave' ); ?>
		<?php endif; ?>
	</span>
</div>

<div id="major-publishing-actions">
	<div id="publishing-action">
		<span class="spinner"></span>
		<input type="submit" accesskey="p" value="<?php _e('Publish', 'themeweave'); ?>" class="button button-primary button-large" id="publish" name="publish">
	</div>
	<div class="clear"></div>
</div>