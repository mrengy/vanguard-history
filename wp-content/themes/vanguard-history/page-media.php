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

<main id="primary" class="site-main content-section content-secondary">

    <?php
		while ( have_posts() ) :
			the_post();

			// get the content
			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

    <?php
			// query media
			// how many media thumbnails to show at first. -1 means all
			$thumbnails_to_show = 42;

      //Protect against arbitrary paged values
      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

			// query media
			$media_query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'any',
				'order' => 'DESC',
				'orderby' => 'date',
        'paged' => $paged,
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

    <div id="media-container" class="content-secondary-grid">
        <?php
											foreach($thumbnails as $thumbnail){
												echo($thumbnail);
											}
										?>
    </div>
    <?php
			//how many thumbnails did we load? might not need this.
			$num_thumbnails_returned = $thumbnails_count;

      // pagination

      // if ($thumbnails_count > $thumbnails_to_show){

      $big = 999999999; // need an unlikely integer
      $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string
      $paginate_args = array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      	'format' => '?paged=%#%',
      	'current' => max( 1, get_query_var('paged') ),
      	'total' => $media_query->max_num_pages,
        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
      );

        echo("<div id='pagination'>");
          echo paginate_links($paginate_args);
        echo("</div>");
      //}
		?>
    <div class="button-container">
        <a id="upload-material" href="<?php echo(site_url());?>/upload-material">
            <button class="button button-primary">
                Upload material
            </button>
        </a>
    </div>

    <?php } ?>

</main><!-- #main -->

<?php
get_vhs_footer();
