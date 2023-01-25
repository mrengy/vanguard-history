<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

get_header();
?>

	<main id="primary" class="site-main ui container">
			<div class="content-section content-intro">
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
					<div class="archive-content">
						Not all years show here yet since we're building out these stories bit by bit.
						<a id="archive-link-to-about" class="end-of-paragraph-link" href="<?php echo site_url(); ?>/about">About the project</a>
					</div>
				</header><!-- .page-header -->
			</div>
			<?php
				$scv_year_stories_query_args = array(
					'post_type'   => 'year_story',
					'order' => 'DESC',
					'orderby' => 'title',

					'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'ensemble',
								'field' => 'slug',
								'terms' => 'Vanguard',
							),
					),

					'posts_per_page' => -1,
				);
				$scv_year_stories_query = new WP_Query($scv_year_stories_query_args);

				$scv_year_stories = array();

				if ( $scv_year_stories_query->have_posts() ) :
					/* Start the Loop */
					$i = 0;
					while ( $scv_year_stories_query->have_posts() ) :
						$scv_year_stories_query->the_post();
						// store stories in array
						$scv_year_stories[] = get_post(get_the_ID());

						// adding properties to year story object
						$scv_year_stories[$i]->{'year_object'} = get_the_terms(get_the_ID(), 'vhs_year');
						$scv_year_stories[$i]->{'year'} = $scv_year_stories[$i]->{'year_object'}[0]->{'slug'};
						$scv_year_stories[$i]->{'show_title'} = get_field('show_title');
						$i++;

					endwhile;

				endif;

				$scv_year_stories_count = count($scv_year_stories);

				if($scv_year_stories_count>0){
		?>
						<div id="year-stories-scv-container" class="archive-container">
							<h2 class="ensemble-heading">
								SCV
							</h2>
							<ul id="year-stories-scv-list" class="archive-list">
								<?php foreach($scv_year_stories as $scv_year_story){
										$this_link = $scv_year_story->{'guid'};
										$this_year = $scv_year_story->{'year'};
										$this_show_title = $scv_year_story->{'show_title'};
										if (!empty($this_show_title)){
											echo("
													<li>
														<a href='$this_link'>
															<span class='year'>
																$this_year
															</span>
															<span class='separator'>
																&#8212;
															</span>
															<span class='show-title'>
																$this_show_title
															</span>
														</a>
													</li>
											");
									} else{
										echo("
												<li>
													<a href='$this_link'>
														<span class='year'>
															$this_year
														</span>
													</a>
										   </li>
											");
									}
								}?>
							</ul>
						</div>
		<?php	}

				// Be kind; rewind
				wp_reset_postdata();

				// end SCV year stories list

			$cadets_year_stories_query_args = array(
				'post_type'   => 'year_story',
				'order' => 'DESC',
				'orderby' => 'title',

				'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'ensemble',
							'field' => 'slug',
							'terms' => 'Vanguard Cadets / B-Corps',
						),
				),

				'posts_per_page' => -1,
			);
			$cadets_year_stories_query = new WP_Query($cadets_year_stories_query_args);

			$cadets_year_stories = array();

			if ( $cadets_year_stories_query->have_posts() ) :
				/* Start the Loop */
				$i = 0;
				while ( $cadets_year_stories_query->have_posts() ) :
					$cadets_year_stories_query->the_post();
					// store stories in array
					$cadets_year_stories[] = get_post(get_the_ID());

					// adding properties to year story object
					$cadets_year_stories[$i]->{'year_object'} = get_the_terms(get_the_ID(), 'vhs_year');
					$cadets_year_stories[$i]->{'year'} = $cadets_year_stories[$i]->{'year_object'}[0]->{'slug'};
					$cadets_year_stories[$i]->{'show_title'} = get_field('show_title');
					$i++;

				endwhile;

			endif;

			$cadets_year_stories_count = count($cadets_year_stories);

			if($cadets_year_stories_count>0){
	?>
					<div id="year-stories-cadets-container" class="archive-container">
						<h2 class="ensemble-heading">
							Vanguard Cadets / B-Corps
						</h2>
						<ul id="year-stories-cadets-list" class="archive-list">
							<?php foreach($cadets_year_stories as $cadets_year_story){
									$this_link = $cadets_year_story->{'guid'};
									$this_year = $cadets_year_story->{'year'};
									$this_show_title = $cadets_year_story->{'show_title'};
									if (!empty($this_show_title)){
										echo("
												<li>
													<a href='$this_link'>
														<span class='year'>
															$this_year
														</span>
														<span class='separator'>
															&#8212;
														</span>
														<span class='show-title'>
															$this_show_title
														</span>
													</a>
												</li>
										");
								} else{
									echo("
											<li>
												<a href='$this_link'>
													<span class='year'>
														$this_year
													</span>
												</a>
									   </li>
										");
								}
							}?>
						</ul>
					</div>
	<?php	}

			// Be kind; rewind
			wp_reset_postdata();

			// end Cadets year stories list
	?>

	</main><!-- #main -->

<?php
get_vhs_footer();
