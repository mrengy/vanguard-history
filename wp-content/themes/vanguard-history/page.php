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
	<div class="content-section content-secondary content-page">
		<?php
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		/*
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			*/
		endwhile; // End of the loop.
		?>
	</div>

</main><!-- #main -->

<?php
// show disclaimer in footer, unless this is the disclaimer page itself
if(!is_page('disclaimer')){
	dynamic_sidebar('pre-footer');
}
get_vhs_footer();
