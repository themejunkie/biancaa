<?php
/**
 * Template Name: About Template
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="about-photo">
							<?php the_post_thumbnail( 'biancaa-featured', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
						</div>
					<?php endif; ?>

					<div class="about-content">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<div class="entry-content">
							<p><?php the_author_meta( 'description' ); ?></p>
						</div><!-- .entry-content -->
						<ul class="about-social">
							<li class="twitter">
								<span class="genericon genericon-twitter"></span>
								<a href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>"><?php the_author_meta( 'twitter' ); ?></a>
							</li>
							<li class="fb">
								<span class="genericon genericon-facebook"></span>
								<a href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>"><?php the_author_meta( 'facebook' ); ?></a>
							</li>
							<li class="linkedin">
								<span class="genericon genericon-linkedin-alt"></span>
								<a href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>"><?php the_author_meta( 'linkedin' ); ?></a>
							</li>
							<li class="dribbble">
								<span class="genericon genericon-dribbble"></span>
								<a href="<?php echo esc_url( get_the_author_meta( 'dribbble' ) ); ?>"><?php the_author_meta( 'dribbble' ); ?></a>
							</li>
						</ul>
					</div>
					
				</article><!-- #post-## -->

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>