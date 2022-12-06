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
			the_title( '<h1 class="entry-title">', '</h1>' );
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

	<?php

		vanguard_history_post_thumbnail();

		//only show year story video on single year story pages
		if(is_single()){
			$year_story_video = get_field('year_story_video');

			if(isset($year_story_video)){
				echo(
					'<div id ="year story video">'.
					$year_story_video.
					'</div>'
				);
			}

			if(has_excerpt()){
				the_excerpt();
			}

		}
	?>

	<div class="entry-content">
		<section id="story">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
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

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vanguard-history' ),
					'after'  => '</div>',
				)
			);
			?>
		</section><!--story-->
		<section id="show-info">
			<h2 id="repertoire">
				Repertoire
			</h2>
			<div id="show-title">
				<?php the_field('show_title');?>
			</div>
				<?php
					$show_piece_counter = 0;
					if(have_rows('show_pieces')){

					$show_piece_fields = get_field_object('show_pieces');
					/*
					$non_empty_show_piece_fields = array_filter($show_piece_fields['value'], function($x) { return ($x !== ""); });
					$count_non_empty_show_piece_fields = count($non_empty_show_piece_fields);
					echo ($count_non_empty_show_piece_fields);

					do_action( 'qm/debug', $non_empty_show_piece_fields );
					*/
					//do_action( 'qm/debug', $show_piece_fields );
					$show_pieces = get_field('show_pieces');
					$count_show_pieces = count(get_field('show_pieces'));
					do_action( 'qm/debug', $count_show_pieces );

				?>
				<dl id="show-pieces">
					<?php
						while(have_rows('show_pieces')){ the_row();
							$show_piece_counter ++;

							foreach($show_pieces as $show_piece){
								echo ('show piece |');
							}
							/*
							$this_row_debug = get_row();
							do_action( 'qm/debug', $this_row_debug );
							*/

							if(have_rows('show_piece_'.$show_piece_counter)){
								while(have_rows('show_piece_'.$show_piece_counter)){ the_row();


								$inner_row_debug = get_row();
								do_action( 'qm/debug', $inner_row_debug );
								do_action( 'qm/debug', $show_piece_counter );
					?>
								<dt> <?php the_sub_field('show_piece_title'); ?> </dt>
								<dd> <?php the_sub_field('show_piece_composer'); ?> </dd>
					<?php
								} //while(have_rows('show_pieces')): the_row();
							} //if(have_rows('show_pieces')):

					?>
					<?php
						} //while(have_rows)('show_pieces')): the_row():
					?>
				</dl>
			<?php
				} //have_rows('show_pieces')
			?>
			<div id="final-score-info">
				<h2 id="final-score-heading">
					Final Score
				</h2>
				<div id="final-score">

				</div>
				<div id="final-placement">
					()
				</div>
			</div>
		</section><!-- show-info-->
	</div><!-- .entry-content -->

	<footer class="entry-footer ui container">
		<?php vanguard_history_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
