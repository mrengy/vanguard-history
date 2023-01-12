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
		<h1 id="tagline">
			<?php echo html_entity_decode( get_bloginfo('description')); ?>
		</h1>
		<a id="homepage-link-to-about" href="<?php echo site_url(); ?>/about">About the project</a>
		<section id="featured-story">
			<?php
				show_featured_story('2001-scv');
			?>
		</section>
		<?php
		while ( have_posts() ) :
			the_post();

			// get the content
			get_template_part( 'template-parts/content', 'front-page' );
		endwhile; // End of the loop.
		?>

		<?php
			// query media
			// how many media thumbnails to show at first
			$thumbnails_to_show = 6;

			// query media
			$media_query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'any',
				'order' => 'DESC',
				'orderby' => 'date',

				'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'media_visibility',
							'field' => 'slug',
							'terms' => 'published',
						),
				),

				'posts_per_page' => $thumbnails_to_show,
			);
			$media_query = new WP_Query ($media_query_args);

			$thumbnails = array();

			if ( $media_query->have_posts() ) : while ( $media_query->have_posts() ) : $media_query->the_post();
					// store thumbnails in array
					$thumbnails[] = wp_get_attachment_link( get_the_ID(), 'thumbnail', true );

				endwhile;

			endif; // end of media loop

			$thumbnails_count = count($thumbnails);

			// Be kind; rewind
			wp_reset_postdata();

			if ($thumbnails_count>0) { ?>
		    <div class="year-media year-section media-grid">
		        <h2 class="entry-heading">Media</h2>
		        <div class="container">
		            <div id="media-container" class="all-media-grid">
		                <?php
											foreach($thumbnails as $thumbnail){
												echo($thumbnail);
											}
										?>
        				</div>

						<?php
						//how many thumbnails did we load?
						$num_thumbnails_returned = $thumbnails_count;
						?>
	            <div class="button-container">
								<?php
								// only display the "show all media" button if there is more media
								if($num_thumbnails_returned >= $thumbnails_to_show){
								?>
	                <button class="show-hide button button-primary" id="show-more-media">
	                    Show <span class="button-action">more</span> media
	                </button>
								<?php } ?>
								<a class="button button-primary" id="upload-material" href="<?php echo(site_url());?>/upload-material">
										Upload material
								</a>
	            </div>
        		</div>
    		</div>
    <?php } ?>
	</main><!-- #main -->

<?php
get_vhs_footer();
