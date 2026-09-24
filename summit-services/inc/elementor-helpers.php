<?php
/**
 * Helpers that build Elementor page data (sections → columns → widgets)
 * in PHP. Only widgets that ship with the free Elementor plugin are used,
 * so every imported page is fully editable in the Elementor editor.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Brand colors used in generated widget settings.
 *
 * @param string $name Color name.
 * @return string
 */
function summit_color( $name ) {
	$colors = array(
		'navy'         => '#0B2545',
		'navy2'        => '#13315C',
		'accent'       => '#D9480F',
		'accent_dark'  => '#B83A0B',
		'accent_light' => '#FF8A4C',
		'bg'           => '#F4F7FB',
		'text'         => '#475569',
		'white'        => '#FFFFFF',
		'muted_light'  => 'rgba(255,255,255,0.82)',
		'border'       => '#E2E8F0',
	);
	return isset( $colors[ $name ] ) ? $colors[ $name ] : $name;
}

/* -------------------------------------------------------------------------
 * Value helpers
 * ---------------------------------------------------------------------- */

/**
 * Random Elementor element ID.
 *
 * @return string
 */
function summit_el_id() {
	return substr( md5( uniqid( '', true ) . wp_rand() ), 0, 7 );
}

/**
 * Slider value.
 *
 * @param float  $size Size.
 * @param string $unit Unit.
 * @return array
 */
function summit_el_size( $size, $unit = 'px' ) {
	return array(
		'unit'  => $unit,
		'size'  => $size,
		'sizes' => array(),
	);
}

/**
 * Dimensions value (padding, margin, radius).
 *
 * @param int|string $top    Top.
 * @param int|string $right  Right.
 * @param int|string $bottom Bottom.
 * @param int|string $left   Left.
 * @param string     $unit   Unit.
 * @return array
 */
function summit_el_dims( $top, $right, $bottom, $left, $unit = 'px' ) {
	return array(
		'unit'     => $unit,
		'top'      => (string) $top,
		'right'    => (string) $right,
		'bottom'   => (string) $bottom,
		'left'     => (string) $left,
		'isLinked' => ( $top === $right && $right === $bottom && $bottom === $left ),
	);
}

/**
 * Font Awesome (solid) icon value.
 *
 * @param string $class Icon class, e.g. "fas fa-phone-alt".
 * @return array
 */
function summit_el_icon( $class ) {
	$library = 0 === strpos( $class, 'fab ' ) ? 'fa-brands' : ( 0 === strpos( $class, 'far ' ) ? 'fa-regular' : 'fa-solid' );
	return array(
		'value'   => $class,
		'library' => $library,
	);
}

/**
 * Link value.
 *
 * @param string $url URL.
 * @return array
 */
function summit_el_link( $url ) {
	return array(
		'url'               => $url,
		'is_external'       => '',
		'nofollow'          => '',
		'custom_attributes' => '',
	);
}

/**
 * Typography group settings.
 *
 * @param string $prefix Control prefix, e.g. "typography" or "title_typography".
 * @param array  $args   size, size_tablet, size_mobile, weight, line_height, family, transform, spacing.
 * @return array
 */
function summit_el_type( $prefix, array $args ) {
	$s = array( $prefix . '_typography' => 'custom' );
	if ( isset( $args['family'] ) ) {
		$s[ $prefix . '_font_family' ] = $args['family'];
	}
	foreach ( array( '', '_tablet', '_mobile' ) as $device ) {
		if ( isset( $args[ 'size' . $device ] ) ) {
			$s[ $prefix . '_font_size' . $device ] = summit_el_size( $args[ 'size' . $device ] );
		}
	}
	if ( isset( $args['weight'] ) ) {
		$s[ $prefix . '_font_weight' ] = (string) $args['weight'];
	}
	if ( isset( $args['line_height'] ) ) {
		$s[ $prefix . '_line_height' ] = summit_el_size( $args['line_height'], 'em' );
	}
	if ( isset( $args['transform'] ) ) {
		$s[ $prefix . '_text_transform' ] = $args['transform'];
	}
	if ( isset( $args['spacing'] ) ) {
		$s[ $prefix . '_letter_spacing' ] = summit_el_size( $args['spacing'] );
	}
	return $s;
}

/* -------------------------------------------------------------------------
 * Structure
 * ---------------------------------------------------------------------- */

/**
 * Section.
 *
 * @param array $columns  Column elements.
 * @param array $settings Section settings (merged over defaults).
 * @return array
 */
function summit_el_section( array $columns, array $settings = array() ) {
	$structures = array( 1 => '10', 2 => '20', 3 => '30', 4 => '40' );
	$defaults   = array(
		'content_width'  => summit_el_size( 1200 ),
		'gap'            => 'extended',
		'structure'      => isset( $structures[ count( $columns ) ] ) ? $structures[ count( $columns ) ] : '10',
		'padding'        => summit_el_dims( 90, 0, 90, 0 ),
		'padding_tablet' => summit_el_dims( 70, 20, 70, 20 ),
		'padding_mobile' => summit_el_dims( 56, 10, 56, 10 ),
	);
	return array(
		'id'       => summit_el_id(),
		'elType'   => 'section',
		'isInner'  => false,
		'settings' => array_merge( $defaults, $settings ),
		'elements' => $columns,
	);
}

/**
 * Section background settings helper.
 *
 * @param string $color Background color.
 * @return array
 */
function summit_el_bg( $color ) {
	return array(
		'background_background' => 'classic',
		'background_color'      => summit_color( $color ),
	);
}

/**
 * Section background image with dark overlay.
 *
 * @param array $image   ['id' => int, 'url' => string].
 * @param float $opacity Overlay opacity.
 * @return array
 */
function summit_el_bg_image( array $image, $opacity = 0.8 ) {
	return array(
		'background_background'         => 'classic',
		'background_color'              => summit_color( 'navy' ),
		'background_image'              => array(
			'id'  => $image['id'],
			'url' => $image['url'],
		),
		'background_position'           => 'center center',
		'background_repeat'             => 'no-repeat',
		'background_size'               => 'cover',
		'background_overlay_background' => 'gradient',
		'background_overlay_color'      => summit_color( 'navy' ),
		'background_overlay_color_b'    => summit_color( 'navy2' ),
		'background_overlay_gradient_angle' => summit_el_size( 110, 'deg' ),
		'background_overlay_opacity'    => summit_el_size( $opacity ),
	);
}

/**
 * Column.
 *
 * @param int|float $size     Width in percent.
 * @param array     $widgets  Widgets.
 * @param array     $settings Column settings.
 * @return array
 */
function summit_el_column( $size, array $widgets, array $settings = array() ) {
	// Standard widths come from the section structure; others need an inline size.
	$standard = in_array( (int) $size, array( 100, 50, 33, 25 ), true );
	return array(
		'id'       => summit_el_id(),
		'elType'   => 'column',
		'isInner'  => false,
		'settings' => array_merge(
			array(
				'_column_size' => (int) round( $size ),
				'_inline_size' => $standard ? null : $size,
			),
			$settings
		),
		'elements' => $widgets,
	);
}

/**
 * White "card" column settings.
 *
 * @param int  $padding Inner padding.
 * @param bool $hover   Lift on hover.
 * @return array
 */
function summit_el_card( $padding = 32, $hover = false ) {
	return array(
		'background_background'           => 'classic',
		'background_color'                => summit_color( 'white' ),
		'border_radius'                   => summit_el_dims( 12, 12, 12, 12 ),
		'box_shadow_box_shadow_type'      => 'yes',
		'box_shadow_box_shadow'           => array(
			'horizontal' => 0,
			'vertical'   => 10,
			'blur'       => 30,
			'spread'     => 0,
			'color'      => 'rgba(11,37,69,0.08)',
		),
		'padding'                         => summit_el_dims( $padding, $padding, $padding, $padding ),
		'padding_mobile'                  => summit_el_dims( 24, 22, 24, 22 ),
		'margin'                          => summit_el_dims( 10, 10, 10, 10 ),
		'css_classes'                     => $hover ? 'summit-card' : '',
	);
}

/**
 * Widget.
 *
 * @param string $type     Widget type.
 * @param array  $settings Settings.
 * @return array
 */
function summit_el_widget( $type, array $settings ) {
	return array(
		'id'         => summit_el_id(),
		'elType'     => 'widget',
		'isInner'    => false,
		'settings'   => $settings,
		'elements'   => array(),
		'widgetType' => $type,
	);
}

/* -------------------------------------------------------------------------
 * Widgets
 * ---------------------------------------------------------------------- */

/**
 * Heading.
 *
 * @param string $text Title (may contain simple HTML like <span>).
 * @param string $tag  h1–h6, p, div.
 * @param array  $args align, color, size, size_tablet, size_mobile, weight, line_height, spacing, transform, class, margin_bottom.
 * @return array
 */
function summit_w_heading( $text, $tag = 'h2', array $args = array() ) {
	$sizes = array(
		'h1' => array( 52, 40, 32 ),
		'h2' => array( 38, 32, 28 ),
		'h3' => array( 22, 21, 20 ),
	);
	$def   = isset( $sizes[ $tag ] ) ? $sizes[ $tag ] : array( 18, 18, 17 );
	$args  = array_merge(
		array(
			'align'       => 'left',
			'color'       => 'navy',
			'size'        => $def[0],
			'size_tablet' => $def[1],
			'size_mobile' => $def[2],
			'weight'      => 700,
			'line_height' => 1.25,
			'family'      => 'Poppins',
		),
		$args
	);

	$s = array_merge(
		array(
			'title'       => $text,
			'header_size' => $tag,
			'align'       => $args['align'],
			'title_color' => summit_color( $args['color'] ),
		),
		summit_el_type( 'typography', $args )
	);
	if ( isset( $args['align_mobile'] ) ) {
		$s['align_mobile'] = $args['align_mobile'];
	}
	if ( isset( $args['margin_bottom'] ) ) {
		$s['_margin'] = summit_el_dims( 0, 0, $args['margin_bottom'], 0 );
	}
	if ( ! empty( $args['class'] ) ) {
		$s['_css_classes'] = $args['class'];
	}
	if ( ! empty( $args['link'] ) ) {
		$s['link'] = summit_el_link( $args['link'] );
	}
	return summit_el_widget( 'heading', $s );
}

/**
 * Small uppercase label above a heading.
 *
 * @param string $text  Label.
 * @param string $align Alignment.
 * @param string $color Color.
 * @return array
 */
function summit_w_eyebrow( $text, $align = 'left', $color = 'accent' ) {
	return summit_w_heading(
		$text,
		'p',
		array(
			'align'         => $align,
			'color'         => $color,
			'size'          => 14,
			'size_tablet'   => 14,
			'size_mobile'   => 13,
			'weight'        => 600,
			'transform'     => 'uppercase',
			'spacing'       => 1.5,
			'margin_bottom' => -6,
		)
	);
}

/**
 * Text editor.
 *
 * @param string $html HTML.
 * @param array  $args align, color, size, class.
 * @return array
 */
function summit_w_text( $html, array $args = array() ) {
	$args = array_merge(
		array(
			'align'       => 'left',
			'color'       => 'text',
			'size'        => 17,
			'size_mobile' => 16,
			'line_height' => 1.7,
			'family'      => 'Inter',
			'weight'      => 400,
		),
		$args
	);
	$s    = array_merge(
		array(
			'editor'     => $html,
			'align'      => $args['align'],
			'text_color' => summit_color( $args['color'] ),
		),
		summit_el_type( 'typography', $args )
	);
	if ( ! empty( $args['class'] ) ) {
		$s['_css_classes'] = $args['class'];
	}
	if ( isset( $args['margin_bottom'] ) ) {
		$s['_margin'] = summit_el_dims( 0, 0, $args['margin_bottom'], 0 );
	}
	return summit_el_widget( 'text-editor', $s );
}

/**
 * Button.
 *
 * @param string $text  Label.
 * @param string $url   Link.
 * @param string $style primary | light | outline-light | outline-dark | dark.
 * @param array  $args  icon, align, inline, size, full.
 * @return array
 */
function summit_w_button( $text, $url, $style = 'primary', array $args = array() ) {
	$styles = array(
		'primary'       => array( 'accent', 'white', 'accent', 'accent_dark', 'white', 'accent_dark' ),
		'dark'          => array( 'navy', 'white', 'navy', 'navy2', 'white', 'navy2' ),
		'light'         => array( 'white', 'navy', 'white', 'bg', 'navy', 'bg' ),
		'outline-light' => array( 'rgba(255,255,255,0)', 'white', 'white', 'white', 'navy', 'white' ),
		'outline-dark'  => array( 'rgba(255,255,255,0)', 'navy', 'navy', 'navy', 'white', 'navy' ),
	);
	list( $bg, $fg, $border, $bg_hover, $fg_hover, $border_hover ) = $styles[ $style ];

	$args = array_merge(
		array(
			'icon'   => '',
			'align'  => 'left',
			'inline' => false,
			'full'   => false,
		),
		$args
	);

	$s = array_merge(
		array(
			'text'                              => $text,
			'link'                              => summit_el_link( $url ),
			'align'                             => $args['full'] ? 'justify' : $args['align'],
			'size'                              => 'md',
			'background_background'             => 'classic',
			'background_color'                  => summit_color( $bg ),
			'button_text_color'                 => summit_color( $fg ),
			'button_background_hover_background' => 'classic',
			'button_background_hover_color'     => summit_color( $bg_hover ),
			'hover_color'                       => summit_color( $fg_hover ),
			'button_hover_border_color'         => summit_color( $border_hover ),
			'border_border'                     => 'solid',
			'border_width'                      => summit_el_dims( 2, 2, 2, 2 ),
			'border_color'                      => summit_color( $border ),
			'border_radius'                     => summit_el_dims( 8, 8, 8, 8 ),
			'text_padding'                      => summit_el_dims( 16, 28, 16, 28 ),
			'hover_animation'                   => '',
		),
		summit_el_type(
			'typography',
			array(
				'family' => 'Poppins',
				'size'   => 16,
				'weight' => 600,
			)
		)
	);

	if ( $args['icon'] ) {
		$s['selected_icon'] = summit_el_icon( $args['icon'] );
		$s['icon_align']    = 'left';
		$s['icon_indent']   = summit_el_size( 10 );
	}
	if ( $args['inline'] ) {
		$s['_element_width']  = 'auto';
		$s['_margin']         = summit_el_dims( 0, 14, 0, 0 );
		$s['_element_width_mobile'] = 'inherit';
		$s['align_mobile']    = 'justify';
		$s['_margin_mobile']  = summit_el_dims( 0, 0, 0, 0 );
	}
	return summit_el_widget( 'button', $s );
}

/**
 * Icon list.
 *
 * @param array $items Strings, or [text, url] pairs.
 * @param array $args  icon, icon_color, color, inline, size, class, align.
 * @return array
 */
function summit_w_icon_list( array $items, array $args = array() ) {
	$args = array_merge(
		array(
			'icon'       => 'fas fa-check-circle',
			'icon_color' => 'accent',
			'color'      => 'navy',
			'inline'     => false,
			'size'       => 16,
			'weight'     => 500,
			'space'      => 12,
		),
		$args
	);
	$list = array();
	foreach ( $items as $item ) {
		$row = array(
			'_id'           => summit_el_id(),
			'text'          => is_array( $item ) ? $item[0] : $item,
			'selected_icon' => summit_el_icon( $args['icon'] ),
		);
		if ( is_array( $item ) && ! empty( $item[1] ) ) {
			$row['link'] = summit_el_link( $item[1] );
		}
		$list[] = $row;
	}

	$s = array_merge(
		array(
			'icon_list'     => $list,
			'view'          => $args['inline'] ? 'inline' : 'traditional',
			'space_between' => summit_el_size( $args['space'] ),
			'icon_color'    => summit_color( $args['icon_color'] ),
			'icon_size'     => summit_el_size( 18 ),
			'text_color'    => summit_color( $args['color'] ),
			'text_indent'   => summit_el_size( 10 ),
		),
		summit_el_type(
			'icon_typography',
			array(
				'family' => 'Inter',
				'size'   => $args['size'],
				'weight' => $args['weight'],
			)
		)
	);
	if ( ! empty( $args['align'] ) ) {
		$s['icon_align'] = $args['align'];
	}
	if ( ! empty( $args['class'] ) ) {
		$s['_css_classes'] = $args['class'];
	}
	return summit_el_widget( 'icon-list', $s );
}

/**
 * Icon box.
 *
 * @param string $icon  Icon class.
 * @param string $title Title.
 * @param string $desc  Description.
 * @param array  $args  position, align, dark, link.
 * @return array
 */
function summit_w_icon_box( $icon, $title, $desc, array $args = array() ) {
	$args = array_merge(
		array(
			'position' => 'top',
			'align'    => 'left',
			'dark'     => false,
			'link'     => '',
			'tag'      => 'h3',
		),
		$args
	);
	$s    = array_merge(
		array(
			'selected_icon'     => summit_el_icon( $icon ),
			'view'              => 'stacked',
			'shape'             => 'circle',
			'title_text'        => $title,
			'description_text'  => $desc,
			'position'          => $args['position'],
			'title_size'        => $args['tag'],
			'text_align'        => $args['align'],
			'primary_color'     => $args['dark'] ? summit_color( 'accent' ) : 'rgba(217,72,15,0.1)',
			'secondary_color'   => $args['dark'] ? summit_color( 'white' ) : summit_color( 'accent' ),
			'icon_size'         => summit_el_size( 24 ),
			'icon_padding'      => summit_el_size( 18 ),
			'icon_space'        => summit_el_size( 18 ),
			'title_bottom_space' => summit_el_size( 8 ),
			'title_color'       => summit_color( $args['dark'] ? 'white' : 'navy' ),
			'description_color' => summit_color( $args['dark'] ? 'muted_light' : 'text' ),
		),
		summit_el_type(
			'title_typography',
			array(
				'family' => 'Poppins',
				'size'   => 'left' === $args['position'] ? 18 : 20,
				'weight' => 600,
			)
		),
		summit_el_type(
			'description_typography',
			array(
				'family'      => 'Inter',
				'size'        => 16,
				'line_height' => 1.65,
			)
		)
	);
	if ( $args['link'] ) {
		$s['link'] = summit_el_link( $args['link'] );
	}
	return summit_el_widget( 'icon-box', $s );
}

/**
 * Image from the media library.
 *
 * @param array $image ['id' => int, 'url' => string].
 * @param array $args  size, radius, link, class.
 * @return array
 */
function summit_w_image( array $image, array $args = array() ) {
	$args = array_merge(
		array(
			'size'   => 'large',
			'radius' => 12,
			'link'   => '',
		),
		$args
	);
	$s    = array(
		'image'               => array(
			'id'     => $image['id'],
			'url'    => $image['url'],
			'alt'    => isset( $image['alt'] ) ? $image['alt'] : '',
			'source' => 'library',
		),
		'image_size'          => $args['size'],
		'align'               => 'center',
		'width'               => summit_el_size( 100, '%' ),
		'image_border_radius' => summit_el_dims( $args['radius'], $args['radius'], $args['radius'], $args['radius'] ),
	);
	if ( $args['link'] ) {
		$s['link_to'] = 'custom';
		$s['link']    = summit_el_link( $args['link'] );
	}
	if ( ! empty( $args['class'] ) ) {
		$s['_css_classes'] = $args['class'];
	}
	return summit_el_widget( 'image', $s );
}

/**
 * Counter.
 *
 * @param int    $number Ending number.
 * @param string $suffix Suffix.
 * @param string $title  Title.
 * @param bool   $dark   Light text for dark backgrounds.
 * @return array
 */
function summit_w_counter( $number, $suffix, $title, $dark = false ) {
	return summit_el_widget(
		'counter',
		array_merge(
			array(
				'starting_number'    => 0,
				'ending_number'      => $number,
				'suffix'             => $suffix,
				'duration'           => 1800,
				'thousand_separator' => 'yes',
				'title'              => $title,
				'number_color'       => summit_color( $dark ? 'white' : 'navy' ),
				'title_color'        => summit_color( $dark ? 'muted_light' : 'text' ),
				'_css_classes'       => 'summit-counter',
			),
			summit_el_type(
				'typography_number',
				array(
					'family'      => 'Poppins',
					'size'        => 46,
					'size_mobile' => 38,
					'weight'      => 700,
				)
			),
			summit_el_type(
				'typography_title',
				array(
					'family' => 'Inter',
					'size'   => 16,
					'weight' => 500,
				)
			)
		)
	);
}

/**
 * Testimonial.
 *
 * @param string $content Quote.
 * @param string $name    Name.
 * @param string $job     Job / location.
 * @return array
 */
function summit_w_testimonial( $content, $name, $job ) {
	return summit_el_widget(
		'testimonial',
		array_merge(
			array(
				'testimonial_content'     => $content,
				'testimonial_name'        => $name,
				'testimonial_job'         => $job,
				'testimonial_image'       => array(
					'url' => '',
					'id'  => '',
				),
				'testimonial_alignment'   => 'left',
				'content_content_color'   => summit_color( 'text' ),
				'name_text_color'         => summit_color( 'navy' ),
				'job_text_color'          => summit_color( 'accent' ),
			),
			summit_el_type(
				'content_typography',
				array(
					'family'      => 'Inter',
					'size'        => 16,
					'line_height' => 1.7,
				)
			),
			summit_el_type(
				'name_typography',
				array(
					'family' => 'Poppins',
					'size'   => 17,
					'weight' => 600,
				)
			)
		)
	);
}

/**
 * Google map.
 *
 * @param string $address Address.
 * @param int    $height  Height in px.
 * @return array
 */
function summit_w_map( $address, $height = 450 ) {
	return summit_el_widget(
		'google_maps',
		array(
			'address'       => $address,
			'zoom'          => summit_el_size( 12 ),
			'height'        => summit_el_size( $height ),
			'height_mobile' => summit_el_size( 340 ),
			'_css_classes'  => 'summit-map',
		)
	);
}

/**
 * Accordion (FAQ).
 *
 * @param array $faqs [question, answer] pairs.
 * @return array
 */
function summit_w_accordion( array $faqs ) {
	$tabs = array();
	foreach ( $faqs as $faq ) {
		$tabs[] = array(
			'_id'         => summit_el_id(),
			'tab_title'   => $faq[0],
			'tab_content' => '<p>' . $faq[1] . '</p>',
		);
	}
	return summit_el_widget(
		'accordion',
		array_merge(
			array(
				'tabs'             => $tabs,
				'selected_icon'    => summit_el_icon( 'fas fa-plus' ),
				'selected_active_icon' => summit_el_icon( 'fas fa-minus' ),
				'title_html_tag'   => 'h3',
				'border_color'     => summit_color( 'border' ),
				'title_background' => summit_color( 'white' ),
				'title_color'      => summit_color( 'navy' ),
				'tab_active_color' => summit_color( 'accent' ),
				'icon_color'       => summit_color( 'accent' ),
				'icon_active_color' => summit_color( 'accent' ),
				'content_color'    => summit_color( 'text' ),
				'title_padding'    => summit_el_dims( 20, 22, 20, 22 ),
				'content_padding'  => summit_el_dims( 4, 22, 20, 22 ),
			),
			summit_el_type(
				'title_typography',
				array(
					'family' => 'Poppins',
					'size'   => 17,
					'weight' => 600,
				)
			),
			summit_el_type(
				'content_typography',
				array(
					'family'      => 'Inter',
					'size'        => 16,
					'line_height' => 1.7,
				)
			)
		)
	);
}

/**
 * Shortcode.
 *
 * @param string $shortcode Shortcode.
 * @return array
 */
function summit_w_shortcode( $shortcode ) {
	return summit_el_widget( 'shortcode', array( 'shortcode' => $shortcode ) );
}

/**
 * Spacer.
 *
 * @param int $px Height.
 * @return array
 */
function summit_w_spacer( $px ) {
	return summit_el_widget( 'spacer', array( 'space' => summit_el_size( $px ) ) );
}
