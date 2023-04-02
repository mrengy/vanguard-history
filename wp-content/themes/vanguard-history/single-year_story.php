<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Vanguard_History
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		// Get the content
		get_template_part('template-parts/content', 'year-story');

		//get taxonomies from the post
		$this_ensemble = wp_get_post_terms(get_the_ID(), 'ensemble')[0]->slug;
		$this_year = wp_get_post_terms(get_the_ID(), 'vhs_year')[0]->slug;

		// how many media thumbnails to show at first
		$thumbnails_to_show = 6;

		// query media
		$media_query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'any',

			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'ensemble',
					'field' => 'slug',
					'terms' => $this_ensemble,
				),
				array(
					'taxonomy' => 'vhs_year',
					'field' => 'slug',
					'terms' => $this_year,
				),
				array(
					'taxonomy' => 'media_visibility',
					'field' => 'slug',
					'terms' => 'published',
				),
			),

			'posts_per_page' => $thumbnails_to_show,
		);
		$media_query = new WP_Query($media_query_args);

		$thumbnails = array();

		vanguard_history_populate_thumbnails($media_query);

		$thumbnails_count = count($thumbnails);

		// Be kind; rewind
		wp_reset_postdata();

		if ($thumbnails_count > 0) { ?>
			<div class="content-secondary content-section">
				<h2 class="entry-heading">Media</h2>
				<div class="container">
					<div id="media-container" class="content-secondary-grid" data-year="<?php echo $this_year ?>" data-ensemble="<?php echo $this_ensemble ?>">
						<?php

						foreach ($thumbnails as $thumbnail) {
							echo ($thumbnail);
						}

						?>
					</div>
					<?php

					//how many thumbnails did we load?
					$num_thumbnails_returned = $thumbnails_count;

					// only display the "show all media" button if there is more media
					if ($num_thumbnails_returned >= $thumbnails_to_show) { ?>
						<div class="button-container">
							<button class="show-hide button button-primary" id="show-all-media">
								Show <span class="button-action">more</span> media
							</button>
						</div>
					<?php } ?>
					<div class="button-container">
						<a href="/upload-material">
							<button class="button button-primary" id="upload-material">
								<span class="button-action">Upload</span> Material
							</button>
						</a>
					</div>
				</div>
			</div>
		<?php } ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	/*
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			*/
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
dynamic_sidebar('pre-footer');
get_vhs_footer();
?>
