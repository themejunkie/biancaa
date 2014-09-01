<?php if ( has_nav_menu( 'social' ) ) : // Check if there's a menu assigned to the 'social' location. ?>

	<nav id="social-navigation" class="social-navigation" role="navigation">

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container_class' => 'menu-wrapper',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-social-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => ''
			)
		); ?>

	</nav><!-- #social-navigation -->

<?php endif; // End check for menu. ?>