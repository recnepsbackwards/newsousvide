<?php
/**
 * Welcome Page Class
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Activation Hook
 */
function meridian_recipes_on_activation() {
	set_transient( '_meridian_recipes_activation_redirect_1', true, 60 );
} add_action( 'after_switch_theme', 'meridian_recipes_on_activation' );

/**
 * Process activation
 */
function meridian_recipes_process_activation( $data = array() ) {

	$username = $data['username'];
	$email = $data['email'];
	$theme = $data['theme'];
	$newsletter = $data['newsletter'];

	$message = "Username: $username\r\n
	Email: $email\r\n
	Theme: $theme\r\n
	Newsletter: $newsletter";

	wp_mail( 'meridianthemes@gmail.com', 'Activation for ' . $theme, $message );

}

/**
 * Meridian_Recipes_Welcome Class
 *
 * @since 1.0
 */
class Meridian_Recipes_Welcome {

	public $minimum_capability = 'manage_options';

	/**
	 * Get things started
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome'    ) );
	}

	/**
	 * Register dashboard pages
	 *
	 * @since 1.0
	 */
	public function admin_menus() {

		// Getting Started Page
		add_theme_page(
			esc_html__( 'Getting started with Florentine', 'meridian-recipes' ),
			esc_html__( 'Theme Welcome', 'meridian-recipes' ),
			$this->minimum_capability,
			'meridian-recipes-getting-started',
			array( $this, 'getting_started_screen' )
		);

	}

	/**
	 * Hide dashboard pages and add some CSS
	 *
	 * @since 1.0
	 */
	public function admin_head() {
		
		?>
		<style type="text/css" media="screen">
		/*<![CDATA[*/

		.mt-welcome .feature-section {
			margin-bottom: 0;
			padding-bottom: 0;
		}

		.about-wrap .feature-section p {
			margin-left: 0;
		}

		.mt-welcome * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		.mt-welcome .changelog h3 {
			margin-bottom: 5px;
		}

		.mt-welcome-form {
			width: 100%;
			background: #fff;
			padding: 20px;
			border: 1px solid #ccc;
		}

			.mt-welcome .changelog {
				float: left;
				width: 50%;
				padding-right: 50px;
			}

				.mt-welcome-form-errors {
					font-size: 12px;
					border: 1px dashed #d24d4d; 
					padding: 10px;
					margin-bottom: 15px;
				}

					.mt-welcome-form-errors ul {
						margin: 0;
					}

				.mt-welcome-form-success {
					font-size: 12px;
					border: 1px dashed #4dd282; 
					padding: 10px;
				}

				.mt-welcome-form-row {
					margin-bottom: 15px;
				}

					.mt-welcome-form-row input[type="text"],
					.mt-welcome-form-row input[type="email"] {
						width: 100%;
					}

		/*]]>*/
		</style>
		<?php
	}

	/**
	 * Navigation
	 *
	 * @since 1.0
	 */
	public function tabs() {

		$selected = isset( $_GET['page'] ) ? $_GET['page'] : 'meridian-recipes-about';
		?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $selected == 'meridian-recipes-getting-started' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'meridian-recipes-getting-started' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Welcome', 'meridian-recipes' ); ?>
			</a>
		</h2>
		<?php

	}

	/**
	 * Getting started page
	 *
	 * @since 1.0
	 */
	public function getting_started_screen() {

		$slug = basename( get_template_directory() );
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$errors = get_option( strtolower( $slug ) . '_wup_errors' );
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

		?>
		<div class="wrap about-wrap mt-welcome">

			<h1><?php printf( esc_html__( 'Welcome to Florentine %s', 'meridian-recipes' ), MERIDIAN_RECIPES_THEME_VER ); ?></h1>

			<div class="about-text"><?php esc_html_e( 'Thank you for using Florentine! We hope you will enjoy it and build awesome stuff with it.', 'meridian-recipes' ); ?></div>

			<?php $this->tabs(); ?>

			<div class="changelog">

				<h3><?php esc_html_e( 'Theme Updates', 'meridian-recipes' );?></h3>

				<div class="feature-section">

					<p>To enable dashboard updates for the theme please fill in the form below. If you are not sure what your purchase code is please go to <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">help.market.envato.com</a> for more information.</p>

					<div class="mt-welcome-form">
						<?php if ( $errors ) : ?>
							<div class="mt-welcome-form-errors">
								<ul>
									<?php foreach ( $errors as $error ) : ?>
										<li><?php echo wp_kses_post( $error ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div><!-- .mt-welcome-form-errors -->
						<?php endif; ?>
						<?php if ( ! $errors && $purchase_code ) : ?>
							<div class="mt-welcome-form-success">
								You have succesfuly enabled dashboard updates.
							</div><!-- .mt-welcome-form-success -->
						<?php else : ?>
							<form method="post" action="">
								<input type="hidden" name="wupdates_pc_theme" value="<?php echo esc_attr( $slug ); ?>" />
								<div class="mt-welcome-form-row">
									<input type="text" name="wupdates_custom_username" placeholder="Envato Username" required />
								</div><!-- .mt-welcome-form-row -->
								<div class="mt-welcome-form-row">
									<input type="email" name="wupdates_custom_email" placeholder="Email Address" required />
								</div><!-- .mt-welcome-form-row -->
								<div class="mt-welcome-form-row">
									<input type="text" placeholder="Purchase Code" name="<?php echo esc_attr( $purchase_code_key ); ?>" required />
								</div><!-- .mt-welcome-form-row -->
								<div class="mt-welcome-form-row">
									<input type="checkbox" name="wupdates_custom_newsletter" checked /> <small>Subscribe to Newsletter</small>
								</div><!-- .mt-welcome-form-row -->
								<div class="mt-welcome-form-row">
									<input type="submit" value="Submit" class="button button-primary button-large" />
								</div><!-- .mt-welcome-form-row -->
							</form>
						<?php endif; ?>
					</div><!-- .mt-welcome-form -->

				</div><!-- .feature-section -->

			</div><!-- .changelog -->

			<div class="changelog">

				<h3><?php esc_html_e( 'Documentation', 'meridian-recipes' );?></h3>

				<div class="feature-section">

					<p>The documentation can be found in the package you downloaded from Themeforest, in the directory called Documentation. But it is also available online, you can access it at <a target="_blank" href="http://meridianthemes.net/docs/florentine/index.html" taget="_blank">meridianthemes.net/docs/florentine</a></p>

				</div><!-- .feature-section -->

				<h3><?php esc_html_e( 'Support', 'meridian-recipes' );?></h3>

				<div class="feature-section">

					<p>If you have any questions about the theme or run into any issues using it, please submit a support request at <a target="_blank" href="https://meridianthemes.ticksy.com/">meridianthemes.ticksy.com</a>. Support requests will be answered within 24 hours on weekdays ( Monday - Friday ) and we'll do our very best to assist on weekends as well.</p>

				</div><!-- .feature-section -->

				<h3><?php esc_html_e( 'Changelog', 'meridian-recipes' );?></h3>

				<div class="feature-section">

					<p>More information about the changes in the different versions of the theme can be found at <a target="_blank" href="https://meridianthemes.ticksy.com/articles/100004311">meridianthemes.ticky.com/articles</a></p>

				</div><!-- .feature-section -->

			</div><!-- .changelog -->

		</div>
		<?php
	}

	/**
	 * Redirect the user to the welcome screen
	 *
	 * @since 1.0
	 */
	public function welcome() {

		// Bail if no activation redirect
		if ( ! get_transient( '_meridian_recipes_activation_redirect_1' ) )
			return;

		// Delete the redirect transient
		delete_transient( '_meridian_recipes_activation_redirect_1' );

		// Bail if activating from network, or bulk
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) )
			return;

		wp_safe_redirect( admin_url( 'themes.php?page=meridian-recipes-getting-started' ) ); exit;

	}

}

new Meridian_Recipes_Welcome();
