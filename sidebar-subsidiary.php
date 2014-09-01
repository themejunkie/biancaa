<?php if ( is_active_sidebar( 'subsidiary' ) ) : // Check, if subsidiary sidebar at least has one widget ?>
	<div id="subsidiary-sidebar" class="widget-subsidiary">
		<?php dynamic_sidebar( 'subsidiary' ); ?>
	</div><!-- #subsidiary-sidebar -->
<?php endif; ?>
