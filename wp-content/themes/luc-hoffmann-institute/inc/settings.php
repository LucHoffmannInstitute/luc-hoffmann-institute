<?php
/**
 * Admin settings
 */
add_action( 'admin_init', 'hoffmann_settings' );
function hoffmann_settings() {

	// handshake statements
	add_option( 'handshake' );
	add_settings_field( 'handshake', 'Handshake statements', 'hoffmann_settings_handshake', 'general' );
	register_setting( 'general', 'handshake', 'hoffmann_settings_handshake_sanitize' );

	// twitter
	add_option( 'twitter_handle' );
	add_settings_field( 'twitter_handle', 'Twitter handle', 'hoffmann_settings_twitter', 'general' );
	register_setting( 'general', 'twitter_handle', 'hoffmann_settings_twitter_sanitize' );

	// contact email
	add_option( 'contact_email' );
	add_settings_field( 'contact_email', 'Contact email', 'hoffmann_settings_contact_email', 'general' );
	register_setting( 'general', 'contact_email', 'hoffmann_settings_twitter_sanitize' );


	// linkedin account
	add_option( 'linked_in' );
	add_settings_field( 'linked_in', 'LinkedIn URL', 'hoffmann_settings_linked_in', 'general' );
	register_setting( 'general', 'linked_in', 'hoffmann_settings_twitter_sanitize' );
}

/**
 * Admin settings: handshake statements
 */
function hoffmann_settings_handshake() {
	$value = get_option( 'handshake' );

	?>
		<p>Animated handshake statement appearing at the top of the home page. Enter one sentance per line.</p>
		<textarea name="handshake" id="handshake" cols="30" rows="10" style="width: 100%;"><?php echo $value ?></textarea>
	<?php
}

/**
 * Admin settings: sanitize handshake statement
 */
function hoffmann_settings_handshake_sanitize( $input ) {
	return strip_tags( stripslashes( $input ) );
}

/**
 * Admin settings: contact email
 */
function hoffmann_settings_contact_email() {
	$value = get_option( 'contact_email' );

	?>
		<p>Contact email address</p>
		<input name="contact_email" id="contact_email" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: LinkedIn
 */
function hoffmann_settings_linked_in() {
	$value = get_option( 'linked_in' );

	?>
		<p>LinkedIn account URL</p>
		<input name="linked_in" id="linked_in" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: twitter handle
 */
function hoffmann_settings_twitter() {
	$value = get_option( 'twitter_handle' );

	?>
		<p>Twitter handle for use in the Twitter widget</p>
		<input name="twitter_handle" id="twitter_handle" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: sanitize twitter handle
 */
function hoffmann_settings_twitter_sanitize( $input ) {
	return strip_tags( stripslashes( $input ) );
}