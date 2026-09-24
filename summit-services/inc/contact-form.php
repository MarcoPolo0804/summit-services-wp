<?php
/**
 * Quote / contact form.
 *
 * Elementor Free has no form widget, so the theme provides one as a shortcode:
 *   [summit_contact_form]              full form (Contact page)
 *   [summit_contact_form compact="1"]  short form (home hero, sidebars)
 *   [summit_contact_form service="Drain Cleaning"]  pre-selects a service
 *
 * Every submission is emailed AND saved under Dashboard → Leads, so nothing is
 * lost if the server can't send email.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the private "Leads" post type.
 */
function summit_register_leads() {
	register_post_type(
		'summit_lead',
		array(
			'labels'          => array(
				'name'          => __( 'Leads', 'summit' ),
				'singular_name' => __( 'Lead', 'summit' ),
				'edit_item'     => __( 'View Lead', 'summit' ),
				'search_items'  => __( 'Search Leads', 'summit' ),
				'not_found'     => __( 'No leads yet. Quote requests from your site will appear here.', 'summit' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-email-alt',
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'summit_register_leads' );

/**
 * Service options for the dropdown.
 *
 * @return string[]
 */
function summit_form_services() {
	$names = wp_list_pluck( summit_service_pages(), 'post_title' );
	if ( ! $names ) {
		$names = wp_list_pluck( summit_demo_services(), 'title' );
	}
	$names[] = __( 'Something else', 'summit' );
	return $names;
}

/**
 * Shortcode output.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function summit_contact_form_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'compact' => '0',
			'service' => '',
			'button'  => __( 'Request My Free Quote', 'summit' ),
		),
		$atts,
		'summit_contact_form'
	);

	$compact  = in_array( strtolower( (string) $atts['compact'] ), array( '1', 'yes', 'true' ), true );
	$form_id  = $compact ? 'summit-quote-compact' : 'summit-quote';
	$status   = isset( $_GET['summit_form'] ) ? sanitize_key( wp_unslash( $_GET['summit_form'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$which    = isset( $_GET['summit_fid'] ) ? sanitize_key( wp_unslash( $_GET['summit_fid'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$services = summit_form_services();
	$messages = array(
		'sent'    => array( 'success', __( 'Thank you! Your request was received. We’ll call you back shortly — usually within 15 minutes during business hours.', 'summit' ) ),
		'invalid' => array( 'error', __( 'Please enter your name and a valid phone number or email address.', 'summit' ) ),
		'expired' => array( 'error', __( 'Your session expired. Please submit the form again.', 'summit' ) ),
		'wait'    => array( 'error', __( 'You just sent a request. Please wait a minute before sending another, or give us a call.', 'summit' ) ),
	);

	ob_start();
	?>
	<div class="summit-form-wrap" id="<?php echo esc_attr( $form_id ); ?>">
		<?php if ( $which === $form_id && isset( $messages[ $status ] ) ) : ?>
			<div class="summit-form-notice summit-form-notice--<?php echo esc_attr( $messages[ $status ][0] ); ?>" role="<?php echo 'success' === $messages[ $status ][0] ? 'status' : 'alert'; ?>">
				<?php echo esc_html( $messages[ $status ][1] ); ?>
			</div>
		<?php endif; ?>

		<form class="summit-form<?php echo $compact ? ' summit-form--compact' : ''; ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="summit_contact">
			<input type="hidden" name="summit_fid" value="<?php echo esc_attr( $form_id ); ?>">
			<input type="hidden" name="summit_return" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
			<?php wp_nonce_field( 'summit_contact', 'summit_nonce' ); ?>

			<div class="summit-form__hp" aria-hidden="true">
				<label for="<?php echo esc_attr( $form_id ); ?>-website"><?php esc_html_e( 'Leave this field empty', 'summit' ); ?></label>
				<input type="text" id="<?php echo esc_attr( $form_id ); ?>-website" name="summit_website" tabindex="-1" autocomplete="off">
			</div>

			<div class="summit-form__field">
				<label for="<?php echo esc_attr( $form_id ); ?>-name"><?php esc_html_e( 'Full name', 'summit' ); ?> <span class="summit-required">*</span></label>
				<input type="text" id="<?php echo esc_attr( $form_id ); ?>-name" name="summit_name" autocomplete="name" required>
			</div>

			<div class="summit-form__field">
				<label for="<?php echo esc_attr( $form_id ); ?>-phone"><?php esc_html_e( 'Phone', 'summit' ); ?> <span class="summit-required">*</span></label>
				<input type="tel" id="<?php echo esc_attr( $form_id ); ?>-phone" name="summit_phone" autocomplete="tel" required>
			</div>

			<?php if ( ! $compact ) : ?>
				<div class="summit-form__field">
					<label for="<?php echo esc_attr( $form_id ); ?>-email"><?php esc_html_e( 'Email', 'summit' ); ?></label>
					<input type="email" id="<?php echo esc_attr( $form_id ); ?>-email" name="summit_email" autocomplete="email">
				</div>

				<div class="summit-form__field">
					<label for="<?php echo esc_attr( $form_id ); ?>-zip"><?php esc_html_e( 'ZIP code', 'summit' ); ?></label>
					<input type="text" id="<?php echo esc_attr( $form_id ); ?>-zip" name="summit_zip" autocomplete="postal-code" inputmode="numeric">
				</div>
			<?php endif; ?>

			<div class="summit-form__field summit-form__field--full">
				<label for="<?php echo esc_attr( $form_id ); ?>-service"><?php esc_html_e( 'Service needed', 'summit' ); ?></label>
				<select id="<?php echo esc_attr( $form_id ); ?>-service" name="summit_service">
					<option value=""><?php esc_html_e( 'Select a service…', 'summit' ); ?></option>
					<?php foreach ( $services as $service ) : ?>
						<option value="<?php echo esc_attr( $service ); ?>" <?php selected( $atts['service'], $service ); ?>><?php echo esc_html( $service ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php if ( ! $compact ) : ?>
				<div class="summit-form__field summit-form__field--full">
					<label for="<?php echo esc_attr( $form_id ); ?>-message"><?php esc_html_e( 'How can we help?', 'summit' ); ?></label>
					<textarea id="<?php echo esc_attr( $form_id ); ?>-message" name="summit_message" rows="5" placeholder="<?php esc_attr_e( 'Tell us a little about the problem, and the best time to reach you.', 'summit' ); ?>"></textarea>
				</div>
			<?php endif; ?>

			<div class="summit-form__submit">
				<button type="submit" class="summit-btn"><?php echo esc_html( $atts['button'] ); ?></button>
			</div>
			<p class="summit-form__note"><?php esc_html_e( 'No spam, ever. We only use your details to respond to your request.', 'summit' ); ?></p>
		</form>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'summit_contact_form', 'summit_contact_form_shortcode' );

/**
 * Handle a form submission.
 */
function summit_handle_contact() {
	$fid    = isset( $_POST['summit_fid'] ) ? sanitize_key( wp_unslash( $_POST['summit_fid'] ) ) : 'summit-quote';
	$return = isset( $_POST['summit_return'] ) ? esc_url_raw( wp_unslash( $_POST['summit_return'] ) ) : home_url( '/' );
	$return = wp_validate_redirect( $return, home_url( '/' ) );

	$redirect = static function ( $status ) use ( $return, $fid ) {
		$url = add_query_arg(
			array(
				'summit_form' => $status,
				'summit_fid'  => $fid,
			),
			$return
		);
		wp_safe_redirect( $url . '#' . $fid );
		exit;
	};

	if ( ! isset( $_POST['summit_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['summit_nonce'] ) ), 'summit_contact' ) ) {
		$redirect( 'expired' );
	}

	// Honeypot: bots fill every field. Pretend it worked.
	if ( ! empty( $_POST['summit_website'] ) ) {
		$redirect( 'sent' );
	}

	$data = array(
		'name'    => isset( $_POST['summit_name'] ) ? sanitize_text_field( wp_unslash( $_POST['summit_name'] ) ) : '',
		'phone'   => isset( $_POST['summit_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['summit_phone'] ) ) : '',
		'email'   => isset( $_POST['summit_email'] ) ? sanitize_email( wp_unslash( $_POST['summit_email'] ) ) : '',
		'zip'     => isset( $_POST['summit_zip'] ) ? sanitize_text_field( wp_unslash( $_POST['summit_zip'] ) ) : '',
		'service' => isset( $_POST['summit_service'] ) ? sanitize_text_field( wp_unslash( $_POST['summit_service'] ) ) : '',
		'message' => isset( $_POST['summit_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['summit_message'] ) ) : '',
	);

	$has_phone = strlen( preg_replace( '/\D/', '', $data['phone'] ) ) >= 7;
	if ( '' === $data['name'] || ( ! $has_phone && ! is_email( $data['email'] ) ) ) {
		$redirect( 'invalid' );
	}

	// Simple flood protection: one submission per IP per 30 seconds.
	$ip_key = 'summit_form_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	if ( get_transient( $ip_key ) ) {
		$redirect( 'wait' );
	}
	set_transient( $ip_key, 1, 30 );

	$labels = array(
		'name'    => __( 'Name', 'summit' ),
		'phone'   => __( 'Phone', 'summit' ),
		'email'   => __( 'Email', 'summit' ),
		'zip'     => __( 'ZIP', 'summit' ),
		'service' => __( 'Service', 'summit' ),
		'message' => __( 'Message', 'summit' ),
	);
	$lines  = array();
	foreach ( $labels as $key => $label ) {
		if ( '' !== $data[ $key ] ) {
			$lines[] = $label . ': ' . $data[ $key ];
		}
	}
	$lines[] = __( 'Page', 'summit' ) . ': ' . $return;
	$body    = implode( "\n", $lines );

	$title   = $data['name'] . ( $data['service'] ? ' — ' . $data['service'] : '' );
	$lead_id = wp_insert_post(
		array(
			'post_type'    => 'summit_lead',
			'post_status'  => 'private',
			'post_title'   => $title,
			'post_content' => $body,
		)
	);
	if ( $lead_id && ! is_wp_error( $lead_id ) ) {
		foreach ( $data as $key => $value ) {
			update_post_meta( $lead_id, '_summit_' . $key, $value );
		}
	}

	$to      = summit_opt( 'form_recipient' );
	$to      = is_email( $to ) ? $to : get_option( 'admin_email' );
	$headers = array();
	if ( is_email( $data['email'] ) ) {
		$headers[] = 'Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>';
	}
	/* translators: 1: site name, 2: lead title. */
	$subject = sprintf( __( '[%1$s] New quote request: %2$s', 'summit' ), wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $title );
	wp_mail( $to, $subject, $body, $headers );

	$redirect( 'sent' );
}
add_action( 'admin_post_summit_contact', 'summit_handle_contact' );
add_action( 'admin_post_nopriv_summit_contact', 'summit_handle_contact' );

/**
 * Leads list columns.
 *
 * @param array $columns Columns.
 * @return array
 */
function summit_lead_columns( $columns ) {
	return array(
		'cb'             => $columns['cb'],
		'title'          => __( 'Lead', 'summit' ),
		'summit_phone'   => __( 'Phone', 'summit' ),
		'summit_email'   => __( 'Email', 'summit' ),
		'summit_service' => __( 'Service', 'summit' ),
		'date'           => __( 'Received', 'summit' ),
	);
}
add_filter( 'manage_summit_lead_posts_columns', 'summit_lead_columns' );

/**
 * Leads list column values.
 *
 * @param string $column  Column key.
 * @param int    $post_id Lead ID.
 */
function summit_lead_column_values( $column, $post_id ) {
	$value = get_post_meta( $post_id, '_' . $column, true );
	if ( 'summit_phone' === $column && $value ) {
		printf( '<a href="tel:%1$s">%2$s</a>', esc_attr( summit_tel( $value ) ), esc_html( $value ) );
	} elseif ( 'summit_email' === $column && $value ) {
		printf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( $value ) );
	} else {
		echo esc_html( $value );
	}
}
add_action( 'manage_summit_lead_posts_custom_column', 'summit_lead_column_values', 10, 2 );
