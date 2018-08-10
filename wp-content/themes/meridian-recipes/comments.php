<?php
	/* Password protected and not supplied */
	if ( post_password_required() ) { return; }
?>

<div id="comments" class="comments-area">

	<?php if ( shortcode_exists( 'fbcomments' ) ) : ?>
		
		<?php echo do_shortcode('[fbcomments]'); ?>
		
	<?php else : ?>

		<?php if ( have_comments() ) : ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'meridian-recipes' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'meridian-recipes' ) ); ?></div>
					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-above -->

			<?php endif; ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'callback'   => 'meridian_themes_comment_layout'
					) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'meridian-recipes' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'meridian-recipes' ) ); ?></div>
					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-below -->

			<?php endif; // Check for comment navigation. ?>

		<?php endif; // Check for have_comments(). ?>

		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<div class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'meridian-recipes' ); ?></div>
		<?php endif; ?>

		<?php
			comment_form(array(
				'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'meridian-recipes' ) . '" aria-required="true"></textarea></div>',
				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="comment-form-name col col-4"><input id="author" name="author" type=text value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name', 'meridian-recipes' ) . ' *" aria-required="true" /></div>',
					'email' => '<div class="comment-form-email col col-4"><input id="email" name="email" type=text value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email', 'meridian-recipes' ) . ' *" aria-required="true" /></div>',
					'url' => '<div class="comment-form-website col col-4 col-last"><input id="url" name="url" type=text value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website', 'meridian-recipes' ) . '" /></div>' 
				)),
			)); 
		?>

	<?php endif; ?>

</div><!-- #comments -->
