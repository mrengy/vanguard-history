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

<main id="primary" class="site-main">
    <div class="content-section content-primary">
        <h1 id="tagline" class="site-heading">
            <?php echo html_entity_decode( get_bloginfo('description')); ?>
        </h1>
		<?php
		      while ( have_posts() ) :
			      the_post();

          	// get the content
          	get_template_part( 'template-parts/content', 'front-page' );
          endwhile; // End of the loop.
		    ?>
        <a id="homepage-link-to-about" class="end-of-paragraph-link" href="<?php echo site_url(); ?>/about">About the project</a>
        <section class="featured-story">
          <?php
				      show_featured_story('1992-scv');
			    ?>
        </section>
    </div>

    <div class="content-section content-secondary">

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

        <h2 class="entry-heading">Recent Uploads</h2>
        <div class="container">
            <div id="media-container" class="content-secondary-grid">
                <?php
											foreach($thumbnails as $thumbnail){
												echo($thumbnail);
											}
										?>
            </div>

            <?php
							//how many thumbnails did we load?
							$num_thumbnails_returned = $thumbnails_count;

							// only display the "show all media" button if there is more media
							if($num_thumbnails_returned >= $thumbnails_to_show){
							?>
            <div class="button-container">
                <a id="all-media" href="<?php echo(site_url());?>/media">
                    <button class="button button-primary">
                        All media
                    </button>
                </a>
            </div>
            <?php } ?>
            <div class="button-container">
                <a id="upload-material" href="<?php echo(site_url());?>/upload-material">
                    <button class="button button-primary">
                        Upload material
                    </button>
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
</main><!-- #main -->

<?php
get_vhs_footer();
