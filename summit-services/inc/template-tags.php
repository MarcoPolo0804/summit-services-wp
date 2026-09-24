<?php
/**
 * Template helpers used by header.php, footer.php and page templates.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon.
 *
 * @param string $name  Icon name.
 * @param string $class Extra CSS class.
 * @return string
 */
function summit_icon( $name, $class = '' ) {
	$paths = array(
		'phone'     => '<path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/>',
		'clock'     => '<path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>',
		'mail'      => '<path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5z"/>',
		'pin'       => '<path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/>',
		'menu'      => '<path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/>',
		'close'     => '<path d="M19 6.4 17.6 5 12 10.6 6.4 5 5 6.4 10.6 12 5 17.6 6.4 19l5.6-5.6 5.6 5.6 1.4-1.4-5.6-5.6z"/>',
		'wrench'    => '<path d="M22.7 19.3 13.6 10.2a6 6 0 0 0-7.9-7.8l3.9 3.9-2.8 2.8-4-3.9a6 6 0 0 0 7.9 7.9l9.1 9.1a1 1 0 0 0 1.4 0l1.5-1.5a1 1 0 0 0 0-1.4z"/>',
		'shield'    => '<path d="M12 2 4 5v6c0 5.5 3.4 10.7 8 12 4.6-1.3 8-6.5 8-12V5zm-1.2 14.2-3.5-3.5 1.4-1.4 2.1 2.1 4.9-4.9 1.4 1.4z"/>',
		'quote'     => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zm-1 7V3.5L18.5 9zM8 13h8v2H8zm0 4h8v2H8z"/>',
		'facebook'  => '<path d="M14 13.5h2.5l1-4H14v-2c0-1 0-2 2-2h1.5V2.1C17.2 2.1 16 2 14.6 2 11.7 2 10 3.7 10 6.8v2.7H7v4h3V22h4z"/>',
		'instagram' => '<path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 8.2a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4zM17.2 5.6a1.2 1.2 0 1 0 0 2.4 1.2 1.2 0 0 0 0-2.4zM21.9 7.1c-.1-1.6-.4-3-1.6-4.1-1.1-1.2-2.6-1.5-4.1-1.6C14.6 1.3 9.4 1.3 7.8 1.4c-1.6.1-3 .4-4.1 1.6C2.5 4.1 2.2 5.5 2.1 7.1 2 8.7 2 13.9 2.1 15.5c.1 1.6.4 3 1.6 4.1 1.2 1.2 2.5 1.5 4.1 1.6 1.6.1 6.8.1 8.4 0 1.6-.1 3-.4 4.1-1.6 1.2-1.1 1.5-2.5 1.6-4.1.1-1.6.1-6.8 0-8.4zm-2.1 10.6a3.3 3.3 0 0 1-1.9 1.9c-1.3.5-4.4.4-5.9.4s-4.6.1-5.9-.4a3.3 3.3 0 0 1-1.9-1.9c-.5-1.3-.4-4.4-.4-5.8s-.1-4.6.4-5.9A3.3 3.3 0 0 1 6.1 4.1C7.4 3.6 10.5 3.7 12 3.7s4.6-.1 5.9.4a3.3 3.3 0 0 1 1.9 1.9c.5 1.3.4 4.4.4 5.9s.1 4.5-.4 5.8z"/>',
		'google'    => '<path d="M21.6 10.2H12v3.9h5.5c-.5 2.5-2.6 3.9-5.5 3.9a6 6 0 0 1 0-12c1.5 0 2.8.5 3.8 1.4l2.9-2.9A10 10 0 1 0 12 22c5 0 9.6-3.6 9.6-10 0-.6-.1-1.2-.2-1.8z"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="summit-icon %1$s" viewBox="0 0 24 24" aria-hidden="true" focusable="false">%2$s</svg>',
		esc_attr( $class ),
		$paths[ $name ]
	);
}

/**
 * Turn a display phone number into a tel: friendly string.
 *
 * @param string $phone Phone number as displayed.
 * @return string
 */
function summit_tel( $phone ) {
	return preg_replace( '/[^0-9+]/', '', (string) $phone );
}

/**
 * Print the site logo, or a text logo when no custom logo is set.
 */
function summit_brand() {
	if ( has_custom_logo() ) {
		echo '<div class="summit-brand">' . get_custom_logo() . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- core markup.
		return;
	}
	$description = get_bloginfo( 'description', 'display' );
	?>
	<a class="summit-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<span class="summit-brand__mark"><?php echo summit_icon( 'wrench' ); // phpcs:ignore ?></span>
		<span class="summit-brand__text">
			<span class="summit-brand__name"><?php bloginfo( 'name' ); ?></span>
			<?php if ( $description ) : ?>
				<span class="summit-brand__tagline"><?php echo esc_html( $description ); ?></span>
			<?php endif; ?>
		</span>
	</a>
	<?php
}

/**
 * Menu fallback: list top-level pages when no menu is assigned yet.
 */
function summit_menu_fallback() {
	echo '<ul class="summit-nav__menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 2,
		)
	);
	echo '</ul>';
}

/**
 * Child pages of the Services page (set by the demo importer).
 *
 * @return WP_Post[]
 */
function summit_service_pages() {
	$parent = (int) get_option( 'summit_services_page_id' );
	if ( ! $parent || ! get_post( $parent ) ) {
		return array();
	}
	return get_pages(
		array(
			'parent'      => $parent,
			'sort_column' => 'menu_order,post_title',
		)
	);
}

/**
 * URL of the page with the quote form (Contact page when imported).
 *
 * @return string
 */
function summit_quote_url() {
	$url = summit_opt( 'header_cta_url' );
	if ( $url && 0 === strpos( $url, '/' ) ) {
		$url = home_url( $url );
	}
	return $url ? $url : home_url( '/contact/' );
}
