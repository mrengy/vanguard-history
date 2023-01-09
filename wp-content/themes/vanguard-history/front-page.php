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
		<div id="tagline">
			<?php echo html_entity_decode( get_bloginfo('description')); ?>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'front-page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_vhs_footer();
