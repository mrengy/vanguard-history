<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

?>

<section class="no-results not-found">
	<!--
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'vanguard-history' ); ?></h1>
		</header>
	-->
	<!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'vanguard-history' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
			<!--
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vanguard-history' ); ?></p>
			-->
			<?php
			show_404_in_page();

		else :
			?>
			<!--
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'vanguard-history' ); ?></p>
			-->
			<?php
			show_404_in_page();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
