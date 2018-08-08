<?php

/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'trident_theme_options' );


/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function trident_theme_options() {  
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'option_types_help',
          'title'     => __( 'Option Types', 'trident' ),
          'content'   => '<p>' . __( 'Help content goes here!', 'trident' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'trident' ) . '</p>'
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_settings',
        'title'       => __( 'General', 'trident' )
      ),
      array(
        'id'          => 'header_settings',
        'title'       => __( 'Header', 'trident' )
      ),
      array(
        'id'          => 'advanced_settings',
        'title'       => __( 'Advanced', 'trident' )
      ),
      array(
        'id'          => 'support',
        'title'       => __( 'Support', 'trident' )
      ),
      array(
        'id'          => 'donate',
        'title'       => __( 'Donate', 'trident' )
      )
    ),
    'settings'        => array(             
      array(
        'id'          => 'trident_excerpt_length',
        'label'       => __( 'Set excerpt length', 'trident' ),
        'desc'        => __( 'Set the length of excerpt in characters here', 'trident' ),
        'std'         => '120',
        'type'        => 'text',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_enable_comment',
        'label'       => __( 'Enable Comments on Pages', 'trident' ),
        'desc'        => __( '', 'trident' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_enable_featured_posts',
        'label'       => __( 'Enable Featured Posts', 'trident' ),
        'desc'        => sprintf( __( '%1$s Note: You will get an error if you enabled Featured Posts but have not specified the category below. The specified category should have at least 3 posts with featured images.%2$s', 'trident' ), '<span style="color: grey; font-style: italic;" >', '</span>' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_featured_posts_category',
        'label'       => __( 'Select Category for Featured Posts', 'trident' ),
        'desc'        => __( '', 'trident' ),
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_custom_favicon',
        'label'       => __( 'Upload favicon', 'trident' ),
        'desc'        => __( 'Upload a favicon for your website. The favicon should be a .ico file.', 'trident' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_enable_trending',
        'label'       => __( 'Enable Trending Bar', 'trident' ),
        'desc'        => sprintf( __( '%1$sNote: You will get an error if you turned ON the trident bar but have not specified the category below.%2$s', 'trident' ), '<span style="color: grey; font-style: italic;" >', '</span>' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'header_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trending_bar_category',
        'label'       => __( 'Select Category for the Trending Bar', 'trident' ),
        'desc'        => __( 'Select the category you want to display in the Trending Bar.', 'trident' ),
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'header_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trending_bar_post_number',
        'label'       => __( 'Set number of posts', 'trident' ),
        'desc'        => __( 'Set the number of posts to show in the Trending Bar.', 'trident' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => __( 'Add custom CSS', 'trident' ),
        'id'          => 'custom_css',
        'type'        => 'textarea-simple',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'advanced_settings'
      ),
      array(
        'id'          => 'trident_ot_support',
        'label'       => __( 'Support', 'trident' ),        
        'desc'        => sprintf( __( 'If you are facing any problems in using the theme, feel free to ask in %1$s. You can also browse the %2$s. %3$s For a live demo of the theme visit %4$s.', 'trident' ), '<a href="http://support.qlue.co/forums/" target="_blank">our forum.</a>', '<a href="http://docs.qlue.co/category/trident-lite/">Knowledge Base</a>', '<br /><br />', '<a href="http://themes.qlue.co/trident/" target="_blank">this link</a>' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'support',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'trident_ot_donate',
        'label'       => __( 'Donate', 'trident' ),        
        'desc'        => sprintf( __( '%1$s and help us to create more awesome free WordPress themes.', 'trident' ), '<a href="http://blog.qlue.co/donate/" target="_blank">Donate</a>' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'donate',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
}