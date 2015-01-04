<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">

		<div class="container">
			
			<!-- Mobile Menu. -->
			<label class="open-toggle-menu" for="toggle-menu" onclick><i class="genericon genericon-menu"></i></label>

			<div class="site-branding">
				<?php biancaa_site_branding(); ?>
			</div>

		</div><!-- .container -->

	</header><!-- #masthead -->

	<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

	<div id="content" class="site-content">

		<div class="container">

		<?php biancaa_featured_content(); // Get the featured posts. ?>

		<?php biancaa_featured_text(); // Get the featured text. ?>
