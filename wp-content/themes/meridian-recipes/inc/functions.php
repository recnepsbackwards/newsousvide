<?php

/**
 * Table Of Contents
 *
 * Meridian_Recipes_Aq_resize ( Image resizing class )
 * meridian_recipes_aq_resize ( Image resizing function )
 * meridian_recipes_post_thumbnail ( Post thumbnail with resizing )
 * meridian_recipes_get_social_count ( Returns amount of social shares a page has )
 * meridian_recipes_get_theme_mod ( Returns customizer option value )
 * meridian_recipes_get_post_meta ( Returns post meta value )
 * meridian_recipes_has_slider ( Check if page has slider )
 * meridian_recipes_get_slider ( Get slider images )
 * meridian_recipes_has_page_sections ( Check if page has page sections )
 * meridian_recipes_get_page_sections ( Get page sections )
 * meridian_recipes_get_thumbnail_sizes ( Get thumbnail sizes )
 * meridian_recipes_body_class ( Add new classes to body )
 * meridian_recipes_get_attachment_alt ( Returns the alt attribute for an attachment )
 * meridian_recipes_recently_viewed_recipes
 * meridian_recipes_slug_cpt ( handles the slug for CPT )
 * meridian_recipes_slug_cat ( handles the slug for cat )
 * meridian_recipes_slug_tag ( handles the slug for tag )
 */

if( ! class_exists('Meridian_Recipes_Aq_Resize') ) {

	/**
	 * Image resizing class
	 *
	 * @since 1.0
	 */
	class Meridian_Recipes_Aq_Resize {

		/**
		 * The singleton instance
		 */
		static private $instance = null;

		/**
		 * No initialization allowed
		 */
		private function __construct() {}

		/**
		 * No cloning allowed
		 */
		private function __clone() {}

		/**
		 * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
		 */
		static public function getInstance() {
			if(self::$instance == null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Run, forest.
		 */
		public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = true ) {

			

			// Validate inputs.
			if ( ! $url || ( ! $width && ! $height ) ) return false;

			$upscale = true;

			// Caipt'n, ready to hook.
			if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

			// Define upload path & dir.
			$upload_info = wp_upload_dir();
			$upload_dir = $upload_info['basedir'];
			$upload_url = $upload_info['baseurl'];
			
			$http_prefix = "http://";
			$https_prefix = "https://";
			
			/* if the $url scheme differs from $upload_url scheme, make them match 
			   if the schemes differe, images don't show up. */
			if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
				$upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
			}
			elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
				$upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
			}
			

			// Check if $img_url is local.
			$c_local = true;
			if ( false === strpos( $url, $upload_url ) ) $c_local = false;

			// CUSTOM: If not local
			if ( ! $c_local ) {		

				$c_attachment_ID = $this->get_attachment_ID( $url );
				$c_attachment_url = wp_get_attachment_image_src( $c_attachment_ID, 'full' );
				$c_attachment_url = $c_attachment_url[0];
				$c_attachment_local_url = $this->get_local_url( $c_attachment_ID );
				$url = $c_attachment_local_url;

				// check if it already exists ( we created a resized version already so CDN should as well )
				$c_meta = wp_get_attachment_metadata( $c_attachment_ID );
				if ( $crop ) {
					$c_crop = 1;
				} else {
					$c_crop = 0;
				}
				$c_key = sprintf( 'aqsize-%dx%d-%d', $width, $height, $c_crop );
				if ( isset( $c_meta['sizes'][$c_key] ) ) {
					$img_url = wp_get_attachment_image_src( $c_attachment_ID, $c_key );
					$img_url = $img_url[0];
					return $img_url;
				}

			}

			// Define path of image.
			$rel_path = str_replace( $upload_url, '', $url );
			$img_path = $upload_dir . $rel_path;

			// Check if img path exists, and is an image indeed.
			if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

			// Get image info.
			$info = pathinfo( $img_path );
			$ext = $info['extension'];
			list( $orig_w, $orig_h ) = getimagesize( $img_path );

			// Get image size after cropping.
			$dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
			$dst_w = $dims[4];
			$dst_h = $dims[5];			

			// Return the original image only if it exactly fits the needed measures.
			if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
				$img_url = $url;
				$dst_w = $orig_w;
				$dst_h = $orig_h;
			} else {
				// Use this to check if cropped image already exists, so we can return that instead.
				$suffix = "{$dst_w}x{$dst_h}";
				$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
				$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

				if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
					// Can't resize, so return false saying that the action to do could not be processed as planned.
					return $url;
				}
				// Else check if cache exists.
				elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
					$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";

					// not local
					if ( ! $c_local ) {
						if ( $crop ) {
							$c_crop = 1;
						} else {
							$c_crop = 0;
						}
						$c_key = sprintf( 'aqsize-%dx%d-%d', $width, $height, $c_crop );
						$img_url = wp_get_attachment_image_src( $c_attachment_ID, $c_key );
						$img_url = $img_url[0];
					}

				}
				// Else, we resize the image and return the new resized image url.
				else {

					$editor = wp_get_image_editor( $img_path );

					if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
						return $url;

					$resized_file = $editor->save();

					if ( ! is_wp_error( $resized_file ) ) {
						$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
						$img_url = $upload_url . $resized_rel_path;
					} else {
						return $url;
					}

					/**
					 * Tell about the new size 
					 */
					if ( ! $c_local ) {
						$c_meta = wp_get_attachment_metadata( $c_attachment_ID );
						if ( $crop ) {
							$c_crop = 1;
						} else {
							$c_crop = 0;
						}
						$c_key = sprintf( 'aqsize-%dx%d-%d', $width, $height, $c_crop );
						$c_meta['sizes'][$c_key] = array(
							'file' => basename( $img_url ),
							'width' => $dst_w,
							'height' => $dst_h,
							'mime-type' => $c_meta['sizes']['thumbnail']['mime-type']
						);
						wp_update_attachment_metadata( $c_attachment_ID, $c_meta );
					}

				}
			}

			// Okay, leave the ship.
			if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

			// Return the output.
			if ( $single ) {
				// str return.
				$image = $img_url;
			} else {
				// array return.
				$image = array (
					0 => $img_url,
					1 => $dst_w,
					2 => $dst_h
				);
			}

			return $image;
		}

		/**
		 * Custom - get attachment ID
		 */
		function get_attachment_ID( $url = false ) {

			// if no url supplied return
			if ( ! $url ) return false;

			// get basename
			$url = basename( $url );

			// retrieves the attachment ID from the file URL
			global $wpdb;
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid LIKE '%%%s';", $url )); 
			return $attachment[0]; 

		}

		/**
		 * Custom - get image URL
		 */
		function get_local_url( $attachment_ID ) {
			
			// retrieves the local URL
			global $wpdb;
			$local_url = $wpdb->get_col($wpdb->prepare("SELECT guid FROM $wpdb->posts WHERE ID='%d';", $attachment_ID )); 
			return $local_url[0]; 
			
		}

		/**
		 * Callback to overwrite WP computing of thumbnail measures
		 */
		function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
			if ( ! $crop ) return null; // Let the wordpress default function handle this.

			// Here is the point we allow to use larger image size than the original one.
			$aspect_ratio = $orig_w / $orig_h;
			$new_w = $dest_w;
			$new_h = $dest_h;

			if ( ! $new_w ) {
				$new_w = intval( $new_h * $aspect_ratio );
			}

			if ( ! $new_h ) {
				$new_h = intval( $new_w / $aspect_ratio );
			}

			$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

			$crop_w = round( $new_w / $size_ratio );
			$crop_h = round( $new_h / $size_ratio );

			$s_x = floor( ( $orig_w - $crop_w ) / 2 );
			$s_y = floor( ( $orig_h - $crop_h ) / 2 );

			return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
		}

	}
	
}


if ( ! function_exists('meridian_recipes_aq_resize') ) {

	/**
	 * Resize an image using Meridian_Recipes_Aq_Resize Class
	 *
	 * @since 1.0
	 *
	 * @param string $url     The URL of the image
	 * @param int    $width   The new width of the image
	 * @param int    $height  The new height of the image
	 * @param bool   $crop    To crop or not to crop, the question is now
	 * @param bool   $single  If true only returns the URL, if false returns array
	 * @param bool   $upscale If image not big enough for new size should it upscale
	 * @return mixed If $single is true return new image URL, if it is false return array
	 *               Array contains 0 = URL, 1 = width, 2 = height
	 */
	function meridian_recipes_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {

		 if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {

			$args = array(
				'resize' => "$width,$height"
			);
			if ( $single == true ) {
				return jetpack_photon_url( $url, $args );
			} else {
				$image = array (
					0 => $img_url,
					1 => $width,
					2 => $height
				);
				return jetpack_photon_url( $url, $args );
			}

		} else {

			$aq_resize = Meridian_Recipes_Aq_Resize::getInstance();
			return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
			
		}

	}

}

if ( ! function_exists( 'meridian_recipes_the_post_thumbnail' ) ) {

	/**
	 * Post thumbnail with resizing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_the_post_thumbnail( $width = 500, $height = 500, $crop = true, $mobile_width = 480, $mobile_height = false ) {

		$mobile_width = 480;

		if ( get_the_ID() ) {
			
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
			$image_url = $image_url[0];
			$alt = meridian_recipes_get_attachment_alt( get_post_thumbnail_id( get_the_ID() ) ); 

			// Mobile version
			$thumb_mobile_version = '';
			if ( $mobile_height && $mobile_width > $width ) {
				$thumb_mobile_version = meridian_recipes_aq_resize( $image_url, $mobile_width, $mobile_height, $crop );
			}

			echo '<img data-mobile-version="' . esc_attr( $thumb_mobile_version ) . '" src="' . meridian_recipes_aq_resize( $image_url, $width, $height, $crop ) . '" alt="'. esc_attr( $alt ) .'" />';
		} else {
			echo '';
		}

	}

}

/**
 * Returns amount of social shares a page has
 *
 * @since 1.0
 *
 * @param int     $post_ID ID of the post/page. Default false, uses get_the_ID()
 * @param int     $refresh_in Amount of seconds for cached info to be stored. Default 3600.
 * @return array  Array containing amount of shares. Keys are fb, twitter and pinterest. 
 */
function meridian_recipes_get_social_count( $post_ID = false, $refresh_in = 3600 ) {

	// If ID nt supplied use current
	if ( $post_ID == false ) {
		$post_ID = get_the_ID();
	}	

	// Transient
	$transient_id = 'meridian_recipes__social_shares_count_' . $post_ID;

	if ( false === ( $share_info = get_transient( $transient_id ) ) ) {

		$the_url = get_permalink( $post_ID );

		// Defaults
		$share_info = array(
			'fb' => 0,
			'twitter' => 0,
			'pinterest' => 0,
			'total' => 0,
		);

		// Facebook
		$fb_get = wp_remote_get( 'https://graph.facebook.com/?id=' . $the_url );
		$fb_count = 0;
		if ( is_array( $fb_get ) ) {
			$fb_get_body = json_decode( $fb_get['body'] );
			if ( isset( $fb_get_body->shares ) ) {
				$fb_count = $fb_get_body->shares;
			} else {
				$fb_count = 0;
			}
			$share_info['fb'] = $fb_count;
		}

		// Twitter									
		$twitter_get = wp_remote_get( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $the_url );
		$twitter_count = 0;
		if ( is_array( $twitter_get ) ) {
			$twitter_get_body = json_decode( $twitter_get['body'] );
			if ( isset( $twitter_get_body->count ) ) {
				$twitter_count = $twitter_get_body->count;
			} else {
				$twitter_count = 0;
			}
			$share_info['twitter'] = $twitter_count;
		}

		// Pinterest 
		$pinterest_get = wp_remote_get( 'https://api.pinterest.com/v1/urls/count.json?url=' . $the_url );
		$pinterest_count = 0;
		if ( is_array( $pinterest_get ) ) {
			$pinterest_get_body = json_decode( preg_replace('/^receiveCount\((.*)\)$/', "\\1", $pinterest_get['body'] ) );
			if ( isset( $pinterest_get_body->count ) ) {
				$pinterest_count = $pinterest_get_body->count;
			} else {
				$pinterest_count = 0;
			}
			$share_info['pinterest'] = $pinterest_count;
		}

		$share_info['total'] = $fb_count + $twitter_count + $pinterest_count;

		// Check if there is data
		if ( isset( $share_info ) ) {
			set_transient( $transient_id, $share_info, $refresh_in );											
		} else {
			$share_info = false;
		}

	}

	// Pass the data back
	return apply_filters( 'meridian_recipes_social_count', $share_info );

}

/**
 * Returns customizer option value
 *
 * @since 1.0
 */
function meridian_recipes_get_theme_mod( $option_id, $default = '' ) {

	$return = get_theme_mod( MERIDIAN_RECIPES_CUSTOMIZER_PREPEND . $option_id, $default );
	if ( $return == '' ) { $return = $default; }

	return $return;

}

/**
 * Returns post meta value
 *
 * @since 1.0
 */
function meridian_recipes_get_post_meta( $post_id, $option_id ) {

	$option_id = '_meridian_recipes_' . $option_id;

	return get_post_meta( $post_id, $option_id , true );

}

/**
 * Check if page has slider
 *
 * @since 1.0
 */
function meridian_recipes_has_slider( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return false
	if ( ! $postID )
		return false;

	// If has images return true, otherwise false
	if ( meridian_recipes_get_post_meta( $postID, 'slider_state' ) == 'enabled' ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Get slider images
 * 
 * @since 1.0
 */
function meridian_recipes_get_slider( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return
	if ( ! $postID )
		return;

	// If post has gallery meta return true
	if ( meridian_recipes_get_post_meta( $postID, 'slider_slides' ) ) {
		
		return meridian_recipes_get_post_meta( $postID, 'slider_slides' );

	// Otherwise return false
	} else {
		return false;
	}

}

/**
 * Check if page has sections
 *
 * @since 1.0
 */
function meridian_recipes_has_page_sections( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return false
	if ( ! $postID )
		return false;

	// If has images return true, otherwise false
	if ( meridian_recipes_get_post_meta( $postID, 'home_sections' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Get page sections
 * 
 * @since 1.0
 */
function meridian_recipes_get_page_sections( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return
	if ( ! $postID )
		return;

	// If post has gallery meta return true
	if ( meridian_recipes_get_post_meta( $postID, 'home_sections' ) ) {
		
		return meridian_recipes_get_post_meta( $postID, 'home_sections' );

	// Otherwise return false
	} else {
		return false;
	}

}

/**
 * Get thumbnail sizes
 * 
 * @since 1.0
 */
function meridian_recipes_get_thumbnail_sizes( $layout = 'full_content', $columns = '4', $post_type = 'post' ) {

	// Get width
	if ( $layout == 'full_content' ) {
		if ( $columns == '12' )
			$width = 1254;
		elseif ( $columns == '6' )
			$width = 527;
		else
			$width = 527; // 341
	} elseif ( $layout == 'content_sidebar' ) {
		if ( $columns == '12' )
			$width = 712;
		elseif ( $columns == '6' )
			$width = 527; // 341
		else
			$width = 527; // 217
	}

	// Get height
	if ( $post_type == 'post' ) {
		$height = $width / 2;
	} elseif ( $post_type == 'mrdt_classes' ) {
		$height = $width / 2;
	} elseif( $post_type == 'mrdt_trainers' ) {
		$height = $width / 2;
	} else {
		$height = $width / 2;
	}

	if ( $layout == 'featured-1' ) {
		$width = 527;
		$height = 595;
	} elseif ( $layout == 'featured-2' ) {
		$width = 527;
		$height = 340;
	}

	// Crop
	$crop = true;

	return array( 
		'width' => $width, 
		'height' => $height,
		'crop' => $crop
	);

}

/**
 * Add new classes to body
 *
 * @since 1.0
 */
function meridian_recipes_body_class( $classes ) {

	// Is there are slider
	if ( meridian_recipes_has_slider() )
		$classes[] = 'has-slider';

	// pagination type
	$classes[] = 'body-pagination-type-' . meridian_recipes_get_theme_mod( 'pagination_type', 'click' );

	// sticky sidebar on single
	if ( meridian_recipes_get_theme_mod( 'sticky_sidebar_single', 'disabled' ) == 'enabled' ) {
		$classes[] = 'body-single-post-sticky-sidebar';
	}

	// Pass it back to WP
	return $classes;

} add_filter( 'body_class','meridian_recipes_body_class' );

/**
 * Returns the ALT attribute for an attachment
 *
 * @since 1.0
 *
 * @param string   $attachment_ID The ID of the attachment
 * @return string  The ALT attribute text
 */
function meridian_recipes_get_attachment_alt( $attachment_ID ) {

	// Get ALT
	$thumb_alt = trim( strip_tags( get_post_meta( $attachment_ID, '_wp_attachment_image_alt', true) ) );
	
	// No ALT supplied get attachment info
	if ( empty( $thumb_alt ) )
		$attachment = get_post( $attachment_ID );
	
	// Use caption if no ALT supplied
	if ( empty( $thumb_alt ) )
		$thumb_alt = trim(strip_tags( $attachment->post_excerpt ));
	
	// Use title if no caption supplied either
	if ( empty( $thumb_alt ) )
		$thumb_alt = trim(strip_tags( $attachment->post_title ));

	// Return ALT
	return esc_attr( $thumb_alt );

}


function meridian_recipes_get_section_info() {

	global $meridian_recipes_home_section;

	if ( $meridian_recipes_home_section['post_type'] == 'both' ) {
		$meridian_recipes_home_section['post_type'] = array( 'mrdt_recipes', 'post' );
	}

	// force "post" post_type and no recipe categories if recipes functionality disabled
	if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
		$meridian_recipes_home_section['post_type'] = 'post';	
		$meridian_recipes_home_section['recipe_categories'] = '';
	}

	// default for pagination
	if ( ! isset( $meridian_recipes_home_section['post_pagination'] ) ) {
		$meridian_recipes_home_section['post_pagination'] = 'disabled';
	}

	return $meridian_recipes_home_section;

}

function meridian_recipes_set_section_info( $value ) {

	global $meridian_recipes_home_section;
	$meridian_recipes_home_section = $value;

}

function meridian_recipes_get_post_class() {

	global $meridian_recipes_post_class;
	return $meridian_recipes_post_class;

}

function meridian_recipes_set_post_class( $value ) {

	global $meridian_recipes_post_class;
	$meridian_recipes_post_class = $value;

}

function meridian_recipes_get_thumb_sizes() {

	global $meridian_recipes_thumb_resize;
	return $meridian_recipes_thumb_resize;

}

function meridian_recipes_set_thumb_sizes( $value ) {

	global $meridian_recipes_thumb_resize;
	$meridian_recipes_thumb_resize = $value;

}

/**
 * Get post vars
 */
function meridian_recipes_get_post_vars() {
	global $meridian_recipes_post_vars;
	return $meridian_recipes_post_vars;
}

/**
 * Set post vars
 */
function meridian_recipes_set_post_vars( $value ) {
	global $meridian_recipes_post_vars;
	$meridian_recipes_post_vars = $value;
}

function meridian_recipes_recently_viewed_recipes() {

	// user no logged in, return
	if ( ! is_user_logged_in() ) 
		return;

	// not a recipe, return
	if ( ! is_singular( 'mrdt_recipes' ) )
		return;

	// user and post id
	$user_id = get_current_user_id();
	$post_id = get_the_ID();

	// current data
	$current_data = get_user_meta( $user_id, 'meridian_recipes_recently_viewed_recipes', true );

	// if no data make an empty array
	if ( ! $current_data ) {
		$new_data = array();
	} else {
		$new_data = $current_data;
	}

	// Is it already added remove it from it's position
	if ( in_array( $post_id, $new_data ) ) {
		if ( ( $key = array_search( $post_id, $new_data ) ) !== false ) {
			unset($new_data[$key]);
		}
	}
	
	// add it to the data
	array_unshift( $new_data, $post_id );

	// Update post meta
	update_user_meta( $user_id, 'meridian_recipes_recently_viewed_recipes', $new_data );

} add_action( 'wp_head', 'meridian_recipes_recently_viewed_recipes' );

function meridian_recipes_get_page_by_template( $template_name ) {
    
    global $wpdb;
	$page_ID = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value = %s", $template_name ) );
    if ( is_numeric( $page_ID ) ) {
    	return $page_ID;
    } else {
    	return false;
    }

}

/**
 * Handles slugs for CPT
 *
 * @since 1.0.1
 */
function meridian_recipes_slug_cpt( $args ) {

	// get slug
	$slug = meridian_recipes_get_theme_mod( 'slug_cpt', 'recipe-view' );

	// apply slugs
	$args['rewrite']['slug'] = $slug;

	// pass it back
	return $args;

} add_filter( 'meridian_recipes_cpt_args', 'meridian_recipes_slug_cpt' );

/**
 * Handles slugs for cats
 *
 * @since 1.0.1
 */
function meridian_recipes_slug_cat( $args ) {

	// get slug
	$slug = meridian_recipes_get_theme_mod( 'slug_cat', 'recipes-category' );

	// apply slugs
	$args['rewrite']['slug'] = $slug;

	// pass it back
	return $args;

} add_filter( 'meridian_recipes_cat_args', 'meridian_recipes_slug_cat' );

/**
 * Handles slugs for tags
 *
 * @since 1.0.1
 */
function meridian_recipes_slug_tag( $args ) {

	// get slug
	$slug = meridian_recipes_get_theme_mod( 'slug_tag', 'recipes-tag' );

	// apply slugs
	$args['rewrite']['slug'] = $slug;

	// pass it back
	return $args;

} add_filter( 'meridian_recipes_tag_args', 'meridian_recipes_slug_tag' );