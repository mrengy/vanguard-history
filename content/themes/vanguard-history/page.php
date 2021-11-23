<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

get_header();
?>

	<main id="primary" class="site-main ui container">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// show media with first tag used on page
			$first_tag = wp_get_post_terms(get_the_ID(),'post_tag')[0]->slug;

			//do_action('qm/debug', $first_tag);

			// query media
			$media_query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'any',

				'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $first_tag,
						),
						array(
							'taxonomy' => 'media_visibility',
							'field' => 'slug',
							'terms' => 'published',
						),
				),

				'posts_per_page' => -1,
			);
			$media_query = new WP_Query ($media_query_args);

			$thumbnails = array();

			if ( $media_query->have_posts() ) : while ( $media_query->have_posts() ) : $media_query->the_post();
					// store thumbnails in array
					$thumbnails[] = wp_get_attachment_link( get_the_ID(), 'thumbnail', true );

				endwhile;
				//only show heading if there are items to show
				echo('<h2>Media</h2>');
			endif; // end of media loop

			// Be kind; rewind
			wp_reset_postdata();

			//display media
			?>
			<div id="media-container" class= "ui grid">
			<?php
				foreach($thumbnails as $thumbnail){
					echo($thumbnail);
				}
			?>
			</div>
			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
