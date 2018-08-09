<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<!-- Meta -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Link -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- WP Head -->
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	<?php 

		$header_class = 'site-header ';
		$featured = false;

		// If page
		if ( is_page() ) {

			// Page ID
			$pageID = get_the_ID();

			// Get value of featured option
			$featured_type = meridian_recipes_get_post_meta( get_the_ID(), 'featured_type' );

			// If set and not disabled
			if ( $featured_type && $featured_type !== 'disabled' ) {
				$featured = true;
			}

			if ( $featured && $featured_type == '2' ) {
				$header_class .= 'header-absolute';
			}

		}			
	?>

	<div id="page" class="site">

		<header id="header" class="<?php echo esc_attr( $header_class ); ?>">

			<?php if ( $featured && $featured_type == '2' ) : ?>
				<?php get_template_part( 'template-parts/header/featured-2' ); // powered by template-parts/header/featured-2.php ?>
			<?php endif; ?>

			<div id="header-inner">

				<div id="header-main">

					<div class="wrapper clearfix">

						<?php get_template_part( 'template-parts/header/main-left' ); // powered by template-parts/header/left.php ?>

						<?php get_template_part( 'template-parts/header/main-middle' ); // powered by template-parts/header/middle.php ?>

						<?php get_template_part( 'template-parts/header/main-right' ); // powered by template-parts/header/right.php ?>

					</div><!-- .wrapper -->

				</div><!-- #header-main -->

				<?php get_template_part( 'template-parts/header/navigation' ); // powered by template-parts/header/navigation.php ?>

				<?php get_template_part( 'template-parts/header/navigation-mobile' ); // powered by template-parts/header/navigation-mobile.php ?>

			</div><!-- #header-inner -->
				
		</header><!-- #header -->

		<?php 
			// If featured
			if ( $featured && $featured_type !== '2' ) {
				get_template_part( 'template-parts/header/featured-' . $featured_type ); // powered by template-parts/header/featured-(type).php
			}			
		?>

		<?php 
			if ( is_singular( array( 'mrdt_recipes', 'post' ) ) || is_archive() || is_search() || is_page_template( 'template-user-profile.php' ) ) {
				get_template_part( 'template-parts/header/posts' ); 
			}
		?>

		<div id="main" class="site-content">