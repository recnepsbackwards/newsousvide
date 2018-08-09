<div id="header-middle">

	<?php
		// default logo image
		$logo_img_default = get_template_directory_uri() . '/images/logo.png';

		// user defined logo image
		$logo_img_src = meridian_recipes_get_theme_mod( 'logo', $logo_img_default );
		$logo_img_retina_src = meridian_recipes_get_theme_mod( 'logo_retina', '' );

		// logo image class
		$logo_img_class = '';
		if ( $logo_img_retina_src !== '' ) {
			$logo_img_class = 'has-retina-ver';
		}
			
		// if a page
		if ( is_singular( 'page' ) ) {
			$custom_logo_img_src = meridian_recipes_get_post_meta( get_the_ID(), 'custom_logo' ); 
			$custom_logo_img_retina_src = meridian_recipes_get_post_meta( get_the_ID(), 'custom_logo_retina' ); 
			if ( $custom_logo_img_src ) {
				$logo_img_src = $custom_logo_img_src;
			}
			if ( $custom_logo_img_retina_src ) {
				$logo_img_retina_src = $custom_logo_img_retina_src;
			}
				
		}

		// apply filters for logo src
		$logo_img_src = apply_filters( 'meridian_recipes_logo_src', $logo_img_src );
	?>

	<div id="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="<?php echo esc_attr( $logo_img_class );?>" src="<?php echo esc_attr( $logo_img_src ); ?>" data-retina-ver="<?php echo esc_attr( $logo_img_retina_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
	</div><!-- #logo -->

</div><!-- #header-middle -->