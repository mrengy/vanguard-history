<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			//the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				vanguard_history_posted_on();
				vanguard_history_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$attachment_id = get_the_ID();
		// If this attachment is an Image, show the large size
		if ( wp_attachment_is_image( $attachment_id ) ) {
		    $attachment_image = wp_get_attachment_image($attachment_id, '', '', array('class' => 'post-thumbnail', 'size' => 'large', 'alt' => the_title_attribute(array('post'=>$attachment_id,'echo'=>0)) ) );
		    echo $attachment_image;
		    echo '<div class="caption">' . get_the_excerpt() . '</div>';
		} else {
			the_content(
				sprintf(
					wp_kses(
						// translators: %s: Name of current post. Only visible to screen readers
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'vanguard-history' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		}
		?>
		<pre>
			<?php
				// adding properties to post object
				$post->{'year_object'} = get_the_terms(get_the_ID(), 'vhs_year');
				$post->{'year'} = $post->{'year_object'}[0]->{'name'};
				$post->{'ensemble_object'} = get_the_terms(get_the_ID(), 'ensemble');
				echo $post->{'ensemble'} = $post->{'year_object'}[0]->{'name'};
				print_r($post);
			?>
		</pre>
	</div><!-- .entry-content -->

	<footer class="entry-footer ui container">
		<?php vanguard_history_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
