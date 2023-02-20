<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vanguard_History
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

    <?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
    <h2 class="comments-title">
        <?php
			$vanguard_history_comment_count = get_comments_number();
			if ( '1' === $vanguard_history_comment_count ) {
				echo('One comment');
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comment', '%1$s comments', $vanguard_history_comment_count, 'comments title', 'vanguard-history' ) ),
					number_format_i18n( $vanguard_history_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
			?>
    </h2><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
        <?php
			wp_list_comments(
				array(
					'walker'     	=> new Custom_Walker_Comment(),
					'style'      	=> 'ol',
					'short_ping'  	=> true,
					'type' 		  	=> 'comment',
					'avatar_size' 	=> 80,
				)
			);
			?>
    </ol><!-- .comment-list -->

    <?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :?>
    <p class="no-comments">
        <?php esc_html_e( 'Comments are closed.', 'vanguard-history' ); ?>
    </p>
    <?php
		endif;
	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
