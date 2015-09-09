<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav" role="navigation">
		<?php previous_post_link( '<div class="prev"><div class="dashicons dashicons-arrow-left-alt2"></div>' . __( '<strong>Previous</strong> %link', 'biancaa' ) . '</div>', '%title' ); ?>
		<?php next_post_link( '<div class="next">' . __( '<strong>Next</strong> %link', 'biancaa' ) . '<div class="dashicons dashicons-arrow-right-alt2"></div></div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(); ?>

<?php endif; // End check for type of page being viewed. ?>