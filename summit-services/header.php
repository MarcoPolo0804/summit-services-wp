<?php
/**
 * Site header.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

$summit_phone = summit_opt( 'phone' );
$summit_email = summit_opt( 'email' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'summit' ); ?></a>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>

	<div class="summit-topbar">
		<div class="summit-container summit-topbar__inner">
			<div class="summit-topbar__group">
				<span class="summit-topbar__item"><?php echo summit_icon( 'clock' ); // phpcs:ignore ?><?php echo esc_html( summit_opt( 'hours' ) ); ?></span>
				<span class="summit-topbar__item summit-topbar__hide-tablet"><?php echo summit_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( summit_opt( 'service_area' ) ); ?></span>
			</div>
			<div class="summit-topbar__group">
				<?php if ( $summit_email ) : ?>
					<a class="summit-topbar__item summit-topbar__hide-tablet" href="mailto:<?php echo esc_attr( antispambot( $summit_email ) ); ?>"><?php echo summit_icon( 'mail' ); // phpcs:ignore ?><?php echo esc_html( antispambot( $summit_email ) ); ?></a>
				<?php endif; ?>
				<?php if ( $summit_phone ) : ?>
					<a class="summit-topbar__item summit-topbar__emergency" href="tel:<?php echo esc_attr( summit_tel( $summit_phone ) ); ?>"><?php echo summit_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( summit_opt( 'emergency_text' ) . ': ' . $summit_phone ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<header id="masthead" class="summit-header">
		<div class="summit-container summit-header__inner">
			<?php summit_brand(); ?>

			<nav id="site-navigation" class="summit-nav" aria-label="<?php esc_attr_e( 'Primary', 'summit' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'summit-nav__menu',
						'menu_id'        => 'primary-menu',
						'depth'          => 2,
						'fallback_cb'    => 'summit_menu_fallback',
					)
				);
				?>
			</nav>

			<div class="summit-header__actions">
				<?php if ( $summit_phone ) : ?>
					<a class="summit-header__phone" href="tel:<?php echo esc_attr( summit_tel( $summit_phone ) ); ?>">
						<span class="summit-header__phone-icon"><?php echo summit_icon( 'phone' ); // phpcs:ignore ?></span>
						<span class="summit-header__phone-text">
							<span class="summit-header__phone-label"><?php esc_html_e( 'Call us anytime', 'summit' ); ?></span>
							<span class="summit-header__phone-number"><?php echo esc_html( $summit_phone ); ?></span>
						</span>
						<span class="screen-reader-text"><?php esc_html_e( 'Call us', 'summit' ); ?></span>
					</a>
				<?php endif; ?>

				<a class="summit-btn" href="<?php echo esc_url( summit_quote_url() ); ?>"><?php echo esc_html( summit_opt( 'header_cta_text' ) ); ?></a>

				<button class="summit-menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false">
					<?php echo summit_icon( 'menu', 'summit-icon--open' ); // phpcs:ignore ?>
					<?php echo summit_icon( 'close', 'summit-icon--close' ); // phpcs:ignore ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'summit' ); ?></span>
				</button>
			</div>
		</div>
	</header>

<?php endif; ?>

<main id="content" class="summit-main">
