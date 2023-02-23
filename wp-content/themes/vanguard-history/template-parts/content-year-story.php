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
    <div class="content-section content-primary">
        <header class="entry-header">
            <?php
				the_title( '<h1 class="entry-title">', '</h1>' );
			?>
        </header><!-- .entry-header -->

        <?php

    //hide featured image for now
		//vanguard_history_post_thumbnail();

		//only show year story video on single year story pages
		$year_story_video = get_field('year_story_video');

		if(!empty($year_story_video)){
			echo <<<END
				<div class="year-story-video">
					$year_story_video
				</div>
			END;
		} else {
			echo('<div class="featured-image">');
			vanguard_history_post_thumbnail();
			echo('</div>');
		}

		if(has_excerpt()){
			the_excerpt();
		}
	?>

		<?php 
			// only display show full story link if there is post content
			$this_content = get_the_content();
			if(!empty($this_content)){
				echo <<<END
					<button class="show-hide button button-text" id="show-hide-full-story">
					<span class="button-action">Show</span>
						Full Story
					</button>
				END;
			} else{
				// empty post content message
				echo("We don't have a story for this year yet. Help us write one. Get in touch at ");
				$email = antispambot('history@scvanguard.org');
				echo <<<END
					<a href="mailto:$email">
						$email
					</a>
				END;
			}
		?>
        <section id="story" class="year-story" hidden="hidden">
            <?php

			// determine whether we have any authors set for this year story
			$year_story_authors = wp_get_post_terms(get_the_ID(),'year_story_author');
			$num_year_story_authors = count($year_story_authors);
			$year_story_author_counter = 0;

			if($num_year_story_authors > 0){
				//display year story authors
				echo("
					<div class='authors'>
						Written by 
				");
				foreach ($year_story_authors as $i){
					echo($i->name);

					//if it's not the last author, add a comma and space before the next author
					$year_story_author_counter ++;
					if($year_story_author_counter < $num_year_story_authors){
						echo(", ");
					}
				}
				echo("
					</div>
				");
			}

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
        </section>
    </div>

    <div class="entry-content year-section">
        <!--story-->
        <section id="show-info">
		<?php
				$show_piece_counter = 0;
				if(have_rows('show_pieces')){
				$show_pieces = get_field('show_pieces');
			?>
			<?php 
				// only show "repertoire" heading if there are pieces to display. 
				// https://stackoverflow.com/a/18401706/370407
				if(!empty($show_pieces['show_piece_1']['show_piece_title'])){
					echo <<<END
						<h2 id="repertoire" class="entry-heading">
							Repertoire
						</h2>
					END;
				}
			?>
			<?php 
				$this_show_title = get_field('show_title');
				if (!empty($this_show_title)){
					echo <<<END
						<div id="show-title" class="year-show-title">
							"$this_show_title"
						</div>
					END;
				}
			?>
            <dl id="show-pieces">
                <?php
						while(have_rows('show_pieces')){ the_row();
							foreach($show_pieces as $show_piece){
								if( empty($show_piece['show_piece_title'] )){
									continue;
								} else {
										echo("<dt class='year-piece-title'>".$show_piece['show_piece_title']."</dt>");
										echo("<dd class='year-piece-composer'>".$show_piece['show_piece_composer']."</dd>");
										//do_action( 'qm/debug', $show_piece );
								}
							}
					?>
                <?php
						} //while(have_rows)('show_pieces')): the_row():
					?>
            </dl>
            <?php
				} //have_rows('show_pieces')

				$this_final_score = get_field('final_score');
				$this_final_placement = get_field('final_placement');
				if(!empty($this_final_score)){
					echo <<<END
						<div id="final-score-info">
							<h2 id=" final-score-heading" class="entry-heading">
								Final Score
							</h2>
							<div class="year-score-placement">
								<span id="final-score">$this_final_score</span>
								<span id="final-placement">($this_final_placement)</span>
							</div>
						</div>
					END;
				}
			?>
        </section><!-- show-info-->
    </div><!-- .entry-content -->

    <footer class="entry-footer ui container">
        <?php vanguard_history_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
