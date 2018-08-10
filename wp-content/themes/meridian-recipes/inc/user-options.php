<?php

function meridian_recipes_show_extra_profile_fields( $user ) {
	
	?>

	<h3><?php esc_html_e( 'Social Profiles', 'meridian-recipes' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="meridian_recipes_twitter"><?php esc_html_e( 'Twitter', 'meridian-recipes' ); ?></label></th>
			<td>
				<input type="text" name="meridian_recipes_twitter" id="meridian_recipes_twitter" value="<?php echo esc_attr( get_the_author_meta( 'meridian_recipes_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'meridian-recipes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="meridian_recipes_facebook"><?php esc_html_e( 'Facebook', 'meridian-recipes' ); ?></label></th>
			<td>
				<input type="text" name="meridian_recipes_facebook" id="meridian_recipes_facebook" value="<?php echo esc_attr( get_the_author_meta( 'meridian_recipes_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'meridian-recipes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="meridian_recipes_instagram"><?php esc_html_e( 'Instagram', 'meridian-recipes' ); ?></label></th>
			<td>
				<input type="text" name="meridian_recipes_instagram" id="meridian_recipes_instagram" value="<?php echo esc_attr( get_the_author_meta( 'meridian_recipes_instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'meridian-recipes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="meridian_recipes_behance"><?php esc_html_e( 'Behance', 'meridian-recipes' ); ?></label></th>
			<td>
				<input type="text" name="meridian_recipes_behance" id="meridian_recipes_behance" value="<?php echo esc_attr( get_the_author_meta( 'meridian_recipes_behance', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'meridian-recipes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="meridian_recipes_dribbble"><?php esc_html_e( 'Dribbble', 'meridian-recipes' ); ?></label></th>
			<td>
				<input type="text" name="meridian_recipes_dribbble" id="meridian_recipes_dribbble" value="<?php echo esc_attr( get_the_author_meta( 'meridian_recipes_dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'meridian-recipes' ); ?></span>
			</td>
		</tr>

	</table>

	<?php

} add_action( 'show_user_profile', 'meridian_recipes_show_extra_profile_fields' ); add_action( 'edit_user_profile', 'meridian_recipes_show_extra_profile_fields' );

function meridian_recipes_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'meridian_recipes_twitter', $_POST['meridian_recipes_twitter'] );
	update_user_meta( $user_id, 'meridian_recipes_facebook', $_POST['meridian_recipes_facebook'] );
	update_user_meta( $user_id, 'meridian_recipes_instagram', $_POST['meridian_recipes_instagram'] );
	update_user_meta( $user_id, 'meridian_recipes_behance', $_POST['meridian_recipes_behance'] );
	update_user_meta( $user_id, 'meridian_recipes_dribbble', $_POST['meridian_recipes_dribbble'] );

} add_action( 'personal_options_update', 'meridian_recipes_save_extra_profile_fields' ); add_action( 'edit_user_profile_update', 'meridian_recipes_save_extra_profile_fields' );