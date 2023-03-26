<?php

/**
 * The template for displaying attachments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#attachment
 *
 * @package Vanguard_History
 */

get_header();
?>

<main id="primary" class="site-main content-section content-secondary">

	<?php
	while (have_posts()) :
		the_post();

		$post->{'media_visibility'} = get_the_terms(get_the_ID(), 'media_visibility');
		$media_visibility = $post->{'media_visibility'}[0]->{'slug'};

		//only display attachment if the "visibility" is set to "published"
		if($media_visibility == 'published'){
			get_template_part('template-parts/content', get_post_type());
		} else {
			show_404_in_page();
		}

	/*
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'vanguard-history' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'vanguard-history' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			*/
	//currently can go back to a parent page but want to navigate through in order shown on media page
	/*
			previous_post_link();
			next_post_link();
			*/
	/*
			$vhs_previous_link = get_previous_image_link('large');
			$vhs_next_link = get_next_image_link('large');
			?>

    <nav id="previous-next-nav">
        <?php
			// these are not displaying, but it seems to be showing up somehow
			if (!empty($vhs_previous_link)){
					echo("<div id='previous'>
						Previous: $vhs_previous_link
					</div>");
			}

			if (!empty($vhs_next_link)){
					echo("<div id='next'>
						Next: $vhs_next_link
					</div>");
			}
			?>
    </nav>

    <?php
			*/
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
