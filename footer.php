		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">

			<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

			<div class="site-info">
				<a class="powered" href="<?php echo esc_url( __( 'http://wordpress.org/', 'biancaa' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'biancaa' ), 'WordPress' ); ?></a>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'biancaa' ), 'Biancaa', '<a href="http://www.theme-junkie.com/">Theme Junkie</a>' ); ?>
			</div><!-- .site-info -->

			<?php get_template_part( 'menu', 'social' ); // Loads the menu-social.php template. ?>
	
		</div><!-- .container -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
