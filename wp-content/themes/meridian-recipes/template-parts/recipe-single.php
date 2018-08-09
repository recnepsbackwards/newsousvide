<?php
	/* Outputs on a single recipe post page */
?>
<div class="recipe-post-single-top">

	<div class="recipe-post-single-top-item recipe-post-single-top-share" data-post-id="<?php the_ID(); ?>">
		<span class="fa fa-share-alt"></span>
		<?php echo esc_html_e( 'share', 'meridian-recipes' ); ?>
	</div><!-- .recipe-post-single-top-item recipe-post-single-top-share -->

	<div class="recipe-post-single-top-item recipe-post-single-top-cook-mode">
		<span class="fa fa-book"></span>
		<?php echo esc_html_e( 'cookmode', 'meridian-recipes' ); ?>
	</div><!-- .recipe-post-single-top-item recipe-post-single-top-cook-mode -->

	<div class="recipe-post-single-top-item recipe-post-single-top-print">
		<span class="fa fa-print"></span>
		<?php echo esc_html_e( 'print', 'meridian-recipes' ); ?>
	</div><!-- .recipe-post-single-top-item recipe-post-single-top-print -->

	<?php if ( is_user_logged_in() ) : ?>
		<?php
			$user_id = get_current_user_id();
			$user_bookmarks = get_user_meta( $user_id, 'meridian_recipes_bookmarks_recipes', true );
			$bookmarked = false;
			if ( $user_bookmarks && in_array( get_the_ID(), $user_bookmarks ) ) {
				$bookmarked = true;
			}
		?>
		<div class="recipe-post-single-top-item recipe-post-single-top-bookmark">
			<?php if ( $bookmarked ) : ?>
				<a href="#" class="bookmark-recipe-hook" data-post-id="<?php echo get_the_ID(); ?>">
					<span class="fa fa-bookmark"></span>
					<?php echo esc_html_e( 'bookmarked', 'meridian-recipes' ); ?>
				</a>
			<?php else : ?>
				<a href="#" class="bookmark-recipe-hook" data-post-id="<?php echo get_the_ID(); ?>">
					<span class="fa fa-bookmark-o"></span>
					<?php echo esc_html_e( 'bookmark', 'meridian-recipes' ); ?>
				</a>
			<?php endif; ?>
		</div><!-- .recipe-post-single-top-item recipe-post-single-top-bookmark -->
	<?php else : ?>
		<div class="recipe-post-single-top-item recipe-post-single-top-bookmark">

			<div class="recipe-post-single-bookmark-tooltip clearfix">

				<div class="recipe-post-single-bookmark-tooltip-inner">
					<div class="recipe-post-single-bookmark-tooltip-text">
						<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php esc_html_e( 'You must be logged in to bookmark', 'meridian-recipes' ); ?></a>
					</div><!-- .recipe-post-single-bookmark-tooltip-text -->
					<div class="recipe-post-single-bookmark-tooltip-action">
						<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php esc_html_e( 'Log In', 'meridian-recipes' ); ?></a>
						/
						<a href="<?php echo wp_registration_url(); ?>"><?php esc_html_e( 'Sign Up', 'meridian-recipes' ); ?></a>						
					</div><!-- .recipe-post-single-bookmark-tooltip-action -->

				</div><!-- .recipe-post-single-bookmark-tooltip-inner -->

			</div><!-- .recipe-post-single-bookmark-tooltip -->
			<a href="#">
				<span class="fa fa-bookmark-o"></span>
				<?php echo esc_html_e( 'bookmark', 'meridian-recipes' ); ?>
			</a>
		</div><!-- .recipe-post-single-top-item recipe-post-single-top-bookmark -->
	<?php endif; ?>

	<?php $recipeID = get_the_ID(); ?>

	<div class="recipe-post-single-top-item recipe-post-single-top-rate">

		<div class="recipe-post-single-rating-rate clearfix" data-post-id="<?php echo esc_attr( $recipeID ); ?>" data-rated-text="<?php esc_html_e( 'Thanks For Rating', 'meridian-recipes' ); ?>">

			<?php
			// Get ratings
			$ratings = array();
			if ( get_post_meta( $recipeID, 'meridian_recipes_ratings', true ) ) {
				$ratings = get_post_meta( $recipeID, 'meridian_recipes_ratings', true );
			}

			// User rated
			if ( is_user_logged_in() ) {
				$user_id = get_current_user_id();
				$user_rated = false;
				if ( isset( $ratings['user-' . $user_id] ) ) {
					$user_rated = true;
				} else {
					$ratings['user-' . $user_id] = 0;
				}
			}
			?>

			<div class="recipe-post-single-rating-rate-inner">
				<?php if ( ! is_user_logged_in() ) : ?>
					<div class="recipe-post-single-rating-rate-text">
						<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php esc_html_e( 'You must be logged in to rate', 'meridian-recipes' ); ?></a>
					</div><!-- .recipe-post-single-rating-rate-text -->
				<?php endif; ?>
				<div class="recipe-post-single-rating-rate-action">

					<?php if ( is_user_logged_in() ) : ?>

						<?php 
							for ( $i = 1; $i <= 5; $i++ ) {
								if ( $i <= $ratings['user-' . $user_id] ) {
									?><span class="fa fa-star-o active" data-rate="<?php echo esc_attr( $i ); ?>" data-post-id="<?php the_ID(); ?>"></span><?php
								} else {
									?><span class="fa fa-star-o" data-rate="<?php echo esc_attr( $i ); ?>" data-post-id="<?php the_ID(); ?>"></span><?php
								}
							}
						?>

					<?php else : ?>

						<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php esc_html_e( 'Log In', 'meridian-recipes' ); ?></a>
						/
						<a href="<?php echo wp_registration_url(); ?>"><?php esc_html_e( 'Sign Up', 'meridian-recipes' ); ?></a>

					<?php endif; ?>
					
				</div><!-- .recipe-post-single-rating-rate-action -->

			</div><!-- .recipe-post-single-rating-rate-inner -->

		</div><!-- .recipe-post-single-rating-rate -->

		<span class="recipe-post-single-top-rate-main">
			<?php if ( is_user_logged_in() && $user_rated ) : ?>
				<span class="fa fa-star"></span>
				<?php echo esc_html_e( 'recipe rated', 'meridian-recipes' ); ?>
			<?php else : ?>
				<span class="fa fa-star-o"></span>
				<?php echo esc_html_e( 'rate recipe', 'meridian-recipes' ); ?>
			<?php endif; ?>
		</span>
	</div><!-- .recipe-post-single-top-rate -->

</div><!-- .recipe-post-single-top -->

<div class="recipe-post-single-thumb-print">
	<?php meridian_recipes_the_post_thumbnail( 167, 167 ); ?>
</div><!-- .recipe-post-single-thumb-print -->

<div class="recipe-post-single-main">

	<h1 class="recipe-post-single-title" data-mtst-selector=".recipe-post-single-title" data-mtst-label="Recipe Single - Title" data-mtst-no-support="background,border"><?php the_title(); ?></h1>

	<div class="recipe-post-single-content" data-mtst-selector=".recipe-post-single-content" data-mtst-label="Recipe Single - Content" data-mtst-no-support="background,border">
		<?php the_content(); ?>
	</div><!-- .recipe-post-single-content -->

	<div class="recipe-post-single-meta clearfix">

		<div class="recipe-post-single-meta-item recipe-post-single-tags" data-mtst-selector=".recipe-post-single-tags a" data-mtst-label="Recipe Single - Tags">
			<?php the_terms( get_the_ID(), 'mrdt_recipes_tags', '', '', '' ); ?>
		</div><!-- .recipe-post-single-cats -->

		<?php meridian_recipes_display_rating(); ?>

		<?php if ( meridian_recipes_get_post_meta( get_the_ID(), 'servings' ) ) : ?>
			<div class="recipe-post-single-meta-item recipe-post-single-servings">
				<span class="fa fa-user"></span>
				<span class="recipe-post-meta-item-text"><?php echo meridian_recipes_get_post_meta( get_the_ID(), 'servings' ); ?></span>
			</div><!-- .recipe-post-single-servings -->
		<?php endif; ?>

		<?php if ( meridian_recipes_get_post_meta( get_the_ID(), 'preparation_time' ) ) : ?>
			<div class="recipe-post-single-meta-item recipe-post-single-time">
				<span class="fa fa-clock-o"></span>
				<span class="recipe-post-meta-item-text"><?php echo meridian_recipes_get_post_meta( get_the_ID(), 'preparation_time' ); ?></span>
			</div><!-- .recipe-post-single-time -->
		<?php endif; ?>

	</div><!-- .recipe-post-single-meta -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="recipe-post-single-thumb">
			<?php the_post_thumbnail( 'full' ); ?>
		</div><!-- .recipe-post-single-thumb -->
	<?php endif; ?>

</div><!-- .recipe-post-single-main -->

<?php 
	// Layout of ingredients/instructions
	$ing_ins_layout = meridian_recipes_get_theme_mod( 'recipe_ing_ins_layout', 'same_row' ); 
	$ing_class = 'col col-4 recipe-post-single-ingredients-container';
	$ins_class = 'col col-8 col-last recipe-post-single-instructions-container';

	// separate rows
	if ( $ing_ins_layout == 'separate_rows' ) {
		$ing_class = 'recipe-post-single-ingredients-container';
		$ins_class = 'recipe-post-single-instructions-container';
	}
?>

<div class="recipe-post-single-extra recipe-post-single-extra-layout-<?php echo esc_attr( $ing_ins_layout ); ?> clearfix" itemscope itemtype="http://schema.org/Recipe">

	<?php $ingredients = meridian_recipes_get_post_meta( get_the_ID(), 'ingredients' ); ?>
	<?php if ( $ingredients ) : ?>

		<div class="<?php echo esc_attr( $ing_class ); ?>">

			<h4 class="recipe-post-single-heading"><?php esc_html_e( 'Ingredients', 'meridian-recipes' ); ?></h4>
			<?php $ingredients = apply_filters( 'meridian_recipes_recipe_ingredients', $ingredients ); ?>
			<div class="recipe-post-single-ingredients">
				<?php foreach ( $ingredients as $ingredient ) : ?>
					<div class="recipe-post-single-ingredient" itemprop="recipeIngredient">
						<?php echo do_shortcode( $ingredient['text'] ); ?>
					</div><!-- .recipe-post-single-ingredient -->
				<?php endforeach; ?>
			</div><!-- .recipe-post-single-ingredients -->

			<?php if ( $after_ingredients_content = meridian_recipes_get_theme_mod( 'after_ingredients_content', false ) ) : ?>
				<div class="recipe-post-single-ingredients-after">
					<?php echo do_shortcode( $after_ingredients_content ); ?>
				</div><!-- .recipe-post-single-ingredients-after -->
			<?php endif; ?>

		</div><!-- .col -->

	<?php endif; ?>

	<?php $instructions = meridian_recipes_get_post_meta( get_the_ID(), 'instructions' ); ?>
	<?php if ( $instructions ) : $count = 0; ?>

		<div class="<?php echo esc_attr( $ins_class ); ?>">

			<h4 class="recipe-post-single-heading"><?php esc_html_e( 'Instructions', 'meridian-recipes' ); ?></h4>

			<?php $instructions = apply_filters( 'meridian_recipes_recipe_instructions', $instructions ); ?>
			<div class="recipe-post-single-instructions" itemprop="recipeInstructions">
				<?php foreach ( $instructions as $instruction ) : $count++; ?>
					<div class="recipe-post-single-instruction">
						<span class="recipe-post-single-instruction-num"><?php echo esc_html( $count ); ?></span>
						<div class="recipe-post-single-instruction-text">
							<?php echo do_shortcode( $instruction['text'] ); ?>
							<?php if ( isset( $instruction['image'] ) && $instruction['image'] != '' ) : ?>
								<div class="recipe-post-single-instruction-image">
									<img src="<?php echo esc_url( $instruction['image'] ); ?>" alt="" />
								</div><!-- .recipe-post-single-instruction-image -->
							<?php endif; ?>
						</div><!-- .recipe-post-single-instruction-text -->
					</div><!-- .recipe-post-single-instruction -->
				<?php endforeach; ?>
			</div><!-- .recipe-post-single-instructions -->

		</div><!-- .col -->

	<?php endif; ?>

</div><!-- .clearfix -->