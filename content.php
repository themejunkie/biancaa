<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) : ?>
			<a class="img-link" href="<?php the_permalink(); ?>" rel="bookmark">
				<?php biancaa_post_thumbnail(); ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</a><!-- .img-link -->
		<?php else : ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<?php endif; ?>

		<?php if ( ! is_archive() && ! is_search() ) : ?>
			<div class="entry-byline">
				<span class="author vcard"><?php the_author_posts_link(); ?></span>
				<span class="sep">/</span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'biancaa' ), __( '1 Comment', 'biancaa' ), __( '% Comments', 'biancaa' ) ); ?></span>
				<?php endif; ?>
				<span class="sep">/</span>
				<span class="permalink"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e( 'Permalink', 'biancaa' ); ?></a></span>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<?php if ( is_home() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php endif; ?>
	
</article><!-- #post-## -->
