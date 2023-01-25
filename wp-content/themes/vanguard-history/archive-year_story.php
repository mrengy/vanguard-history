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
		?>
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
			<?php if ( $scv_year_stories_query->have_posts() ) :
			/* Start the Loop */
			while ( $scv_year_stories_query->have_posts() ) :
				$scv_year_stories_query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_vhs_footer();
