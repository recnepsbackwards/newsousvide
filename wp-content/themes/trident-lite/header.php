<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package trident
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php trident_sanitize_favicon(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="bl-background">
	<div id="stripe"></div>
</div>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<?php 		
					// Getting trending bar show status from database					
					$trident_enable_trending = ot_get_option('trident_enable_trending');
					if( isset( $trident_enable_trending ) && 'on' == $trident_enable_trending ) : // Chekcs if trending is enabled from theme options
				?>

					<div class="trending-ticker">
						<span class="heading">
							<?php _e( 'Trending', 'trident' ); ?>							
						</span>

						<ul id="ticker">
							<?php
								$trending_bar_post_number = ot_get_option('trending_bar_post_number');								
								if( isset( $trending_bar_post_number ) && '0' != $trending_bar_post_number ) {
									$trending_post_number = $trending_bar_post_number;
								} else{
									$trending_post_number = 4;
								}
								$trending_bar_category = ot_get_option('trending_bar_category');
								if( isset( $trending_bar_category ) ){
									$trending_cat = $trending_bar_category;
								} else {
									$trending_bar_category_id = get_cat_ID('Uncategorized');
									$featured_cat = $trending_bar_category_id;
								}
						 	?>
							<?php $query = new WP_Query("orderby=date&order=desc&cat=$trending_cat&posts_per_page=$trending_post_number"); ?>
													
							<?php while($query->have_posts()): $query->the_post(); ?>
						
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
					
							<?php endwhile; ?>
							
							<?php wp_reset_postdata(); ?>
						</ul>
					</div>

				<?php endif; // trending checker if ends here ?>
				<div class="header-logo">
					<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'qlueblog' ); ?></a>
					<a class="brand" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php bloginfo( 'name' ); ?>' rel='home'>				
					<?php if ( get_theme_mod( 'trident_logo' ) || get_theme_mod( 'trident_logo_text' ) ) : ?>
						<?php if ( 'image' == get_theme_mod( 'trident_logo_type' ) ) : ?>						
							<img src='<?php echo esc_url( get_theme_mod( 'trident_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>						
						<?php else : ?>						
							<span class="logo-text"><?php if(get_theme_mod( 'trident_logo_text')) { echo get_theme_mod( 'trident_logo_text'); } else { echo esc_attr( get_bloginfo( 'name', 'display' ) ); } ?></span>						
						<?php endif; ?>
					<?php else : ?>					
						<span><?php bloginfo( 'name' ); ?></span>					
					<?php endif; ?>				
					</a>
				</div>				
				<?php if ( !dynamic_sidebar('header-widget') ) : ?>
				<?php endif; ?>				
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<h2 class="menu-toggle">
						<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
							<span class="sr-only">
								<?php _e( 'Toggle navigation', 'trident' ); ?>								
							</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</h2>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content container">	
		<div class="row">