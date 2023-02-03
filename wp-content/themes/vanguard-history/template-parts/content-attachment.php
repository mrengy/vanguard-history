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

		/*
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vanguard-history' ),
				'after'  => '</div>',
			)
		);
		*/

		// adding properties to post object
		$post->{'year_object'} = get_the_terms(get_the_ID(), 'vhs_year');
		$year = $post->{'year_object'}[0]->{'name'};
		$post->{'ensemble_object'} = get_the_terms(get_the_ID(), 'ensemble');
		$ensemble = $post->{'ensemble_object'}[0]->{'name'};
		$post->{'creator_object'} = get_the_terms(get_the_ID(), 'creator_name');
		$creator = $post->{'creator_object'}[0]->{'name'};
		$post->{'submitter_object'} = get_the_terms(get_the_ID(), 'submitter_name');
		$submitter = $post->{'submitter_object'}[0]->{'name'};

		?>

		<div id="attachment-properties">
			<?php
			//displaying properties
			if(!empty($year) || !empty($ensemble)){
				echo("
					<div id='year-and-ensemble' class='attachment-property attachment-property-group'>
						<span id='year'>$year</span><span id='ensemble'>$ensemble</span>
					</div>
				");
			}
			//logic to include dl tag for creator and submitter
			if(!empty($creator) || !empty($submitter)){
				//open dl tag
				echo("<dl id='creator and submitter'>");
				if(!empty($creator)){
					echo("
						<div id='creator' class='attachment-property list-group'>
							<dt>Created by</dt>
							<dd>$creator</dd>
						</div>
					");
				}
				if(!empty($submitter)){
					echo("
						<div id='submitter' class='attachment-property list-group'>
							<dt>Uploaded by</dt>
							<dd>$submitter</dd>
						</div>
					");
				}
				// close dl tag
				echo("</dl>");
			}

			?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer ui container">
		<?php vanguard_history_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
