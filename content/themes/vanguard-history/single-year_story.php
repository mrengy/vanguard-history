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

	<main id="primary" class="site-main ui container">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'vanguard-history' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'vanguard-history' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			?>
			<h2>Media</h2>
			<?php
					// query media
					$media_query_args = array(
						'post_type'   => 'attachment',
						'post_status' => 'any',

						'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'ensemble',
									'field' => 'slug',
									'terms' => array('vanguard-cadets-b-corps'),
								),
								array(
									'taxonomy' => 'year',
									'field' => 'slug',
									'terms' => array('1991'),
								),
						),

						'posts_per_page' => -1,
					);
					$media_query = new WP_Query ($media_query_args);

					//log to query monitor
					do_action( 'qm/debug', $media_query);

					$thumbnails = array();

					if ( $media_query->have_posts() ) : while ( $media_query->have_posts() ) : $media_query->the_post();
							// store thumbnails in array
							$thumbnails[] = wp_get_attachment_link( get_the_ID(), 'thumbnail', true );

					endwhile; endif; // end of media loop

					// Be kind; rewind
					wp_reset_postdata();

					//display media
					foreach($thumbnails as $thumbnail){
						echo($thumbnail);
					}

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
