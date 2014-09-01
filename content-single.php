<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php biancaa_post_thumbnail(); ?>
		<?php endif; ?>

		<div class="header-content">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'biancaa' ) );
				if ( $categories_list && biancaa_categorized_blog() ) :
			?>
				<span class="cat-links">
					<?php echo $categories_list; ?>
				</span>
			<?php endif; // End if categories ?>

			<time class="entry-published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">&middot; <?php echo esc_html( get_the_date() ); ?></time>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'biancaa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-meta">

		<?php
			$tags_list = get_the_tag_list();
			if ( $tags_list ) :
		?>
			<span class="tags-links">
				<?php printf( __( 'Tagged: %1$s', 'biancaa' ), $tags_list ); ?>
			</span>
		<?php endif; // End if $tags_list ?>

		<?php edit_post_link( __( 'Edit', 'biancaa' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	
</article><!-- #post-## -->

<?php biancaa_post_author(); // Get the post author information. ?>

<?php biancaa_related_posts(); // Get the related posts. ?>