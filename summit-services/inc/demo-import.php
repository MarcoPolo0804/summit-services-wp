<?php
/**
 * One-click demo importer: Appearance → Summit Setup.
 *
 * Creates (or updates) the Home, About, Services, six service detail pages
 * and Contact as Elementor pages, imports the demo photos into the Media
 * Library, builds the menus, sets the homepage and applies brand colors
 * and fonts to Elementor's global Site Settings.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Demo images bundled in assets/images: key => alt text.
 *
 * @return array
 */
function summit_demo_images() {
	return array(
		'hero-home'                   => 'Modern home at dusk',
		'technician-portrait'         => 'Licensed Summit technician',
		'technician-at-work'          => 'Technician repairing equipment',
		'service-emergency-plumbing'  => 'Kitchen faucet running water',
		'service-drain-cleaning'      => 'Chrome bathtub faucet and drain',
		'service-water-heaters'       => 'Bright bathroom with freestanding tub',
		'service-leak-detection'      => 'Commercial water pipes and valves',
		'service-heating-cooling'     => 'Comfortable, climate-controlled living room',
		'service-bathroom-remodeling' => 'Remodeled bathroom with glass shower',
	);
}

/**
 * Register the admin page.
 */
function summit_setup_menu() {
	add_theme_page(
		__( 'Summit Setup', 'summit' ),
		__( 'Summit Setup', 'summit' ),
		'manage_options',
		'summit-setup',
		'summit_setup_page'
	);
}
add_action( 'admin_menu', 'summit_setup_menu' );

/**
 * Nudge to the setup page after activating the theme.
 */
function summit_setup_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'appearance_page_summit-setup' === $screen->id || get_option( 'summit_demo_imported' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>%1$s</strong> %2$s <a class="button button-primary" style="margin-left:8px" href="%3$s">%4$s</a></p></div>',
		esc_html__( 'Summit Services is active.', 'summit' ),
		esc_html__( 'Build your Home, About, Services and Contact pages in one click.', 'summit' ),
		esc_url( admin_url( 'themes.php?page=summit-setup' ) ),
		esc_html__( 'Run Setup', 'summit' )
	);
}
add_action( 'admin_notices', 'summit_setup_notice' );

/**
 * Elementor plugin state: active | installed | missing.
 *
 * @return string
 */
function summit_elementor_state() {
	if ( did_action( 'elementor/loaded' ) ) {
		return 'active';
	}
	if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
		return 'installed';
	}
	return 'missing';
}

/**
 * Render the setup page.
 */
function summit_setup_page() {
	$state   = summit_elementor_state();
	$results = get_transient( 'summit_import_results' );
	delete_transient( 'summit_import_results' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Summit Services — Setup', 'summit' ); ?></h1>

		<?php if ( is_array( $results ) ) : ?>
			<div class="notice notice-<?php echo empty( $results['error'] ) ? 'success' : 'error'; ?>">
				<?php if ( ! empty( $results['error'] ) ) : ?>
					<p><?php echo esc_html( $results['error'] ); ?></p>
				<?php else : ?>
					<p><strong><?php esc_html_e( 'Done! Your site is ready.', 'summit' ); ?></strong> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'View site →', 'summit' ); ?></a></p>
					<ul style="list-style:disc;padding-left:20px">
						<?php foreach ( $results['log'] as $line ) : ?>
							<li><?php echo esc_html( $line ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="card" style="max-width:760px">
			<h2><?php esc_html_e( 'Step 1 — Elementor', 'summit' ); ?></h2>
			<?php if ( 'active' === $state ) : ?>
				<p>✅ <?php esc_html_e( 'Elementor is installed and active.', 'summit' ); ?></p>
			<?php elseif ( 'installed' === $state ) : ?>
				<p><?php esc_html_e( 'Elementor is installed but not active.', 'summit' ); ?>
					<a class="button button-primary" href="<?php echo esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=elementor/elementor.php' ), 'activate-plugin_elementor/elementor.php' ) ); ?>"><?php esc_html_e( 'Activate Elementor', 'summit' ); ?></a>
				</p>
			<?php else : ?>
				<p><?php esc_html_e( 'Install the free Elementor plugin first.', 'summit' ); ?>
					<a class="button button-primary" href="<?php echo esc_url( admin_url( 'plugin-install.php?s=elementor&tab=search&type=term' ) ); ?>"><?php esc_html_e( 'Install Elementor', 'summit' ); ?></a>
				</p>
			<?php endif; ?>

			<h2><?php esc_html_e( 'Step 2 — Import the website', 'summit' ); ?></h2>
			<p><?php esc_html_e( 'This creates the following Elementor pages and sets everything up:', 'summit' ); ?></p>
			<ul style="list-style:disc;padding-left:20px">
				<li><?php esc_html_e( 'Home, About Us, Services, Contact', 'summit' ); ?></li>
				<li><?php esc_html_e( '6 service detail pages (Emergency Plumbing, Drain Cleaning, Water Heaters, Leak Detection, Heating & AC, Bathroom & Kitchen)', 'summit' ); ?></li>
				<li><?php esc_html_e( 'Primary & footer menus, static homepage, pretty permalinks', 'summit' ); ?></li>
				<li><?php esc_html_e( 'Demo photos in the Media Library, brand colors & fonts in Elementor Site Settings', 'summit' ); ?></li>
			</ul>
			<p><em><?php esc_html_e( 'Business details (phone, email, address, hours) come from Appearance → Customize → Business Info. Set those first if you have them, or change them later and re-run the import.', 'summit' ); ?></em></p>
			<p><strong><?php esc_html_e( 'Re-running the import resets the demo pages to their original design.', 'summit' ); ?></strong> <?php esc_html_e( 'Your other pages are never touched.', 'summit' ); ?></p>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="summit_import">
				<?php wp_nonce_field( 'summit_import', 'summit_import_nonce' ); ?>
				<p>
					<label><input type="checkbox" name="summit_site_title" value="1" <?php checked( ! get_option( 'summit_demo_imported' ) ); ?>>
					<?php esc_html_e( 'Set the site title and tagline to “Summit Plumbing & Air / Plumbing · Heating · Cooling”', 'summit' ); ?></label>
				</p>
				<?php submit_button( get_option( 'summit_demo_imported' ) ? __( 'Re-import Pages', 'summit' ) : __( 'Import Website', 'summit' ), 'primary hero', 'submit', true, 'active' === $state ? array() : array( 'disabled' => 'disabled' ) ); ?>
			</form>

			<h2><?php esc_html_e( 'Step 3 — Make it yours', 'summit' ); ?></h2>
			<ol>
				<li><?php esc_html_e( 'Appearance → Customize → Site Identity: upload your logo.', 'summit' ); ?></li>
				<li><?php esc_html_e( 'Appearance → Customize → Business Info: phone, email, address, hours, form recipient.', 'summit' ); ?></li>
				<li><?php esc_html_e( 'Pages → hover a page → “Edit with Elementor” to change text, photos and layout.', 'summit' ); ?></li>
				<li><?php esc_html_e( 'Quote requests appear under Dashboard → Leads and are emailed to you.', 'summit' ); ?></li>
			</ol>
		</div>
	</div>
	<?php
}

/**
 * Handle the import request.
 */
function summit_handle_import() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'summit' ) );
	}
	check_admin_referer( 'summit_import', 'summit_import_nonce' );

	if ( 'active' !== summit_elementor_state() ) {
		$results = array( 'error' => __( 'Please install and activate Elementor first.', 'summit' ) );
	} else {
		$results = summit_run_import( ! empty( $_POST['summit_site_title'] ) );
	}

	set_transient( 'summit_import_results', $results, 5 * MINUTE_IN_SECONDS );
	wp_safe_redirect( admin_url( 'themes.php?page=summit-setup' ) );
	exit;
}
add_action( 'admin_post_summit_import', 'summit_handle_import' );

/**
 * Import one bundled image into the Media Library (reused on re-import).
 *
 * @param string $key Image key (file name without extension).
 * @param string $alt Alt text.
 * @return array|WP_Error ['id', 'url', 'alt'].
 */
function summit_import_image( $key, $alt ) {
	$media = (array) get_option( 'summit_demo_media', array() );
	if ( ! empty( $media[ $key ] ) && wp_attachment_is_image( $media[ $key ] ) ) {
		$id = (int) $media[ $key ];
	} else {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$source = SUMMIT_DIR . '/assets/images/' . $key . '.jpg';
		$tmp    = wp_tempnam( $key . '.jpg' );
		if ( ! $tmp || ! copy( $source, $tmp ) ) {
			return new WP_Error( 'summit_copy', 'Could not copy ' . $key . '.jpg' );
		}
		$id = media_handle_sideload(
			array(
				'name'     => $key . '.jpg',
				'tmp_name' => $tmp,
			),
			0,
			$alt
		);
		if ( is_wp_error( $id ) ) {
			wp_delete_file( $tmp );
			return $id;
		}
		update_post_meta( $id, '_wp_attachment_image_alt', $alt );
		$media[ $key ] = $id;
		update_option( 'summit_demo_media', $media, false );
	}

	return array(
		'id'  => $id,
		'url' => wp_get_attachment_image_url( $id, 'full' ),
		'alt' => $alt,
	);
}

/**
 * Find the demo page for a slug, or create it.
 *
 * @param string $key       Internal key.
 * @param string $slug      Slug.
 * @param string $title     Title.
 * @param int    $parent    Parent page ID.
 * @param int    $order     Menu order.
 * @param array  $log       Log (by reference).
 * @return int Page ID.
 */
function summit_import_page( $key, $slug, $title, $parent, $order, array &$log ) {
	$pages = (array) get_option( 'summit_demo_pages', array() );

	if ( ! empty( $pages[ $key ] ) && 'page' === get_post_type( $pages[ $key ] ) && 'trash' !== get_post_status( $pages[ $key ] ) ) {
		$id = (int) $pages[ $key ];
		wp_update_post(
			array(
				'ID'          => $id,
				'post_parent' => $parent,
				'menu_order'  => $order,
				'post_status' => 'publish',
			)
		);
		$log[] = sprintf( 'Updated page: %s', $title );
	} else {
		$id = wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => $title,
				'post_name'   => $slug,
				'post_parent' => $parent,
				'menu_order'  => $order,
			)
		);
		$log[] = sprintf( 'Created page: %s', $title );
	}

	$pages[ $key ] = $id;
	update_option( 'summit_demo_pages', $pages, false );
	return (int) $id;
}

/**
 * Save Elementor data to a page.
 *
 * @param int    $id      Page ID.
 * @param array  $data    Elementor sections.
 * @param string $summary Plain HTML fallback content (shown if Elementor is disabled).
 */
function summit_save_elementor( $id, array $data, $summary ) {
	wp_update_post(
		array(
			'ID'           => $id,
			'post_content' => $summary,
		)
	);
	update_post_meta( $id, '_wp_page_template', 'elementor_header_footer' );
	update_post_meta( $id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );
	update_post_meta( $id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
	delete_post_meta( $id, '_elementor_css' );
	delete_post_meta( $id, '_elementor_element_cache' );
	delete_post_meta( $id, '_elementor_page_assets' );
}

/**
 * Build a nav menu from scratch.
 *
 * @param string $name     Menu name.
 * @param string $location Theme location.
 * @param array  $items    [page_id, title, children[]].
 */
function summit_build_menu( $name, $location, array $items ) {
	$existing = wp_get_nav_menu_object( $name );
	if ( $existing ) {
		wp_delete_nav_menu( $existing->term_id );
	}
	$menu_id = wp_create_nav_menu( $name );
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	$add = static function ( $page_id, $title, $parent_item = 0 ) use ( $menu_id ) {
		return wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => $title,
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page_id,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-parent-id' => $parent_item,
			)
		);
	};

	foreach ( $items as $item ) {
		$item_id = $add( $item[0], $item[1] );
		if ( ! empty( $item[2] ) && ! is_wp_error( $item_id ) ) {
			foreach ( $item[2] as $child ) {
				$add( $child[0], $child[1], $item_id );
			}
		}
	}

	$locations              = (array) get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Apply brand colors, fonts and layout width to Elementor's active kit.
 */
function summit_apply_elementor_kit() {
	$kit_id = (int) get_option( 'elementor_active_kit' );
	if ( ! $kit_id ) {
		return false;
	}

	$settings = get_post_meta( $kit_id, '_elementor_page_settings', true );
	$settings = is_array( $settings ) ? $settings : array();

	$font = static function ( $id, $title, $family, $weight ) {
		return array(
			'_id'                    => $id,
			'title'                  => $title,
			'typography_typography'  => 'custom',
			'typography_font_family' => $family,
			'typography_font_weight' => $weight,
		);
	};

	$settings = array_merge(
		$settings,
		array(
			'system_colors'     => array(
				array( '_id' => 'primary', 'title' => 'Primary', 'color' => '#0B2545' ),
				array( '_id' => 'secondary', 'title' => 'Secondary', 'color' => '#13315C' ),
				array( '_id' => 'text', 'title' => 'Text', 'color' => '#475569' ),
				array( '_id' => 'accent', 'title' => 'Accent', 'color' => '#D9480F' ),
			),
			'custom_colors'     => array(
				array( '_id' => 'summitbg', 'title' => 'Light Background', 'color' => '#F4F7FB' ),
				array( '_id' => 'summitor', 'title' => 'Accent Light', 'color' => '#FF8A4C' ),
			),
			'system_typography' => array(
				$font( 'primary', 'Primary', 'Poppins', '700' ),
				$font( 'secondary', 'Secondary', 'Poppins', '600' ),
				$font( 'text', 'Text', 'Inter', '400' ),
				$font( 'accent', 'Accent', 'Poppins', '600' ),
			),
			'container_width'   => array(
				'unit'  => 'px',
				'size'  => 1200,
				'sizes' => array(),
			),
			'body_color'        => '#475569',
		)
	);
	// Kit-wide link colors would override the theme header/footer links.
	unset( $settings['link_normal_color'], $settings['link_hover_color'] );

	update_post_meta( $kit_id, '_elementor_page_settings', $settings );
	return true;
}

/**
 * Run the full import.
 *
 * @param bool $set_title Also set the site title/tagline.
 * @return array
 */
function summit_run_import( $set_title ) {
	$log = array();

	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 300 ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
	}

	// Pretty permalinks so page URLs look like /services/drain-cleaning/.
	if ( '' === (string) get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$log[] = 'Enabled pretty permalinks (/%postname%/).';
	}

	if ( $set_title ) {
		update_option( 'blogname', 'Summit Plumbing & Air' );
		update_option( 'blogdescription', 'Plumbing · Heating · Cooling' );
		$log[] = 'Set site title and tagline.';
	}

	// 1. Images.
	$images = array();
	foreach ( summit_demo_images() as $key => $alt ) {
		$image = summit_import_image( $key, $alt );
		if ( is_wp_error( $image ) ) {
			return array( 'error' => 'Image import failed: ' . $image->get_error_message() );
		}
		$images[ $key ] = $image;
	}
	$log[] = sprintf( 'Imported %d photos into the Media Library.', count( $images ) );

	// 2. Pages (create first so every URL is known before building layouts).
	$ids             = array();
	$ids['home']     = summit_import_page( 'home', 'home', 'Home', 0, 0, $log );
	$ids['about']    = summit_import_page( 'about', 'about', 'About Us', 0, 1, $log );
	$ids['services'] = summit_import_page( 'services', 'services', 'Services', 0, 2, $log );
	$ids['contact']  = summit_import_page( 'contact', 'contact', 'Contact', 0, 3, $log );
	$svc_ids         = array();
	foreach ( summit_demo_services() as $i => $service ) {
		$svc_ids[ $service['slug'] ] = summit_import_page( 'svc_' . $service['slug'], $service['slug'], $service['title'], $ids['services'], $i, $log );
	}
	update_option( 'summit_services_page_id', $ids['services'] );

	// 3. Front page.
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $ids['home'] );
	$log[] = 'Set “Home” as the static homepage.';

	// 4. Context for the layouts.
	$phone = summit_opt( 'phone' );
	$ctx   = array(
		'url'     => array(
			'home'     => home_url( '/' ),
			'about'    => get_permalink( $ids['about'] ),
			'services' => get_permalink( $ids['services'] ),
			'contact'  => get_permalink( $ids['contact'] ),
			'svc'      => array_map( 'get_permalink', $svc_ids ),
		),
		'img'     => $images,
		'phone'   => $phone,
		'tel'     => summit_tel( $phone ),
		'email'   => summit_opt( 'email' ),
		'address' => summit_opt( 'address' ),
		'hours'   => summit_opt( 'hours' ),
	);

	// 5. Elementor layouts.
	summit_save_elementor( $ids['home'], summit_page_home( $ctx ), '<h2>Fast, Honest Plumbing &amp; HVAC Repair You Can Trust</h2><p>Licensed technicians at your door in as little as 60 minutes.</p>' );
	summit_save_elementor( $ids['about'], summit_page_about( $ctx ), '<h2>About Summit Plumbing &amp; Air</h2><p>Family-owned and community-focused since 2001.</p>' );
	summit_save_elementor( $ids['services'], summit_page_services( $ctx ), '<h2>Our Services</h2><p>Complete plumbing, heating and air conditioning services.</p>' );
	summit_save_elementor( $ids['contact'], summit_page_contact( $ctx ), '<h2>Contact Us</h2>[summit_contact_form]' );
	foreach ( summit_demo_services() as $service ) {
		summit_save_elementor( $svc_ids[ $service['slug'] ], summit_page_service( $ctx, $service ), '<h2>' . esc_html( $service['title'] ) . '</h2><p>' . esc_html( $service['tagline'] ) . '</p>' );
	}
	$log[] = 'Built all page layouts in Elementor.';

	// 6. Menus.
	$service_children = array();
	foreach ( summit_demo_services() as $service ) {
		$service_children[] = array( $svc_ids[ $service['slug'] ], $service['title'] );
	}
	summit_build_menu(
		'Summit Primary',
		'primary',
		array(
			array( $ids['home'], 'Home' ),
			array( $ids['about'], 'About' ),
			array( $ids['services'], 'Services', $service_children ),
			array( $ids['contact'], 'Contact' ),
		)
	);
	summit_build_menu(
		'Summit Footer',
		'footer',
		array(
			array( $ids['home'], 'Home' ),
			array( $ids['about'], 'About Us' ),
			array( $ids['services'], 'Services' ),
			array( $ids['contact'], 'Contact & Free Quote' ),
		)
	);
	$log[] = 'Created the primary and footer menus.';

	// 7. Elementor global colors & fonts.
	if ( summit_apply_elementor_kit() ) {
		$log[] = 'Applied brand colors and fonts to Elementor Site Settings.';
	}

	// 8. Regenerate Elementor CSS.
	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
	flush_rewrite_rules();

	update_option( 'summit_demo_imported', time() );

	return array( 'log' => $log );
}
