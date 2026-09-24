<?php
/**
 * Site footer.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

$summit_phone    = summit_opt( 'phone' );
$summit_email    = summit_opt( 'email' );
$summit_address  = summit_opt( 'address' );
$summit_services = summit_service_pages();
$summit_social   = array_filter(
	array(
		'facebook'  => summit_opt( 'facebook' ),
		'instagram' => summit_opt( 'instagram' ),
		'google'    => summit_opt( 'google' ),
	)
);
?>
</main>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>

	<footer class="summit-footer">
		<div class="summit-container summit-footer__main">
			<div class="summit-footer__col">
				<?php summit_brand(); ?>
				<p class="summit-footer__about"><?php echo esc_html( summit_opt( 'footer_about' ) ); ?></p>
				<?php if ( $summit_social ) : ?>
					<ul class="summit-social">
						<?php foreach ( $summit_social as $network => $url ) : ?>
							<li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php echo summit_icon( $network ); // phpcs:ignore ?><span class="screen-reader-text"><?php echo esc_html( ucfirst( $network ) ); ?></span></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="summit-footer__col">
				<h2 class="summit-footer__title"><?php esc_html_e( 'Quick Links', 'summit' ); ?></h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'summit-footer__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>

			<div class="summit-footer__col">
				<h2 class="summit-footer__title"><?php esc_html_e( 'Our Services', 'summit' ); ?></h2>
				<?php if ( $summit_services ) : ?>
					<ul class="summit-footer__list">
						<?php foreach ( $summit_services as $summit_service ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $summit_service ) ); ?>"><?php echo esc_html( get_the_title( $summit_service ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="summit-footer__col">
				<h2 class="summit-footer__title"><?php esc_html_e( 'Contact Us', 'summit' ); ?></h2>
				<ul class="summit-footer__list summit-footer__contact">
					<?php if ( $summit_phone ) : ?>
						<li><?php echo summit_icon( 'phone' ); // phpcs:ignore ?><a href="tel:<?php echo esc_attr( summit_tel( $summit_phone ) ); ?>"><?php echo esc_html( $summit_phone ); ?></a></li>
					<?php endif; ?>
					<?php if ( $summit_email ) : ?>
						<li><?php echo summit_icon( 'mail' ); // phpcs:ignore ?><a href="mailto:<?php echo esc_attr( antispambot( $summit_email ) ); ?>"><?php echo esc_html( antispambot( $summit_email ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( $summit_address ) : ?>
						<li><?php echo summit_icon( 'pin' ); // phpcs:ignore ?><span><?php echo esc_html( $summit_address ); ?></span></li>
					<?php endif; ?>
					<li><?php echo summit_icon( 'clock' ); // phpcs:ignore ?><span><?php echo esc_html( summit_opt( 'hours' ) ); ?><br><?php echo esc_html( summit_opt( 'emergency_text' ) ); ?></span></li>
				</ul>
			</div>
		</div>

		<div class="summit-footer__bottom">
			<div class="summit-container summit-footer__bottom-inner">
				<span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'summit' ); ?></span>
				<span><?php echo esc_html( summit_opt( 'license' ) ); ?></span>
			</div>
		</div>
	</footer>

<?php endif; ?>

<?php if ( $summit_phone ) : ?>
	<nav class="summit-callbar" aria-label="<?php esc_attr_e( 'Quick contact', 'summit' ); ?>">
		<a class="summit-callbar__call" href="tel:<?php echo esc_attr( summit_tel( $summit_phone ) ); ?>"><?php echo summit_icon( 'phone' ); // phpcs:ignore ?><?php esc_html_e( 'Call Now', 'summit' ); ?></a>
		<a class="summit-callbar__quote" href="<?php echo esc_url( summit_quote_url() ); ?>"><?php echo summit_icon( 'quote' ); // phpcs:ignore ?><?php esc_html_e( 'Free Quote', 'summit' ); ?></a>
	</nav>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
