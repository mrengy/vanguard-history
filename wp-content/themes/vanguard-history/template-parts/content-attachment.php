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
		$attachment_id = get_the_ID();
		if (wp_attachment_is('audio', $attachment_id)){
			//the_title('<h1 class="entry-title">', '</h1>');
		}

		if ('post' === get_post_type()) :
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
		<div class=" media">
			<?php
			// If this attachment is an Image, show the large size
			if (wp_attachment_is('image', $attachment_id)) {
				$attachment_image = wp_get_attachment_image($attachment_id, '', '', array('class' => 'post-thumbnail', 'size' => 'large', 'alt' => the_title_attribute(array('post' => $attachment_id, 'echo' => 0))));
				echo $attachment_image;
				echo '<div class="wp-caption-text">' . get_the_excerpt() . '</div>';
			} else if (wp_attachment_is('video', $attachment_id)) {
				$attachment_video = wp_get_attachment_url($attachment_id);
				echo do_shortcode('[videopack id='.$attachment_id.' caption="&nbsp;"]'.$attachment_video.'[/videopack]');
				//echo $attachment_video;
				echo '<div class="wp-caption-text">' . get_the_excerpt() . '</div>';
			} else if (wp_attachment_is('audio', $attachment_id)) {
				$attachment_audio = wp_get_attachment_url($attachment_id);
				$attr = array(
					"src" => $attachment_audio,
					"preload" => true
				);
				echo wp_audio_shortcode($attr);
			} else {
				the_content(
					sprintf(
						wp_kses(
							// translators: %s: Name of current post. Only visible to screen readers
							__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'vanguard-history'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
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

			$caption_array = array();

			// Year
			if (!empty($year)) {
				array_push($caption_array, $year);
			}

			// Space between year and ensemble
			if (!empty($year) && !empty($ensemble)) {
				array_push($caption_array, ' ');
			}

			// Ensemble
			if (!empty($ensemble) && $ensemble != 'Other') {
				array_push($caption_array, $ensemble);
			}

			// Period after year and ensemble
			if (!empty($year) || !empty($ensemble)) {
				array_push($caption_array, '.');
			}

			// Space between period and creator
			if ((!empty($year) || !empty($ensemble)) && (!empty($creator) || !empty($submitter))) {
				array_push($caption_array, ' ');
			}

			// Creator
			if (!empty($creator)) {
				array_push($caption_array, 'Created by ' . $creator);
			}

			// Comma between creator and submitter
			if (!empty($creator) && !empty($submitter)) {
				array_push($caption_array, ', ');
			}

			// Submitter
			if (!empty($submitter)) {
				array_push($caption_array, 'Submitted by ' . $submitter);
			}



			?>
		</div>
		<div id="attachment-properties" class="properties-container">
			<?php echo join($caption_array); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
