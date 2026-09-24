<?php
/**
 * Demo page layouts for the importer. Each function returns Elementor data
 * (an array of sections) built with the helpers in elementor-helpers.php.
 *
 * $ctx (built in demo-import.php) contains:
 *   url   => home, about, services, contact, svc => [slug => url]
 *   img   => [key => ['id', 'url', 'alt']]
 *   phone, tel, email, address, hours, name
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Services offered. Each becomes a child page of "Services".
 *
 * @return array
 */
function summit_demo_services() {
	return array(
		array(
			'slug'     => 'emergency-plumbing',
			'title'    => 'Emergency Plumbing',
			'icon'     => 'fas fa-tools',
			'image'    => 'service-emergency-plumbing',
			'tagline'  => 'Burst pipe at 2am? A licensed plumber can be at your door in 60 minutes or less — nights, weekends and holidays.',
			'excerpt'  => 'Burst pipes, overflowing toilets and major leaks fixed fast, day or night, 365 days a year.',
			'intro'    => array(
				'Plumbing emergencies never happen at a convenient time. That’s why our fully stocked trucks and licensed plumbers are on call 24 hours a day, 7 days a week, across the Greater Austin area.',
				'We stop the damage first, explain exactly what went wrong, and give you an upfront price before any repair begins. No overtime surprises, no guesswork.',
			),
			'included' => array( 'Burst & frozen pipe repair', 'Overflowing or clogged toilets', 'Main water line breaks', 'Sewer backups & overflows', 'Gas leak detection & shut-off', 'No-hot-water emergencies' ),
			'signs'    => array( 'Water pooling on floors, walls or ceilings', 'A sudden drop in water pressure', 'Sewage smell or water backing up into drains', 'A hissing sound or rotten-egg smell near gas lines', 'No water at all from any fixture' ),
			'faqs'     => array(
				array( 'Do you charge extra for nights and weekends?', 'Emergency rates are quoted upfront, before any work begins, so you always know the price. There are no hidden after-hours fees on your final invoice.' ),
				array( 'How fast can you get here?', 'Most emergency calls in the Austin metro have a plumber on-site within 60 minutes. We’ll give you a live arrival window when you call.' ),
				array( 'What should I do while I wait?', 'Shut off your main water valve (usually near the water meter or where the line enters the house) and turn off the water heater if there’s flooding. If you smell gas, leave the home and call us from outside.' ),
			),
		),
		array(
			'slug'     => 'drain-cleaning',
			'title'    => 'Drain Cleaning',
			'icon'     => 'fas fa-water',
			'image'    => 'service-drain-cleaning',
			'tagline'  => 'Slow, smelly or completely clogged drains cleared for good with professional snaking and hydro-jetting.',
			'excerpt'  => 'Kitchen, bathroom and main sewer line clogs cleared with camera inspection and hydro-jetting.',
			'intro'    => array(
				'Store-bought drain chemicals only move a clog a little further down the line — and they eat away at your pipes. Our technicians find the real cause with a video camera inspection and clear it completely.',
				'From a slow bathroom sink to a main sewer line full of tree roots, we have the equipment to restore full flow and help keep it that way.',
			),
			'included' => array( 'Kitchen & bathroom drain clearing', 'Main sewer line cleaning', 'Video camera inspection', 'High-pressure hydro-jetting', 'Tree root removal', 'Preventive maintenance plans' ),
			'signs'    => array( 'Water draining slowly from sinks or tubs', 'Gurgling sounds from drains or toilets', 'Bad odors coming from drains', 'Multiple fixtures clogging at the same time', 'Water backing up in the shower when you flush' ),
			'faqs'     => array(
				array( 'What is hydro-jetting?', 'Hydro-jetting uses a high-pressure stream of water to scour grease, scale and roots from the inside of your pipes. It cleans the full diameter of the pipe instead of just punching a hole through the clog.' ),
				array( 'Is a camera inspection really necessary?', 'For recurring or main-line clogs, yes. The camera shows us exactly what and where the problem is, so you only pay for the repair you actually need.' ),
				array( 'How often should drains be cleaned?', 'Most homes benefit from a professional cleaning every 1–2 years. Homes with large trees or older cast-iron lines may need it more often.' ),
			),
		),
		array(
			'slug'     => 'water-heaters',
			'title'    => 'Water Heater Services',
			'icon'     => 'fas fa-fire',
			'image'    => 'service-water-heaters',
			'tagline'  => 'Repair, replacement and installation of tank and tankless water heaters — often same day.',
			'excerpt'  => 'Tank and tankless water heater repair, replacement and same-day installation.',
			'intro'    => array(
				'Cold showers are no way to start the day. We repair and install every major brand of gas and electric water heater, including energy-saving tankless systems.',
				'If a repair makes sense, we’ll fix it. If replacement is the smarter investment, we’ll show you the options side by side with clear, flat-rate pricing — and haul the old unit away.',
			),
			'included' => array( 'Tank water heater repair', 'Tankless water heater installation', 'Same-day replacements', 'Annual flushing & maintenance', 'Pilot light & thermostat repair', 'Old unit removal & disposal' ),
			'signs'    => array( 'No hot water, or it runs out quickly', 'Rusty or discolored hot water', 'Popping or rumbling noises from the tank', 'Water pooling around the base of the heater', 'Your water heater is more than 10 years old' ),
			'faqs'     => array(
				array( 'Should I choose a tank or tankless water heater?', 'Tankless units cost more upfront but provide endless hot water and can cut water-heating energy use by up to 30%. We’ll recommend the right fit for your household size and budget.' ),
				array( 'How long does installation take?', 'Most standard tank replacements are completed in 2–4 hours. Tankless conversions typically take most of a day.' ),
				array( 'Do you offer financing?', 'Yes. Flexible financing is available on new water heaters with approved credit — ask your technician for current offers.' ),
			),
		),
		array(
			'slug'     => 'leak-detection',
			'title'    => 'Leak Detection & Repiping',
			'icon'     => 'fas fa-search',
			'image'    => 'service-leak-detection',
			'tagline'  => 'Hidden leaks found fast with non-invasive technology, then repaired with minimal disruption to your home.',
			'excerpt'  => 'Pinpoint hidden and slab leaks with electronic detection, then repair or repipe cleanly.',
			'intro'    => array(
				'A hidden leak can waste thousands of gallons of water and quietly damage floors, walls and foundations. We use acoustic and thermal detection equipment to pinpoint leaks without tearing up your home.',
				'For older homes with failing galvanized or polybutylene pipes, we offer whole-home repiping with modern PEX or copper — usually finished in just a few days.',
			),
			'included' => array( 'Electronic leak detection', 'Slab leak repair', 'Water line replacement', 'Whole-home repiping (PEX & copper)', 'Pressure testing', 'Drywall patch coordination' ),
			'signs'    => array( 'An unexplained jump in your water bill', 'Warm spots on the floor', 'The sound of running water when everything is off', 'Mold, mildew or musty smells', 'Cracks in walls or foundation' ),
			'faqs'     => array(
				array( 'How do you find a leak without breaking walls?', 'We use acoustic listening devices, thermal imaging and pressure testing to locate the leak within inches — so any opening we make is small and precise.' ),
				array( 'Will insurance cover a slab leak?', 'Many homeowner policies cover the cost of accessing and repairing a slab leak. We provide detailed documentation and photos for your claim.' ),
				array( 'How long does a repipe take?', 'Most single-family homes are repiped in 2–4 days, and you’ll have running water at the end of each work day.' ),
			),
		),
		array(
			'slug'     => 'heating-cooling',
			'title'    => 'Heating & Air Conditioning',
			'icon'     => 'fas fa-snowflake',
			'image'    => 'service-heating-cooling',
			'tagline'  => 'AC and furnace repair, installation and maintenance that keeps your home comfortable all year long.',
			'excerpt'  => 'AC repair, furnace service, heat pumps and new system installs from NATE-certified techs.',
			'intro'    => array(
				'Texas summers are no joke. Our NATE-certified HVAC technicians repair and install all major brands of air conditioners, furnaces and heat pumps — and we stock common parts on every truck.',
				'Looking to lower your energy bills? We’ll size a new high-efficiency system correctly for your home and help you take advantage of available rebates.',
			),
			'included' => array( 'AC repair & recharge', 'New AC & heat pump installation', 'Furnace repair & replacement', 'Seasonal tune-ups', 'Thermostat installation', 'Duct inspection & sealing' ),
			'signs'    => array( 'Warm air blowing from the vents', 'Energy bills higher than usual', 'Strange noises or smells when the system runs', 'Uneven temperatures from room to room', 'Your system short-cycles on and off' ),
			'faqs'     => array(
				array( 'How often should my AC be serviced?', 'We recommend a tune-up twice a year: the AC in spring and the heating system in fall. Regular maintenance prevents most breakdowns and keeps your warranty valid.' ),
				array( 'How long does a new AC system last?', 'A well-maintained system typically lasts 12–15 years. If yours is over 10 years old and needs frequent repairs, replacement may save you money.' ),
				array( 'Do you have a maintenance plan?', 'Yes. Our Comfort Club includes two tune-ups a year, priority scheduling and 15% off repairs.' ),
			),
		),
		array(
			'slug'     => 'bathroom-kitchen-plumbing',
			'title'    => 'Bathroom & Kitchen Plumbing',
			'icon'     => 'fas fa-bath',
			'image'    => 'service-bathroom-remodeling',
			'tagline'  => 'Fixture installs, upgrades and remodel plumbing done cleanly, on time and to code.',
			'excerpt'  => 'Faucets, toilets, showers, disposals and full remodel rough-ins installed to code.',
			'intro'    => array(
				'Whether you’re replacing a leaky faucet or remodeling an entire bathroom, our plumbers handle the job with care — protecting your floors and cleaning up before we leave.',
				'We work directly with homeowners and remodeling contractors to rough-in and finish plumbing that passes inspection the first time.',
			),
			'included' => array( 'Faucet & sink installation', 'Toilet repair & replacement', 'Shower & tub valve replacement', 'Garbage disposal installation', 'Remodel rough-in & finish plumbing', 'Water filtration & softeners' ),
			'signs'    => array( 'Dripping faucets or running toilets', 'Low pressure at a single fixture', 'Loose or rocking toilets', 'A disposal that hums but won’t spin', 'You’re planning a kitchen or bath remodel' ),
			'faqs'     => array(
				array( 'Can I supply my own fixtures?', 'Absolutely. We’re happy to install fixtures you’ve purchased, or we can recommend reliable brands that we stock and warranty.' ),
				array( 'Do you pull permits for remodels?', 'Yes. We handle permitting and inspections for all remodel plumbing work we perform.' ),
				array( 'Is there a warranty on your work?', 'All workmanship is backed by our 2-year labor guarantee, plus the manufacturer’s warranty on parts.' ),
			),
		),
	);
}

/* -------------------------------------------------------------------------
 * Shared blocks
 * ---------------------------------------------------------------------- */

/**
 * Inner-page hero with background photo and breadcrumb.
 *
 * @param array  $ctx      Context.
 * @param string $title    H1.
 * @param string $subtitle Intro line.
 * @param string $image    Image key.
 * @param array  $crumbs   [label => url] (last item unlinked).
 * @return array
 */
function summit_block_page_hero( $ctx, $title, $subtitle, $image, array $crumbs ) {
	$parts = array();
	foreach ( $crumbs as $label => $url ) {
		$parts[] = $url ? '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>' : '<span>' . esc_html( $label ) . '</span>';
	}

	return summit_el_section(
		array(
			summit_el_column(
				100,
				array(
					summit_w_text(
						'<p>' . implode( ' &nbsp;/&nbsp; ', $parts ) . '</p>',
						array(
							'color' => 'muted_light',
							'size'  => 15,
							'class' => 'summit-crumbs',
						)
					),
					summit_w_heading( $title, 'h1', array( 'color' => 'white', 'size' => 50 ) ),
					summit_w_text(
						'<p>' . esc_html( $subtitle ) . '</p>',
						array(
							'color' => 'muted_light',
							'size'  => 19,
						)
					),
				),
				array(
					'_inline_size' => null,
				)
			),
		),
		array_merge(
			summit_el_bg_image( $ctx['img'][ $image ], 0.85 ),
			array(
				'content_width'  => summit_el_size( 1200 ),
				'padding'        => summit_el_dims( 110, 0, 100, 0 ),
				'padding_mobile' => summit_el_dims( 64, 10, 56, 10 ),
				'css_classes'    => 'summit-page-hero-el',
			)
		)
	);
}

/**
 * Centered section heading (eyebrow + H2 + intro).
 *
 * @param string $eyebrow Label.
 * @param string $title   Heading.
 * @param string $intro   Intro text.
 * @param string $bg      Background color name.
 * @param bool   $dark    Dark background.
 * @return array
 */
function summit_block_section_title( $eyebrow, $title, $intro = '', $bg = 'white', $dark = false ) {
	$widgets = array(
		summit_w_eyebrow( $eyebrow, 'center', $dark ? 'accent_light' : 'accent' ),
		summit_w_heading( $title, 'h2', array( 'align' => 'center', 'color' => $dark ? 'white' : 'navy' ) ),
	);
	if ( $intro ) {
		$widgets[] = summit_w_text(
			'<p>' . esc_html( $intro ) . '</p>',
			array(
				'align' => 'center',
				'color' => $dark ? 'muted_light' : 'text',
			)
		);
	}
	return summit_el_section(
		array( summit_el_column( 100, $widgets, array( 'padding' => summit_el_dims( 0, 15, 0, 15 ) ) ) ),
		array_merge(
			summit_el_bg( $bg ),
			array(
				'content_width'  => summit_el_size( 760 ),
				'padding'        => summit_el_dims( 90, 0, 20, 0 ),
				'padding_mobile' => summit_el_dims( 56, 10, 10, 10 ),
			)
		)
	);
}

/**
 * Six service cards (two rows of three).
 *
 * @param array  $ctx Context.
 * @param string $bg  Background.
 * @return array Sections.
 */
function summit_block_services_grid( $ctx, $bg = 'bg' ) {
	$cards = array();
	foreach ( summit_demo_services() as $service ) {
		$url     = $ctx['url']['svc'][ $service['slug'] ];
		$cards[] = summit_el_column(
			33,
			array(
				summit_w_image( $ctx['img'][ $service['image'] ], array( 'radius' => 8, 'link' => $url, 'size' => 'medium_large' ) ),
				summit_w_heading( esc_html( $service['title'] ), 'h3', array( 'size' => 21, 'link' => $url ) ),
				summit_w_text( '<p>' . esc_html( $service['excerpt'] ) . '</p>', array( 'size' => 16 ) ),
				summit_w_button( 'Learn More', $url, 'outline-dark', array( 'icon' => 'fas fa-arrow-right' ) ),
			),
			array_merge( summit_el_card( 20, true ), array( 'padding' => summit_el_dims( 16, 16, 24, 16 ) ) )
		);
	}

	$row = static function ( $columns, $top, $bottom ) use ( $bg ) {
		return summit_el_section(
			$columns,
			array_merge(
				summit_el_bg( $bg ),
				array(
					'gap'            => 'default',
					'padding'        => summit_el_dims( $top, 0, $bottom, 0 ),
					'padding_tablet' => summit_el_dims( $top, 10, $bottom, 10 ),
					'padding_mobile' => summit_el_dims( 0, 10, $bottom ? 56 : 0, 10 ),
				)
			)
		);
	};

	return array(
		$row( array_slice( $cards, 0, 3 ), 20, 0 ),
		$row( array_slice( $cards, 3, 3 ), 10, 90 ),
	);
}

/**
 * Stats counters on navy.
 *
 * @return array
 */
function summit_block_counters() {
	$stats = array(
		array( 25, '+', 'Years in business' ),
		array( 12000, '+', 'Jobs completed' ),
		array( 1800, '+', '5-star reviews' ),
		array( 60, ' min', 'Avg. emergency response' ),
	);
	$cols  = array();
	foreach ( $stats as $stat ) {
		$cols[] = summit_el_column( 25, array( summit_w_counter( $stat[0], $stat[1], $stat[2], true ) ) );
	}
	return summit_el_section(
		$cols,
		array_merge(
			summit_el_bg( 'navy' ),
			array(
				'padding'        => summit_el_dims( 60, 0, 60, 0 ),
				'padding_mobile' => summit_el_dims( 40, 10, 40, 10 ),
			)
		)
	);
}

/**
 * "How it works" steps.
 *
 * @param string $bg Background.
 * @return array Sections.
 */
function summit_block_process( $bg = 'white' ) {
	$steps = array(
		array( 'fas fa-phone-alt', '1. Call or Book Online', 'Reach a real person 24/7, or request a quote online in under a minute.' ),
		array( 'fas fa-clipboard-list', '2. Upfront Diagnosis', 'We find the root cause and give you a flat-rate price before any work starts.' ),
		array( 'fas fa-tools', '3. Expert Repair', 'Licensed technicians fix it right the first time, with clean, respectful work.' ),
		array( 'fas fa-thumbs-up', '4. 100% Satisfaction', 'Every job is backed by our 2-year workmanship guarantee.' ),
	);
	$cols  = array();
	foreach ( $steps as $step ) {
		$cols[] = summit_el_column( 25, array( summit_w_icon_box( $step[0], $step[1], $step[2], array( 'align' => 'center' ) ) ) );
	}
	return array(
		summit_block_section_title( 'How it works', 'Getting Help Is Easy', 'No runaround and no surprise bills — just four simple steps from your call to a job well done.', $bg ),
		summit_el_section(
			$cols,
			array_merge(
				summit_el_bg( $bg ),
				array(
					'padding'        => summit_el_dims( 30, 0, 90, 0 ),
					'padding_mobile' => summit_el_dims( 20, 10, 56, 10 ),
				)
			)
		),
	);
}

/**
 * Testimonials.
 *
 * @return array Sections.
 */
function summit_block_testimonials() {
	$reviews = array(
		array( 'Our water heater burst on a Sunday night. Summit had a plumber here in 45 minutes and a new heater installed by noon Monday. Fair price, super clean work.', 'Jessica M.', 'South Austin' ),
		array( 'They found a slab leak two other companies missed and fixed it without tearing up our floors. Honest, on time and explained everything clearly.', 'David R.', 'Round Rock' ),
		array( 'Our AC died in July. The tech showed us repair vs. replace options with no pressure at all. The new system runs quieter and our bill dropped by a third.', 'Priya K.', 'Cedar Park' ),
	);
	$cols    = array();
	foreach ( $reviews as $review ) {
		$cols[] = summit_el_column(
			33,
			array(
				summit_w_text( '<p><span class="summit-stars" aria-label="5 out of 5 stars">★★★★★</span></p>', array( 'margin_bottom' => -10 ) ),
				summit_w_testimonial( $review[0], $review[1], $review[2] ),
			),
			summit_el_card( 32 )
		);
	}
	return array(
		summit_block_section_title( 'Reviews', 'What Our Neighbors Say', 'Rated 4.9 out of 5 from more than 1,800 verified Google reviews.', 'bg' ),
		summit_el_section(
			$cols,
			array_merge(
				summit_el_bg( 'bg' ),
				array(
					'gap'            => 'default',
					'padding'        => summit_el_dims( 20, 0, 90, 0 ),
					'padding_mobile' => summit_el_dims( 10, 10, 56, 10 ),
				)
			)
		),
	);
}

/**
 * Service area list + Google Map.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_block_areas_map( $ctx ) {
	$areas = array( 'Austin', 'Round Rock', 'Cedar Park', 'Pflugerville', 'Georgetown', 'Leander', 'Lakeway', 'Buda & Kyle' );
	return summit_el_section(
		array(
			summit_el_column(
				42,
				array(
					summit_w_eyebrow( 'Service area' ),
					summit_w_heading( 'Proudly Serving Greater Austin', 'h2' ),
					summit_w_text( '<p>Our trucks are stationed across Central Texas so a technician is never far away. Not sure if we cover your neighborhood? Just give us a call.</p>' ),
					summit_w_icon_list( $areas, array( 'icon' => 'fas fa-map-marker-alt' ) ),
					summit_w_spacer( 10 ),
					summit_w_button( 'Call ' . $ctx['phone'], 'tel:' . $ctx['tel'], 'primary', array( 'icon' => 'fas fa-phone-alt' ) ),
				),
				array( 'content_position' => 'center', '_inline_size_tablet' => 100 )
			),
			summit_el_column(
				58,
				array( summit_w_map( $ctx['address'], 480 ) ),
				array(
					'_inline_size_tablet' => 100,
					'border_radius'       => summit_el_dims( 12, 12, 12, 12 ),
				)
			),
		),
		summit_el_bg( 'white' )
	);
}

/**
 * Closing call-to-action band.
 *
 * @param array  $ctx     Context.
 * @param string $title   Heading.
 * @param string $text    Supporting text.
 * @return array
 */
function summit_block_cta( $ctx, $title = 'Need a Plumber or HVAC Tech Today?', $text = 'Friendly, licensed experts are standing by 24/7. Call now or request a free quote online — we’ll get back to you within 15 minutes.' ) {
	return summit_el_section(
		array(
			summit_el_column(
				62,
				array(
					summit_w_heading( $title, 'h2', array( 'color' => 'white', 'size' => 36 ) ),
					summit_w_text( '<p>' . esc_html( $text ) . '</p>', array( 'color' => 'muted_light', 'margin_bottom' => 0 ) ),
				),
				array( 'content_position' => 'center', '_inline_size_tablet' => 100 )
			),
			summit_el_column(
				38,
				array(
					summit_w_button( 'Call ' . $ctx['phone'], 'tel:' . $ctx['tel'], 'primary', array( 'icon' => 'fas fa-phone-alt', 'inline' => true ) ),
					summit_w_button( 'Free Quote', $ctx['url']['contact'], 'outline-light', array( 'inline' => true ) ),
				),
				array(
					'content_position'    => 'center',
					'_inline_size_tablet' => 100,
					'align'               => 'flex-end',
					'align_tablet'        => 'flex-start',
				)
			),
		),
		array_merge(
			summit_el_bg_image( $ctx['img']['technician-at-work'], 0.92 ),
			array(
				'padding'        => summit_el_dims( 80, 0, 80, 0 ),
				'padding_mobile' => summit_el_dims( 56, 10, 44, 10 ),
				'css_classes'    => 'summit-cta-band',
			)
		)
	);
}

/**
 * "Why choose us" split section with image.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_block_why( $ctx ) {
	return summit_el_section(
		array(
			summit_el_column(
				50,
				array( summit_w_image( $ctx['img']['technician-portrait'], array( 'class' => 'summit-media-cover' ) ) ),
				array( 'content_position' => 'center' )
			),
			summit_el_column(
				50,
				array(
					summit_w_eyebrow( 'Why choose Summit' ),
					summit_w_heading( 'Local Experts Who Treat Your Home Like Our Own', 'h2' ),
					summit_w_text( '<p>Since 2001, Austin families have trusted Summit for honest advice and work that lasts. Every technician is background-checked, drug-tested, licensed and trained in-house.</p>' ),
					summit_w_icon_list(
						array(
							'Upfront, flat-rate pricing — no surprises',
							'Licensed, insured & background-checked techs',
							'Same-day service & 24/7 emergency response',
							'2-year workmanship guarantee on every job',
						)
					),
					summit_w_spacer( 12 ),
					summit_w_button( 'More About Us', $ctx['url']['about'], 'dark', array( 'icon' => 'fas fa-arrow-right' ) ),
				),
				array(
					'content_position' => 'center',
					'padding'          => summit_el_dims( 0, 0, 0, 30 ),
					'padding_tablet'   => summit_el_dims( 0, 0, 0, 10 ),
					'padding_mobile'   => summit_el_dims( 20, 0, 0, 0 ),
				)
			),
		),
		summit_el_bg( 'white' )
	);
}

/* -------------------------------------------------------------------------
 * Pages
 * ---------------------------------------------------------------------- */

/**
 * Home page.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_page_home( $ctx ) {
	$hero = summit_el_section(
		array(
			summit_el_column(
				60,
				array(
					summit_w_eyebrow( '24/7 Emergency Service · Greater Austin, TX', 'left', 'accent_light' ),
					summit_w_heading( 'Fast, Honest Plumbing &amp; HVAC Repair You Can Trust', 'h1', array( 'color' => 'white', 'size' => 54, 'line_height' => 1.15 ) ),
					summit_w_text( '<p>Licensed technicians at your door in as little as 60 minutes. Upfront pricing, spotless work, and a 2-year guarantee on every job.</p>', array( 'color' => 'muted_light', 'size' => 19 ) ),
					summit_w_button( 'Call ' . $ctx['phone'], 'tel:' . $ctx['tel'], 'primary', array( 'icon' => 'fas fa-phone-alt', 'inline' => true ) ),
					summit_w_button( 'Our Services', $ctx['url']['services'], 'outline-light', array( 'inline' => true ) ),
					summit_w_spacer( 14 ),
					summit_w_icon_list(
						array( 'Licensed & Insured', 'Upfront Pricing', 'Same-Day Service' ),
						array(
							'inline'     => true,
							'color'      => 'white',
							'icon_color' => 'accent_light',
							'size'       => 15,
							'space'      => 26,
						)
					),
				),
				array(
					'content_position'    => 'center',
					'_inline_size_tablet' => 100,
					'padding'             => summit_el_dims( 0, 40, 0, 0 ),
					'padding_tablet'      => summit_el_dims( 0, 0, 30, 0 ),
					'padding_mobile'      => summit_el_dims( 0, 0, 20, 0 ),
				)
			),
			summit_el_column(
				40,
				array(
					summit_w_heading( 'Get a Free Quote', 'h3', array( 'size' => 24 ) ),
					summit_w_text( '<p>Tell us what’s going on — we’ll call you back within 15 minutes.</p>', array( 'size' => 15 ) ),
					summit_w_shortcode( '[summit_contact_form compact="1" button="Get My Free Quote"]' ),
				),
				array_merge(
					summit_el_card( 34 ),
					array( '_inline_size_tablet' => 100 )
				)
			),
		),
		array_merge(
			summit_el_bg_image( $ctx['img']['hero-home'], 0.86 ),
			array(
				'height'         => 'min-height',
				'custom_height'  => summit_el_size( 720 ),
				'custom_height_tablet' => summit_el_size( 0 ),
				'custom_height_mobile' => summit_el_size( 0 ),
				'content_position' => 'middle',
				'padding'        => summit_el_dims( 90, 0, 90, 0 ),
				'padding_mobile' => summit_el_dims( 56, 10, 56, 10 ),
				'css_classes'    => 'summit-hero',
			)
		)
	);

	return array_merge(
		array( $hero, summit_block_counters() ),
		array( summit_block_section_title( 'What we do', 'Plumbing, Heating & Cooling Services', 'From a dripping faucet to a brand-new AC system, one call takes care of it all. Choose a service to learn more.', 'bg' ) ),
		summit_block_services_grid( $ctx ),
		array( summit_block_why( $ctx ) ),
		summit_block_process( 'white' ),
		summit_block_testimonials(),
		array( summit_block_areas_map( $ctx ), summit_block_cta( $ctx ) )
	);
}

/**
 * About page.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_page_about( $ctx ) {
	$story = summit_el_section(
		array(
			summit_el_column(
				55,
				array(
					summit_w_eyebrow( 'Our story' ),
					summit_w_heading( 'Family-Owned and Community-Focused Since 2001', 'h2' ),
					summit_w_text( '<p>Summit Plumbing &amp; Air started with one truck, one toolbox and a simple promise: do honest work at a fair price and treat every home like it’s our own.</p><p>Twenty-five years later we’ve grown to a team of more than 40 licensed plumbers and HVAC technicians — but that promise hasn’t changed. We still answer our own phones, show up when we say we will, and stand behind every job with a 2-year workmanship guarantee.</p><p>We’re proud to sponsor local youth sports, support Habitat for Humanity builds, and hire and train apprentices from right here in Central Texas.</p>' ),
					summit_w_button( 'Meet Us — Get a Quote', $ctx['url']['contact'], 'primary', array( 'icon' => 'fas fa-arrow-right' ) ),
				),
				array(
					'content_position'    => 'center',
					'_inline_size_tablet' => 100,
					'padding'             => summit_el_dims( 0, 30, 0, 0 ),
					'padding_tablet'      => summit_el_dims( 0, 0, 30, 0 ),
				)
			),
			summit_el_column(
				45,
				array( summit_w_image( $ctx['img']['technician-portrait'], array( 'class' => 'summit-media-cover' ) ) ),
				array( 'content_position' => 'center', '_inline_size_tablet' => 100 )
			),
		),
		summit_el_bg( 'white' )
	);

	$values      = array(
		array( 'fas fa-handshake', 'Integrity First', 'We recommend only what you need, explain every option, and put the price in writing before we start.' ),
		array( 'fas fa-award', 'Craftsmanship', 'Ongoing training and quality parts mean repairs that last — backed by a 2-year labor guarantee.' ),
		array( 'fas fa-home', 'Respect for Your Home', 'Shoe covers, drop cloths and a full clean-up. We leave your home as clean as we found it.' ),
	);
	$value_cols  = array();
	foreach ( $values as $value ) {
		$value_cols[] = summit_el_column( 33, array( summit_w_icon_box( $value[0], $value[1], $value[2] ) ), summit_el_card( 34 ) );
	}
	$values_row = summit_el_section(
		$value_cols,
		array_merge(
			summit_el_bg( 'bg' ),
			array(
				'gap'            => 'default',
				'padding'        => summit_el_dims( 20, 0, 90, 0 ),
				'padding_mobile' => summit_el_dims( 10, 10, 56, 10 ),
			)
		)
	);

	$creds = summit_el_section(
		array(
			summit_el_column(
				50,
				array(
					summit_w_eyebrow( 'Credentials' ),
					summit_w_heading( 'Licensed, Insured and Certified', 'h2' ),
					summit_w_text( '<p>Your home is your biggest investment. That’s why we hold ourselves to the highest standards in the industry — and why we’re happy to show proof of every credential before we start.</p>' ),
				),
				array( 'content_position' => 'center', '_inline_size_tablet' => 100 )
			),
			summit_el_column(
				50,
				array(
					summit_w_icon_list(
						array(
							'Texas Master Plumber License #M-40127',
							'TACLA HVAC Contractor License #88214C',
							'NATE-certified HVAC technicians',
							'$2M general liability & workers’ comp insurance',
							'BBB Accredited Business — A+ rating',
							'EPA Section 608 certified refrigerant handling',
						),
						array( 'icon' => 'fas fa-shield-alt', 'size' => 17 )
					),
				),
				array_merge( summit_el_card( 36 ), array( '_inline_size_tablet' => 100 ) )
			),
		),
		summit_el_bg( 'white' )
	);

	return array_merge(
		array(
			summit_block_page_hero( $ctx, 'About Summit Plumbing & Air', 'Honest, reliable home service from a local team that’s been part of the Austin community for 25 years.', 'technician-at-work', array( 'Home' => $ctx['url']['home'], 'About Us' => '' ) ),
			$story,
			summit_block_counters(),
			summit_block_section_title( 'Our values', 'What Makes Us Different', 'The way we work is just as important as the work itself.', 'bg' ),
			$values_row,
			$creds,
		),
		summit_block_testimonials(),
		array( summit_block_cta( $ctx ) )
	);
}

/**
 * Services overview page.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_page_services( $ctx ) {
	$faq = summit_el_section(
		array(
			summit_el_column(
				40,
				array(
					summit_w_eyebrow( 'FAQ' ),
					summit_w_heading( 'Common Questions', 'h2' ),
					summit_w_text( '<p>Can’t find the answer you’re looking for? Our team is happy to help — call us any time.</p>' ),
					summit_w_button( 'Call ' . $ctx['phone'], 'tel:' . $ctx['tel'], 'primary', array( 'icon' => 'fas fa-phone-alt' ) ),
				),
				array( '_inline_size_tablet' => 100 )
			),
			summit_el_column(
				60,
				array(
					summit_w_accordion(
						array(
							array( 'Do you charge for estimates?', 'Estimates for replacements and installations are always free. For repairs, a small diagnostic fee applies and is waived when you approve the repair.' ),
							array( 'Are your technicians licensed?', 'Yes. Every plumber is licensed by the Texas State Board of Plumbing Examiners and our HVAC techs are NATE-certified. All are background-checked and drug-tested.' ),
							array( 'Do you offer a warranty?', 'All workmanship is backed by a 2-year labor guarantee, and new equipment comes with full manufacturer warranties of up to 10 years.' ),
							array( 'What payment methods do you accept?', 'We accept all major credit cards, checks, Apple Pay and Google Pay, plus flexible financing on larger projects with approved credit.' ),
						)
					),
				),
				array( '_inline_size_tablet' => 100 )
			),
		),
		summit_el_bg( 'white' )
	);

	return array_merge(
		array(
			summit_block_page_hero( $ctx, 'Our Services', 'Complete plumbing, heating and air conditioning services for Austin homes and businesses — all backed by our 2-year guarantee.', 'service-leak-detection', array( 'Home' => $ctx['url']['home'], 'Services' => '' ) ),
			summit_block_section_title( 'What we do', 'One Call Handles It All', 'Choose a service below to see what’s included, common warning signs, and answers to frequently asked questions.', 'bg' ),
		),
		summit_block_services_grid( $ctx ),
		summit_block_process( 'white' ),
		array( summit_block_counters(), $faq, summit_block_cta( $ctx ) )
	);
}

/**
 * Service detail page.
 *
 * @param array $ctx     Context.
 * @param array $service Service data.
 * @return array
 */
function summit_page_service( $ctx, $service ) {
	$paragraphs = '';
	foreach ( $service['intro'] as $p ) {
		$paragraphs .= '<p>' . esc_html( $p ) . '</p>';
	}

	$other = array();
	foreach ( summit_demo_services() as $item ) {
		$other[] = array( $item['title'], $ctx['url']['svc'][ $item['slug'] ] );
	}

	$main = summit_el_column(
		66,
		array(
			summit_w_image( $ctx['img'][ $service['image'] ], array( 'class' => 'summit-media-cover' ) ),
			summit_w_spacer( 16 ),
			summit_w_heading( esc_html( $service['title'] ) . ' in Austin, TX', 'h2', array( 'size' => 34 ) ),
			summit_w_text( $paragraphs ),
			summit_w_heading( 'What’s Included', 'h3', array( 'size' => 24 ) ),
			summit_w_icon_list( $service['included'], array( 'size' => 17 ) ),
			summit_w_spacer( 18 ),
			summit_w_heading( 'Signs You Need ' . esc_html( $service['title'] ), 'h3', array( 'size' => 24 ) ),
			summit_w_icon_list( $service['signs'], array( 'icon' => 'fas fa-exclamation-circle', 'size' => 17 ) ),
			summit_w_spacer( 18 ),
			summit_w_heading( 'Frequently Asked Questions', 'h3', array( 'size' => 24 ) ),
			summit_w_accordion( $service['faqs'] ),
		),
		array(
			'_inline_size_tablet' => 100,
			'padding'             => summit_el_dims( 0, 30, 0, 0 ),
			'padding_tablet'      => summit_el_dims( 0, 0, 40, 0 ),
		)
	);

	$sidebar = summit_el_column(
		34,
		array(
			summit_w_heading( 'Need ' . esc_html( $service['title'] ) . '?', 'h3', array( 'color' => 'white', 'size' => 24 ) ),
			summit_w_text( '<p>Talk to a licensed pro now. Upfront pricing, no obligation.</p>', array( 'color' => 'muted_light', 'size' => 16 ) ),
			summit_w_button( 'Call ' . $ctx['phone'], 'tel:' . $ctx['tel'], 'primary', array( 'icon' => 'fas fa-phone-alt', 'full' => true ) ),
			summit_w_button( 'Request a Free Quote', $ctx['url']['contact'], 'outline-light', array( 'full' => true ) ),
			summit_w_spacer( 26 ),
			summit_w_heading( 'All Services', 'h3', array( 'color' => 'white', 'size' => 20 ) ),
			summit_w_icon_list(
				$other,
				array(
					'icon'       => 'fas fa-angle-right',
					'color'      => 'white',
					'icon_color' => 'accent_light',
					'size'       => 16,
				)
			),
			summit_w_spacer( 20 ),
			summit_w_heading( 'Why Summit', 'h3', array( 'color' => 'white', 'size' => 20 ) ),
			summit_w_icon_list(
				array( '60-minute emergency response', 'Flat-rate, upfront pricing', '2-year workmanship guarantee' ),
				array(
					'color'      => 'muted_light',
					'icon_color' => 'accent_light',
					'size'       => 15,
				)
			),
		),
		array(
			'_inline_size_tablet'   => 100,
			'background_background' => 'classic',
			'background_color'      => summit_color( 'navy' ),
			'border_radius'         => summit_el_dims( 12, 12, 12, 12 ),
			'padding'               => summit_el_dims( 34, 30, 34, 30 ),
			'padding_mobile'        => summit_el_dims( 28, 22, 28, 22 ),
			'css_classes'           => 'summit-sticky-col',
		)
	);

	return array(
		summit_block_page_hero(
			$ctx,
			$service['title'],
			$service['tagline'],
			$service['image'],
			array(
				'Home'            => $ctx['url']['home'],
				'Services'        => $ctx['url']['services'],
				$service['title'] => '',
			)
		),
		summit_el_section( array( $main, $sidebar ), array_merge( summit_el_bg( 'white' ), array( 'content_position' => 'top' ) ) ),
		summit_block_counters(),
		summit_block_cta( $ctx, 'Ready to Schedule ' . $service['title'] . '?' ),
	);
}

/**
 * Contact page.
 *
 * @param array $ctx Context.
 * @return array
 */
function summit_page_contact( $ctx ) {
	$info = summit_el_column(
		40,
		array(
			summit_w_eyebrow( 'Get in touch' ),
			summit_w_heading( 'We’re Here to Help, 24/7', 'h2' ),
			summit_w_text( '<p>For emergencies, please call — a real person answers every time. For estimates and non-urgent service, send the form and we’ll respond within 15 minutes during business hours.</p>' ),
			summit_w_icon_box( 'fas fa-phone-alt', 'Call Us', '<a href="tel:' . esc_attr( $ctx['tel'] ) . '">' . esc_html( $ctx['phone'] ) . '</a><br>24/7 emergency line', array( 'position' => 'left', 'tag' => 'h3' ) ),
			summit_w_spacer( 10 ),
			summit_w_icon_box( 'fas fa-envelope', 'Email Us', '<a href="mailto:' . esc_attr( $ctx['email'] ) . '">' . esc_html( $ctx['email'] ) . '</a>', array( 'position' => 'left' ) ),
			summit_w_spacer( 10 ),
			summit_w_icon_box( 'fas fa-map-marker-alt', 'Visit Our Office', esc_html( $ctx['address'] ), array( 'position' => 'left' ) ),
			summit_w_spacer( 10 ),
			summit_w_icon_box( 'fas fa-clock', 'Office Hours', esc_html( $ctx['hours'] ) . '<br>Emergency service 24/7/365', array( 'position' => 'left' ) ),
		),
		array(
			'_inline_size_tablet' => 100,
			'padding'             => summit_el_dims( 0, 30, 0, 0 ),
			'padding_tablet'      => summit_el_dims( 0, 0, 30, 0 ),
		)
	);

	$form = summit_el_column(
		60,
		array(
			summit_w_heading( 'Request a Free Quote', 'h2', array( 'size' => 30 ) ),
			summit_w_text( '<p>Fill out the form below and a member of our team will contact you shortly.</p>', array( 'size' => 16 ) ),
			summit_w_shortcode( '[summit_contact_form]' ),
		),
		array_merge( summit_el_card( 40 ), array( '_inline_size_tablet' => 100 ) )
	);

	$map = summit_el_section(
		array( summit_el_column( 100, array( summit_w_map( $ctx['address'], 460 ) ) ) ),
		array(
			'layout'         => 'full_width',
			'gap'            => 'no',
			'padding'        => summit_el_dims( 0, 0, 0, 0 ),
			'padding_tablet' => summit_el_dims( 0, 0, 0, 0 ),
			'padding_mobile' => summit_el_dims( 0, 0, 0, 0 ),
		)
	);

	return array(
		summit_block_page_hero( $ctx, 'Contact Us', 'Call, email or request a free quote online. Emergency service is available around the clock.', 'hero-home', array( 'Home' => $ctx['url']['home'], 'Contact' => '' ) ),
		summit_el_section( array( $info, $form ), summit_el_bg( 'bg' ) ),
		$map,
	);
}
