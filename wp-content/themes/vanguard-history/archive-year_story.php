<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

get_header();
?>

	<main id="primary" class="site-main ui container">
			<div class="content-section content-intro">
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
					<div class="archive-content">
						Not all years show here yet since we're building out these stories bit by bit.
						<a id="archive-link-to-about" class="end-of-paragraph-link" href="<?php echo site_url(); ?>/about">About the project</a>
					</div>
				</header><!-- .page-header -->
			</div>
			<?php
				$scv_year_stories_query_args = array(
					'post_type'   => 'year_story',
					'post_status' => 'publish',
					'order' => 'DESC',
					'orderby' => 'title',

					'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'ensemble',
								'field' => 'slug',
								'terms' => 'Vanguard',
							),
					),

					'posts_per_page' => -1,
				);
				$scv_year_stories_query = new WP_Query($scv_year_stories_query_args);

				$scv_year_stories = array();

				if ( $scv_year_stories_query->have_posts() ) :
					/* Start the Loop */
					while ( $scv_year_stories_query->have_posts() ) :
						$scv_year_stories_query->the_post();
						// store stories in array
						$scv_year_stories[] = get_post(get_the_ID());

					endwhile;

				endif;

				$scv_year_stories_count = count($scv_year_stories);

				// Be kind; rewind
				wp_reset_postdata();
			?>

	</main><!-- #main -->

<?php
get_vhs_footer();
