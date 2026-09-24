<?php
/**
 * Summit Services theme functions.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

define( 'SUMMIT_VERSION', '1.0.0' );
define( 'SUMMIT_DIR', get_template_directory() );
define( 'SUMMIT_URI', get_template_directory_uri() );

require SUMMIT_DIR . '/inc/template-tags.php';
require SUMMIT_DIR . '/inc/customizer.php';
require SUMMIT_DIR . '/inc/contact-form.php';
require SUMMIT_DIR . '/inc/elementor-helpers.php';
require SUMMIT_DIR . '/inc/demo-content.php';
require SUMMIT_DIR . '/inc/demo-import.php';

/**
 * Theme setup.
 */
function summit_setup() {
	load_theme_textdomain( 'summit', SUMMIT_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 112,
			'width'       => 360,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'summit' ),
			'footer'  => __( 'Footer Quick Links', 'summit' ),
		)
	);
}
add_action( 'after_setup_theme', 'summit_setup' );

/**
 * Content width for embeds.
 */
function summit_content_width() {
	$GLOBALS['content_width'] = 1160;
}
add_action( 'after_setup_theme', 'summit_content_width', 0 );

/**
 * Front-end assets.
 */
function summit_enqueue_assets() {
	wp_enqueue_style(
		'summit-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'summit-style', get_stylesheet_uri(), array( 'summit-fonts' ), SUMMIT_VERSION );
	wp_enqueue_script( 'summit-main', SUMMIT_URI . '/assets/js/main.js', array(), SUMMIT_VERSION, true );
	wp_script_add_data( 'summit-main', 'strategy', 'defer' );
}
add_action( 'wp_enqueue_scripts', 'summit_enqueue_assets' );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function summit_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'summit_resource_hints', 10, 2 );

/**
 * Register Elementor Pro theme locations, so Pro users can replace the
 * header/footer with Theme Builder templates. Harmless with Elementor Free.
 *
 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $manager Locations manager.
 */
function summit_register_elementor_locations( $manager ) {
	$manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'summit_register_elementor_locations' );

/**
 * Admin notice when Elementor is missing.
 */
function summit_elementor_notice() {
	if ( did_action( 'elementor/loaded' ) || ! current_user_can( 'install_plugins' ) ) {
		return;
	}
	$url = admin_url( 'plugin-install.php?s=elementor&tab=search&type=term' );
	printf(
		'<div class="notice notice-warning"><p><strong>%1$s</strong> %2$s <a href="%3$s">%4$s</a></p></div>',
		esc_html__( 'Summit Services:', 'summit' ),
		esc_html__( 'this theme is designed for the free Elementor page builder.', 'summit' ),
		esc_url( $url ),
		esc_html__( 'Install Elementor', 'summit' )
	);
}
add_action( 'admin_notices', 'summit_elementor_notice' );
