<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>
	
	<input id="toggle-menu" type="checkbox">

	<nav id="primary-navigation" class="main-navigation" role="navigation">

		<div class="container">
			
			<!-- Mobile menu. -->
			<label class="close-toggle-menu" for="toggle-menu" onclick><i class="genericon genericon-close"></i><?php _e( 'Close', 'biancaa' ); ?></label>

			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'biancaa' ); ?></a>

			<?php wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'menu-wrapper',
					'menu_id'         => 'menu-primary-items',
					'menu_class'      => 'menu-primary-items sf-menu',
					'fallback_cb'     => ''
				)
			); ?>

		</div><!-- .container -->

	</nav><!-- #primary-navigation -->

<?php endif; // End check for menu. ?>