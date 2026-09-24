<?php
/**
 * Business info settings (Appearance → Customize → Business Info).
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setting definitions: key => [label, default, type].
 *
 * @return array
 */
function summit_option_fields() {
	return array(
		'phone'           => array( __( 'Phone number', 'summit' ), '(512) 555-0147', 'text' ),
		'email'           => array( __( 'Email address', 'summit' ), 'hello@summitplumbingair.com', 'email' ),
		'address'         => array( __( 'Street address (also used for the Google Map)', 'summit' ), '1250 S Congress Ave, Austin, TX 78704', 'text' ),
		'hours'           => array( __( 'Office hours', 'summit' ), 'Mon–Sat: 7:00am – 7:00pm', 'text' ),
		'emergency_text'  => array( __( 'Emergency label (top bar)', 'summit' ), '24/7 Emergency Service', 'text' ),
		'service_area'    => array( __( 'Service area (top bar)', 'summit' ), 'Serving Greater Austin, TX', 'text' ),
		'header_cta_text' => array( __( 'Header button text', 'summit' ), 'Get a Free Quote', 'text' ),
		'header_cta_url'  => array( __( 'Header button link', 'summit' ), '/contact/', 'text' ),
		'footer_about'    => array( __( 'Footer about text', 'summit' ), 'Family-owned plumbing, heating and air conditioning experts serving Austin homes and businesses since 2001. Honest pricing, clean work, guaranteed.', 'textarea' ),
		'license'         => array( __( 'License / credentials line', 'summit' ), 'TX Master Plumber #M-40127 · TACLA #88214C', 'text' ),
		'facebook'        => array( __( 'Facebook URL', 'summit' ), '', 'url' ),
		'instagram'       => array( __( 'Instagram URL', 'summit' ), '', 'url' ),
		'google'          => array( __( 'Google Business Profile URL', 'summit' ), '', 'url' ),
		'form_recipient'  => array( __( 'Send quote requests to (defaults to the admin email)', 'summit' ), '', 'email' ),
	);
}

/**
 * Get a business option with its default.
 *
 * @param string $key Option key.
 * @return string
 */
function summit_opt( $key ) {
	$fields  = summit_option_fields();
	$default = isset( $fields[ $key ] ) ? $fields[ $key ][1] : '';
	return (string) get_theme_mod( 'summit_' . $key, $default );
}

/**
 * Register Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function summit_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'summit_business',
		array(
			'title'       => __( 'Business Info', 'summit' ),
			'description' => __( 'Used in the header, footer, sticky mobile call bar and contact form. Re-run the demo import to push changes into the Elementor pages.', 'summit' ),
			'priority'    => 30,
		)
	);

	$sanitizers = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'email'    => 'sanitize_email',
		'url'      => 'esc_url_raw',
	);

	foreach ( summit_option_fields() as $key => $field ) {
		list( $label, $default, $type ) = $field;
		$wp_customize->add_setting(
			'summit_' . $key,
			array(
				'default'           => $default,
				'sanitize_callback' => $sanitizers[ $type ],
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'summit_' . $key,
			array(
				'label'   => $label,
				'section' => 'summit_business',
				'type'    => $type,
			)
		);
	}
}
add_action( 'customize_register', 'summit_customize_register' );
