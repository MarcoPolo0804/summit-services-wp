<?php
/**
 * Default page template (pages not built with Elementor, e.g. Privacy Policy).
 * Elementor pages use the "Elementor Full Width" template instead.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="summit-page-hero">
		<div class="summit-container">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>

	<div class="summit-container summit-content summit-content--narrow">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>
	<?php
endwhile;

get_footer();
