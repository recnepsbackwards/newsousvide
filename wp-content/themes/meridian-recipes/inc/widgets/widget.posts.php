<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "meridian_recipes_posts_list_widget" );' ) );
class Meridian_Recipes_Posts_List_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_recipes_posts_list_widget', // Base ID
			esc_html__( 'MeridianThemes - Posts List', 'meridian-recipes' ), // Name
			array( 'description' => esc_html__( 'Show recent or popular posts.', 'meridian-recipes' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$amount = $instance['amount'];
		$type = $instance['type'];
		$post_type = $instance['post_type'];
		$style = $instance['style'];
		$blog_categories = $instance['blog_categories'];
		$recipe_categories = $instance['recipe_categories'];
		$single_behaviour = $instance['single_behaviour'];

		// if recipes func disabled switch to post post_type
		if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
			$post_type = 'post';
		}

		// Order by
		$orderby = 'date';
		if ( $type == 'popular' ) {
			$orderby = 'comment_count';
		}

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		// vars used
		$count = 0;
		$real_count = 0;
		$post_columns = 12;
		$max_columns = 12 / $post_columns;

		// query arguments
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $amount,
			'orderby' => $orderby
		);

		// blog categories
		if ( $post_type == 'post' && $blog_categories !== 'all' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $blog_categories,
				),
			);
		}

		// recipe categories
		if ( $post_type == 'mrdt_recipes' && $recipe_categories !== 'all' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'mrdt_recipes_cats',
					'field'    => 'term_id',
					'terms'    => $recipe_categories,
				),
			);
		}

		// related posts
		if ( is_singular( 'mrdt_recipes' ) && $single_behaviour == 'enabled' ) {

			$current_post_categories = wp_get_post_terms( get_the_ID(), 'mrdt_recipes_cats' );
			$current_post_cats = array();
			if ( is_array( $current_post_categories ) ) {
				foreach ( $current_post_categories as $current_post_category ) {
					$current_post_cats[] = $current_post_category->term_id;
				}
			}

			$args['post__not_in'] = array( get_the_ID() );
			$args['tax_query'][] = array(
				'taxonomy' => 'mrdt_recipes_cats',
				'field'    => 'term_id',
				'terms'    => $current_post_cats,
			);

		}

		// do the query
		$meridian_recipes_query = new WP_Query( $args );

		if ( $meridian_recipes_query->have_posts() ) :

			?>

			<div class="posts-list-widget clearfix">

				<?php if ( $style == '4' ) : ?>

					<div class="carousel-wrapper">

						<div class="carousel" data-items="1">

				<?php endif; ?>

				<?php 

					// start posts loop
					while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

						// increase counts
						$count++;
						$real_count++;

						// thumbnail sizes
						if ( $style == 6 ) {
							$thumb_width = 87;
							$thumb_height = 87;
							$mobile_thumb_height = 480;
						} elseif ( $style == 2 ) {
							$thumb_width = 394;
							$thumb_height = $thumb_width / 1.5;
							$mobile_thumb_height = 480 / 1.5;
						} else {
							$thumb_width = 394;
							$thumb_height = $thumb_width / 0.85;
							$mobile_thumb_height = 480 / 0.85;
						}

						// post class
						if ( $style == 4 ) 
							$post_class = 'carousel-item ';
						else 
							$post_class = '';

						// set post vars
						meridian_recipes_set_post_vars(array(
							'post_class' => $post_class,
							'thumb_width' => $thumb_width,
							'thumb_height' => $thumb_height,
							'mobile_thumb_height' => $mobile_thumb_height
						));

						// load template
						get_template_part( 'template-parts/listing/post-s' . $style );

					// end posts loop
					endwhile; 

				?>

				<?php if ( $style == '4' ) : ?>

						</div><!-- .carousel -->

						<?php if ( $real_count > 1 ) : ?>

							<span class="carousel-nav-prev"><span class="fa fa-angle-left"></span></span>
							<span class="carousel-nav-next"><span class="fa fa-angle-right"></span></span>

						<?php endif; ?>

					</div><!-- .carousel-wrapper -->

				<?php endif; ?>

			</div><!-- .posts-list-widget -->

			<?php

		endif;

		wp_reset_postdata();

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['blog_categories'] = strip_tags( $new_instance['blog_categories'] );
		$instance['recipe_categories'] = strip_tags( $new_instance['recipe_categories'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['single_behaviour'] = strip_tags( $new_instance['single_behaviour'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Recipe categories
		if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {
			$recipe_categories = get_terms( 'mrdt_recipes_cats' );
			$recipe_categories_options = array(
				'all' => 'All',
			);
			foreach ( $recipe_categories as $recipe_category ) {
				$recipe_categories_options[$recipe_category->term_id] = $recipe_category->name;
			}
		} else {
			$recipe_categories_options = array(
				'all' => 'All',
			);
		}

		// Blog categories
		$blog_categories = get_terms( 'category' );
		$blog_categories_options = array(
			'all' => 'All',
		);
		foreach ( $blog_categories as $blog_category ) {
			$blog_categories_options[$blog_category->term_id] = $blog_category->name;
		}

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Recent Posts';
		if ( isset( $instance[ 'amount' ] ) ) $amount = $instance[ 'amount' ]; else $amount = '4';
		if ( isset( $instance[ 'post_type' ] ) ) $post_type = $instance[ 'post_type' ]; else $post_type = 'post';
		if ( isset( $instance[ 'blog_categories' ] ) ) $blog_categories = $instance[ 'blog_categories' ]; else $blog_categories = 'all';
		if ( isset( $instance[ 'recipe_categories' ] ) ) $recipe_categories = $instance[ 'recipe_categories' ]; else $recipe_categories = 'all';
		if ( isset( $instance[ 'type' ] ) ) $type = $instance[ 'type' ]; else $type = 'recent';
		if ( isset( $instance[ 'style' ] ) ) $style = $instance[ 'style' ]; else $style = '6';
		if ( isset( $instance[ 'single_behaviour' ] ) ) $single_behaviour = $instance[ 'single_behaviour' ]; else $single_behaviour = 'disabled';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php esc_html_e( 'Amount:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p <?php if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) echo 'style="display:none;"';  ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post Type:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
				<option <?php if ( $post_type == 'post' ) echo 'selected="selected"'; ?> value="post"><?php esc_html_e( 'Blog Posts', 'meridian-recipes' ); ?></option>
				<option <?php if ( $post_type == 'mrdt_recipes' ) echo 'selected="selected"'; ?> value="mrdt_recipes"><?php esc_html_e( 'Recipes', 'meridian-recipes' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">
				<option <?php if ( $type == 'recent' ) echo 'selected="selected"'; ?> value="recent"><?php esc_html_e( 'Recent', 'meridian-recipes' ); ?></option>
				<option <?php if ( $type == 'popular' ) echo 'selected="selected"'; ?> value="popular"><?php esc_html_e( 'Popular', 'meridian-recipes' ); ?></option>
			</select>
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'blog_categories' ) ); ?>"><?php esc_html_e( 'Blog Category:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'blog_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'blog_categories' ) ); ?>">
				<?php foreach ( $blog_categories_options as $cat_id => $cat_name ) : ?>
					<option <?php if ( $blog_categories == $cat_id ) echo 'selected="selected"'; ?> value="<?php echo esc_attr( $cat_id ); ?>"><?php echo esc_html( $cat_name ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>	
		<p <?php if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) echo 'style="display:none;"';  ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'recipe_categories' ) ); ?>"><?php esc_html_e( 'Recipe Category:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'recipe_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'recipe_categories' ) ); ?>">
				<?php foreach ( $recipe_categories_options as $cat_id => $cat_name ) : ?>
					<option <?php if ( $recipe_categories == $cat_id ) echo 'selected="selected"'; ?> value="<?php echo esc_attr( $cat_id ); ?>"><?php echo esc_html( $cat_name ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option <?php if ( $style == '6' ) echo 'selected="selected"'; ?> value="6"><?php esc_html_e( 'Small', 'meridian-recipes' ); ?></option>
				<option <?php if ( $style == '2' ) echo 'selected="selected"'; ?> value="2"><?php esc_html_e( 'Big', 'meridian-recipes' ); ?></option>
				<option <?php if ( $style == '4' ) echo 'selected="selected"'; ?> value="4"><?php esc_html_e( 'Carousel', 'meridian-recipes' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'single_behaviour' ) ); ?>"><?php esc_html_e( 'Show related posts on single post pages:', 'meridian-recipes' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'single_behaviour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'single_behaviour' ) ); ?>">
				<option <?php if ( $single_behaviour == 'disabled' ) echo 'selected="selected"'; ?> value="disabled"><?php esc_html_e( 'Disabled', 'meridian-recipes' ); ?></option>
				<option <?php if ( $single_behaviour == 'enabled' ) echo 'selected="selected"'; ?> value="enabled"><?php esc_html_e( 'Enabled', 'meridian-recipes' ); ?></option>
			</select>
		</p>
		<?php 

	}

}