<?php
/**
 * Fallback template for posts, archives and search.
 *
 * @package Summit
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="summit-page-hero">
	<div class="summit-container">
		<h1>
			<?php
			if ( is_singular() ) {
				single_post_title();
			} elseif ( is_search() ) {
				/* translators: %s: search query. */
				printf( esc_html__( 'Search results for “%s”', 'summit' ), esc_html( get_search_query() ) );
			} elseif ( is_archive() ) {
				the_archive_title();
			} else {
				esc_html_e( 'Latest News & Tips', 'summit' );
			}
			?>
		</h1>
	</div>
</section>

<div class="summit-container summit-content summit-content--narrow">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'summit-entry' ); ?>>
				<?php if ( ! is_singular() ) : ?>
					<h2 class="summit-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="summit-entry__meta"><?php echo esc_html( get_the_date() ); ?></div>
				<?php endif; ?>

				<?php if ( is_singular() ) : ?>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				<?php else : ?>
					<?php the_excerpt(); ?>
					<a class="summit-btn summit-btn--outline" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'summit' ); ?></a>
				<?php endif; ?>
			</article>

			<?php
			if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}
		endwhile;
		?>

		<div class="summit-pagination"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found here yet.', 'summit' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
