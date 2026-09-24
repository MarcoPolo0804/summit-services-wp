<?php
/**
 * 404 template.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="summit-page-hero">
	<div class="summit-container">
		<h1><?php esc_html_e( 'Page not found', 'summit' ); ?></h1>
	</div>
</section>

<div class="summit-container summit-content summit-content--narrow">
	<p><?php esc_html_e( 'Sorry, we couldn’t find that page. Need help right away? Give us a call or request a quote.', 'summit' ); ?></p>
	<p>
		<a class="summit-btn" href="tel:<?php echo esc_attr( summit_tel( summit_opt( 'phone' ) ) ); ?>"><?php echo esc_html( summit_opt( 'phone' ) ); ?></a>
		<a class="summit-btn summit-btn--outline" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'summit' ); ?></a>
	</p>
</div>

<?php
get_footer();
