<?php

/**
 * Vanguard History functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vanguard_History
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('vanguard_history_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vanguard_history_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Vanguard History, use a find and replace
		 * to change 'vanguard-history' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('vanguard-history', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'vanguard-history'),
				'footer-calls-to-action' => esc_html__('Footer Calls to Action', 'vanguard-history'),
				'footer-1' => esc_html__('Footer 1', 'vanguard-history'),
				'footer-2' => esc_html__('Footer 2', 'vanguard-history'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'vanguard_history_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'vanguard_history_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vanguard_history_content_width()
{
	$GLOBALS['content_width'] = apply_filters('vanguard_history_content_width', 640);
}
add_action('after_setup_theme', 'vanguard_history_content_width', 0);

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vanguard_history_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'vanguard-history'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'vanguard-history'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'			=> esc_html__('Pre-footer', 'vanguard-history'),
			'id'			=> 'pre-footer',
			'description'	=> esc_html__('Shown immediately before footer', 'vanguard-history'),
			'before_widget' => '<section id="%1$s" class="widget %2$s disclaimer">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'vanguard_history_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function vanguard_history_scripts()
{
	wp_enqueue_style('vanguard-history-style', get_stylesheet_uri(), array(), false);

	wp_enqueue_script('vanguard-history-navigation', get_template_directory_uri() . '/js/custom/navigation.js', array(), false, true);

	wp_enqueue_script('vanguard-history-buttons', get_template_directory_uri() . '/js/custom/buttons.js', array('jquery'), false, true);
	wp_localize_script('vanguard-history-buttons', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	wp_enqueue_script('vanguard-history-forms', get_template_directory_uri() . '/js/custom/forms.js', array('jquery'), false, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'vanguard_history_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom taxonomies
 */
function register_taxonomy_ensemble()
{
	$labels = array(
		'name'              => _x('Ensemble', 'taxonomy general name'),
		'singular_name'     => _x('Ensemble', 'taxonomy singular name'),
		'search_items'      => __('Search Ensembles'),
		'all_items'         => __('All Ensembles'),
		'parent_item'       => __('Parent Ensemble'),
		'parent_item_colon' => __('Parent Ensemble:'),
		'edit_item'         => __('Edit Ensemble'),
		'update_item'       => __('Update Ensemble'),
		'add_new_item'      => __('Add New Ensemble'),
		'new_item_name'     => __('New Ensemble Name'),
		'menu_name'         => __('Ensemble'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'ensemble'],
	);
	register_taxonomy('ensemble', array('page', 'attachment', 'year_story'), $args);
}
function register_taxonomy_vhs_year()
{
	$labels = array(
		'name'              => _x('Year', 'taxonomy general name'),
		'singular_name'     => _x('Year', 'taxonomy singular name'),
		'search_items'      => __('Search Years'),
		'all_items'         => __('All Years'),
		'parent_item'       => __('Parent Year'),
		'parent_item_colon' => __('Parent Year:'),
		'edit_item'         => __('Edit Year'),
		'update_item'       => __('Update Year'),
		'add_new_item'      => __('Add New Year'),
		'new_item_name'     => __('New Year Name'),
		'menu_name'         => __('Year'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'vhs_year'],
	);
	register_taxonomy('vhs_year', array('page', 'attachment', 'year_story'), $args);
}
function register_taxonomy_media_visibility()
{
	$labels = array(
		'name'              => _x('Visibility Status', 'taxonomy general name'),
		'singular_name'     => _x('Visibility Status', 'taxonomy singular name'),
		'search_items'      => __('Search Visibility Statuses'),
		'all_items'         => __('All Visibility Statuses'),
		'parent_item'       => __('Parent Visibility Status'),
		'parent_item_colon' => __('Parent Visibility Status:'),
		'edit_item'         => __('Edit Visibility Status'),
		'update_item'       => __('Update Visibility Status'),
		'add_new_item'      => __('Add New Visibility Status'),
		'new_item_name'     => __('New Visibility Status Name'),
		'menu_name'         => __('Visibility Status'),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'media_visibility'],
	);
	register_taxonomy('media_visibility', 'attachment', $args);
}

function register_taxonomy_submitter_name()
{
	$labels = array(
		'name'              => _x('Submitter Name', 'taxonomy general name'),
		'singular_name'     => _x('Submitter Name', 'taxonomy singular name'),
		'search_items'      => __('Search Submitter Names'),
		'all_items'         => __('All Submitter Names'),
		'parent_item'       => __('Parent Submitter Name'),
		'parent_item_colon' => __('Parent Submitter Name:'),
		'edit_item'         => __('Edit Submitter Name'),
		'update_item'       => __('Update Submitter Name'),
		'add_new_item'      => __('Add New Submitter Name'),
		'new_item_name'     => __('New Submitter Name Value'),
		'menu_name'         => __('Submitter Name'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'submitter_name'],
	);
	register_taxonomy('submitter_name', 'attachment', $args);
}

function register_taxonomy_submitter_email()
{
	$labels = array(
		'name'              => _x('Submitter Email', 'taxonomy general name'),
		'singular_name'     => _x('Submitter Email', 'taxonomy singular name'),
		'search_items'      => __('Search Submitter Emails'),
		'all_items'         => __('All Submitter Emails'),
		'parent_item'       => __('Parent Submitter Email'),
		'parent_item_colon' => __('Parent Submitter Email:'),
		'edit_item'         => __('Edit Submitter Email'),
		'update_item'       => __('Update Submitter Email'),
		'add_new_item'      => __('Add New Submitter Email'),
		'new_item_name'     => __('New Submitter Email Name'),
		'menu_name'         => __('Submitter Email'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'submitter_email'],
	);
	register_taxonomy('submitter_email', 'attachment', $args);
}

function register_taxonomy_creator_name()
{
	$labels = array(
		'name'              => _x('Creator Name', 'taxonomy general name'),
		'singular_name'     => _x('Creator Name', 'taxonomy singular name'),
		'search_items'      => __('Search Creator Names'),
		'all_items'         => __('All Creator Names'),
		'parent_item'       => __('Parent Creator Name'),
		'parent_item_colon' => __('Parent Creator Name:'),
		'edit_item'         => __('Edit Creator Name'),
		'update_item'       => __('Update Creator Name'),
		'add_new_item'      => __('Add New Creator Name'),
		'new_item_name'     => __('New Creator Name Value'),
		'menu_name'         => __('Creator Name'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'creator_name'],
	);
	register_taxonomy('creator_name', 'attachment', $args);
}

function register_taxonomy_copyright()
{
	$labels = array(
		'name'              => _x('Copyright Status', 'taxonomy general name'),
		'singular_name'     => _x('Copyright Status', 'taxonomy singular name'),
		'search_items'      => __('Search Copyright Statuses'),
		'all_items'         => __('All Copyright Statuses'),
		'parent_item'       => __('Parent Copyright Status'),
		'parent_item_colon' => __('Parent Copyright Status:'),
		'edit_item'         => __('Edit Copyright Status'),
		'update_item'       => __('Update Copyright Status'),
		'add_new_item'      => __('Add New Copyright Status'),
		'new_item_name'     => __('New Copyright Status Name'),
		'menu_name'         => __('Copyright Status'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'copyright'],
	);
	register_taxonomy('copyright', 'attachment', $args);
}

function register_taxonomy_year_story_author()
{
	$labels = array(
		'name'              => _x('Year Story Author', 'taxonomy general name'),
		'singular_name'     => _x('Year Story Author', 'taxonomy singular name'),
		'search_items'      => __('Search Year Story Authors'),
		'all_items'         => __('All Year Story Authors'),
		'parent_item'       => __('Parent Year Story Author'),
		'parent_item_colon' => __('Parent Year Story Author:'),
		'edit_item'         => __('Edit Year Story Author'),
		'update_item'       => __('Update Year Story Author'),
		'add_new_item'      => __('Add New Year Story Author'),
		'new_item_name'     => __('New Year Story Author Value'),
		'menu_name'         => __('Year Story Author'),
	);
	$args   = array(
		'hierarchical'      => false, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'create_posts'      => false,
		'rewrite'           => ['slug' => 'year_story_author'],
	);
	register_taxonomy('year_story_author', 'year_story', $args);
}

function add_tags_to_pages()
{
	register_taxonomy_for_object_type('post_tag', 'page');
}

add_action('init', 'add_tags_to_pages');
add_action('init', 'register_taxonomy_ensemble');
add_action('init', 'register_taxonomy_vhs_year');
add_action('init', 'register_taxonomy_media_visibility');
add_action('init', 'register_taxonomy_submitter_name');
add_action('init', 'register_taxonomy_submitter_email');
add_action('init', 'register_taxonomy_creator_name');
add_action('init', 'register_taxonomy_copyright');
add_action('init', 'register_taxonomy_year_story_author');
//add_action('add_meta_boxes', 'add_custom_meta_box_media_visibility');
//add_action('add_attachment', 'save_media_visibility'); //originally was add_action('save_post',...)

/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function media_visibility_radio_buttons($args)
{
	if (!empty($args['taxonomy']) && $args['taxonomy'] === 'media_visibility' /* <== Change to your required taxonomy */) {
		if (empty($args['walker']) || is_a($args['walker'], 'Walker')) { // Don't override 3rd party walkers.
			if (!class_exists('media_visibility_radio_buttons')) {
				/**
				 * Custom walker for switching checkbox inputs to radio.
				 *
				 * @see Walker_Category_Checklist
				 */
				class media_visibility_radio_buttons extends Walker_Category_Checklist
				{
					function walk($elements, $max_depth, ...$args)
					{
						$output = parent::walk($elements, $max_depth, ...$args);
						$output = str_replace(
							array('type="checkbox"', "type='checkbox'"),
							array('type="radio"', "type='radio'"),
							$output
						);

						return $output;
					}
				}
			}

			$args['walker'] = new media_visibility_radio_buttons;
		}
	}

	return $args;
}

add_filter('wp_terms_checklist_args', 'media_visibility_radio_buttons');

/**
 * Custom post types
 */

function vhs_custom_post_type()
{
	register_post_type(
		'year_story',
		array(
			'labels'      => array(
				'name'          => __('Year Stories', 'textdomain'),
				'singular_name' => __('Year Story', 'textdomain'),
			),
			'public'      => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'author', 'excerpt', 'comments', 'revisions', 'thumbnail')
		)
	);
}
add_action('init', 'vhs_custom_post_type');

// Add mp4 files mime type to WordPress in order to allow mp4 files to be uploaded, per https://docs.gravityforms.com/permitted-file-types-for-uploading/#h-wordpress-core-filters and later approach in support ticket.
add_filter('wp_check_filetype_and_ext', function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
	GFCommon::log_debug('Running for file: ' . $filename);
	GFCommon::log_debug('$real_mime value: ' . var_export($real_mime, true));
	$wp_filetype = wp_check_filetype($filename, $mimes);
	GFCommon::log_debug('$wp_filetype value: ' . print_r($wp_filetype, true));
	if (in_array($wp_filetype['ext'], ['mp4'])) {
		$wp_check_filetype_and_ext['ext']  = $wp_filetype['ext'];
		$wp_check_filetype_and_ext['type'] = $wp_filetype['type'];
	}
	return $wp_check_filetype_and_ext;
}, 10, 5);

/**
 * Upload form submissions to media library
 */
function form_to_media_library($entry)
{
	// from https://developer.wordpress.org/reference/functions/wp_insert_attachment/#div-comment-948 and https://wordpress.stackexchange.com/a/405055/7313

	// Get the path to the upload directory.
	$wp_upload_dir = wp_upload_dir();

	// build array of uploads
	$all_files_string = trim($entry['1'], '[]');
	$all_files = explode(",", $all_files_string);
	//do_action( 'qm/debug', $all_files);

	$image_filetypes = array('jpeg', 'jpg', 'gif', 'png', 'bmp');

	// start loop to process each uploaded file
	foreach ($all_files as $this_file) {

		// set filename
		$upload_path = GFFormsModel::get_upload_path($entry['form_id']);
		$upload_url = GFFormsModel::get_upload_url($entry['form_id']);
		$filename_verbose = str_replace($upload_url, $upload_path, $this_file);
		$filename_backslashes = trim($filename_verbose, ' " ');
		$filename = stripslashes($filename_backslashes);

		// check the type of file. We'll use this as the 'post_mime_type'
		$filetype = wp_check_filetype(basename($filename), null);

		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
			//get caption from upload form field
			'post_excerpt'   => rgar($entry, '8'),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		// create a file in the upload folder
		$upload = wp_upload_bits(basename($filename), null,  file_get_contents($filename));

		// Insert the attachment.
		$attach_id = wp_insert_attachment($attachment, $upload['file']);

		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		// do_action( 'qm/debug', $filetype);
		// debug not working here per https://wordpress.org/support/topic/debug-not-working-inside-a-filter/

		// conditional logic: only if file type is image
		if (in_array($filetype['ext'], $image_filetypes)) {
			// Generate alternate sizes for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
			wp_update_attachment_metadata($attach_id, $attach_data);
		}

		// set custom field values
		wp_set_object_terms($attach_id, rgar($entry, '2'), 'submitter_name');
		wp_set_object_terms($attach_id, rgar($entry, '3'), 'submitter_email');
		wp_set_object_terms($attach_id, rgar($entry, '4'), 'vhs_year');
		wp_set_object_terms($attach_id, rgar($entry, '6'), 'ensemble');
		wp_set_object_terms($attach_id, rgar($entry, '11'), 'creator_name');

		// Note that the copyright info is saved as a "value" separate from the "label" shown to the user. The value is set when editing the form in GravityForms.
		wp_set_object_terms($attach_id, rgar($entry, '7'), 'copyright');

		// end loop
	}
}

// targets the specific form by form ID of 1
add_action('gform_after_submission_1', 'form_to_media_library', 10, 2);

// show full term names rather than slug in attachment details (in WP Admin)
function my_attachment_fields_to_edit($form_fields)
{
	// apply to these taxonomies
	$taxonomies_arr = ['submitter_name', 'submitter_email', 'creator_name'];
	foreach ($taxonomies_arr as $taxonomy) {

		// Do nothing if the Submitter Email field is not in the fields list.
		if (!isset($form_fields[$taxonomy])) {
			continue;
		} else {
			// Get the term by its slug.
			$field = (array) $form_fields[$taxonomy];
			$term  = empty($field['taxonomy']) ? null :
				get_term_by('slug', $field['value'], $taxonomy);

			// Use the term name.
			if ($term instanceof WP_Term) {
				$form_fields[$taxonomy]['value'] = $term->name;
			}
		}
	}
	// debug not working here
	// do_action( 'qm/debug', $form_fields);

	return $form_fields;
}

add_filter('attachment_fields_to_edit', 'my_attachment_fields_to_edit');

function get_vhs_footer()
{
	echo '<div class="main-footer">';
	echo get_footer();
	echo '</div>';
}

// ajax handler for loading all media in year story
function vanguard_history_all_media_for_year_story()
{
	if (isset($_REQUEST)) {
		$this_year = $_REQUEST['year'];
		$this_ensemble = $_REQUEST['ensemble'];
		$offset = $_REQUEST['offset'];
		$limit = $_REQUEST['limit'];
		/*
		echo $this_ensemble;
		echo $this_year;
		*/
		// query media
		$media_query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'any',

			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'ensemble',
					'field' => 'slug',
					'terms' => $this_ensemble,
				),
				array(
					'taxonomy' => 'vhs_year',
					'field' => 'slug',
					'terms' => $this_year,
				),
				array(
					'taxonomy' => 'media_visibility',
					'field' => 'slug',
					'terms' => 'published',
				),
			),

			'offset' => $offset,

			'posts_per_page' => $limit

			// in the future, might need to change this once we have more attachments - want it to show all wihout pagination (until we build pagination)
		);
		$media_query = new WP_Query($media_query_args);

		$thumbnails = array();

		if ($media_query->have_posts()) : while ($media_query->have_posts()) : $media_query->the_post();
				// store thumbnails in array
				$thumbnails[] = wp_get_attachment_link(get_the_ID(), 'thumbnail', true);

			endwhile;
		endif; // end of media loop

		// Be kind; rewind
		wp_reset_postdata();

		// output all the results
		foreach ($thumbnails as $thumbnail) {
			echo ($thumbnail);
		}

		die();
	}
}

add_action('wp_ajax_vanguard_history_all_media_for_year_story', 'vanguard_history_all_media_for_year_story');
add_action('wp_ajax_nopriv_vanguard_history_all_media_for_year_story', 'vanguard_history_all_media_for_year_story');

class Custom_Walker_Comment extends Walker_Comment
{

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment($comment, $depth, $args)
	{

		$tag = ('div' === $args['style']) ? 'div' : 'li';

?>
<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>"
    <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <?php
					$comment_author_link = get_comment_author_link($comment);
					$comment_author_url  = get_comment_author_url($comment);
					$comment_author      = get_comment_author($comment);
					$avatar              = get_avatar($comment, $args['avatar_size']);
					?>
            <div class="comment-avatar">
                <?php
						if (0 != $args['avatar_size']) {
							if (empty($comment_author_url)) {
								echo $avatar;
							} else {
								printf('<a href="%s" rel="external nofollow" class="url">', $comment_author_url);
								echo $avatar;
								echo ('</a>');
							}
						}
						?>
            </div>
            <div class="comment-author-metadata">
                <div class="comment-author vcard">
                    <?php

							/*
							 * Using the `check` icon instead of `check_circle`, since we can't add a
							 * fill color to the inner check shape when in circle form.
							 */

							/*
							// not getting $post object correctly here, so commenting out
							if ( $comment->user_id === $post->post_author ) {
								printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', custom_get_icon_svg( 'check', 24 ) );
							}
							*/

							/*
							 * Using the `check` icon instead of `check_circle`, since we can't add a
							 * fill color to the inner check shape when in circle form.
							 */

							// not getting $post object correctly here, so commenting out
							/*
							if ( $comment->user_id === $post->post_author ) {
								printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', custom_get_icon_svg( 'check', 24 ) );
							}
							*/

							printf(
								/* translators: %s: comment author link */
								wp_kses(
									__('%s <span class="screen-reader-text says">says:</span>', 'custom'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								'<span class="fn">' . get_comment_author_link($comment) . ' says:</span>'
							);
							?>
                </div><!-- .comment-author -->

                <div class="comment-metadata">
                    <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                        <?php
								/* translators: 1: comment date, 2: comment time */
								$comment_timestamp = sprintf(__('%1$s at %2$s', 'custom'), get_comment_date('', $comment), get_comment_time());
								?>
                        <time datetime="<?php comment_time('c'); ?>" title="<?php echo $comment_timestamp; ?>">
                            <?php echo $comment_timestamp; ?>
                        </time>
                    </a>
                    <?php
							//$edit_comment_icon = custom_get_icon_svg( 'edit', 16 );
							//edit_comment_link( __( 'Edit', 'custom' ), '<span class="edit-link-sep">&mdash;</span> <span class="edit-link">' . $edit_comment_icon, '</span>' );
							?>
                </div><!-- .comment-metadata -->

            </div><!-- .comment-author-metadata -->



            <?php if ('0' == $comment->comment_approved) : ?>
            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'custom'); ?></p>
            <?php endif; ?>
        </footer><!-- .comment-meta -->

        <div class="comment-content">
            <?php comment_text(); ?>
        </div><!-- .comment-content -->

        <?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="comment-reply">',
							'after'     => '</div>',
						)
					)
				);
				?>
    </article><!-- .comment-body -->
    <?php
	}
} // end custom walker comment class

function show_featured_story($featured_slug)
{
	$args = array(
		'name' => $featured_slug,
		'post_type' => 'year_story',
		'post_status' => 'publish',
		'numberposts' => 1
	);

	$featured_story = get_posts($args);

	if ($featured_story) {
		/*
		// debug for displaying the post object
		echo('<pre>');
		print_r($featured_story);
		echo('</pre>');
		*/

		//define variables to be echoed
		$link = get_permalink($featured_story[0]);
		$title = $featured_story[0]->post_title;
		$excerpt = $featured_story[0]->post_excerpt;
		$thumbnail = get_the_post_thumbnail($featured_story[0]->ID, 'large', ['id' => 'featured-story-thumbnail']);

		echo ("
			<a href='$link'>
			$thumbnail
			</a>
			<div class='featured-story-info'>
			<h2 class='featured-story-heading'>
				<a href='$link'>
					Featured Story: $title
				</a>
			</h2>
			<div class='featured-story-excerpt'>
				$excerpt
			</div>
			<a href='$link' class='featured-story-link'>
				Show Full Story
			</a>
			</div>
		");
	} else {
		do_action('qm/error', 'featured story not found in function show_featured_story');
	}
}

// remove prefix like "Archive: " from the_archive_title
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif (is_tax()) { //for custom post types
		$title = sprintf(__('%1$s'), single_term_title('', false));
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});

// remove search sitewide for now, except for the WordPress Admin area
// doesn't remove the search widget from 404 page, but removing that separately for now
// https://stackoverflow.com/a/45597262/370407
function disable_search($query, $error = true)
{
	if (is_search()) {
		$query->is_search = false;
		$query->query_vars[s] = false;
		$query->query[s] = false;

		// to error

		if ($error == true) $query->is_404 = true;
	}
}
function remove_search_widget()
{
	unregister_widget('WP_Widget_Search');
}
if (!is_admin()) {
	add_action('parse_query', 'disable_search');
	add_filter('get_search_form', function () {
		return null;
	});
	add_action('widgets_init', 'remove_search_widget');
}

// show 404 template while keeping the current URL
function show_404_in_page()
{
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	get_template_part(404);
	exit();
}

// remove all taxonomies from sitemap. If changing this, make sure to remove submitter email from sitemap separately
function remove_tax_from_sitemap($taxonomies)
{
	$all_taxonomies = get_taxonomies();
	foreach ($all_taxonomies as $this_taxonomy) {
		unset($taxonomies[$this_taxonomy]);
	}
	return $taxonomies;
}
add_filter('wp_sitemaps_taxonomies', 'remove_tax_from_sitemap');

// strip html tags out of title
function strip_html_from_title($title_parts)
{
	//$stripped_title = strip_tags($title_parts['site']);
	//$stripped_title = 'chicken';
	$stripped_tagline = strip_tags(html_entity_decode((get_bloginfo('description', 'display'))));

	$title_parts['tagline'] = $stripped_tagline;

	return $title_parts;
}

add_filter('document_title_parts', 'strip_html_from_title');

function vanguard_history_populate_thumbnails($media_query)
{
	//define thumbnails array
	$thumbnails = array();

	if ($media_query->have_posts()) : while ($media_query->have_posts()) : $media_query->the_post();
			// basic info
			$file_type = get_post_mime_type();
			$this_id = get_the_ID();

			// store thumbnails in array
			if (str_contains($file_type, 'video')) {
				// for videos, things are in different places - wp_get_attachment_link doesn't get the thumbnail on its own
				$this_thumbnail = get_the_post_thumbnail_url($this_id, 'thumbnail');
				$this_thumbnail_id = get_post_thumbnail_id($this_id);
				$this_thumbnail_alt = get_post_meta($this_thumbnail_id, '_wp_attachment_image_alt', TRUE);
				// if there is no thumbnail set in the video, use the default image
				if (empty($this_thumbnail)) {
					$site_url = get_site_url();
					$this_thumbnail = $site_url . "/wp-content/plugins/media-library-assistant/images/crystal/video.png";
				}
				$this_media_title = get_the_title($this_id);
				$this_img_string = "<div class='video-thumbnail-wrapper'><img class='attachment-thumbnail size-thumbnail video-thumbnail' src='$this_thumbnail' alt='$this_thumbnail_alt' title='$this_media_title' decoding='async' loading='lazy' width='150' height='150'/></div>";
				$this_link = get_attachment_link($this_id);
				$thumbnails[] = "<a href='$this_link' title='$this_media_title'>$this_img_string</a>";
			} else if (str_contains($file_type, 'audio')) {
				// for audio
				$site_url = get_site_url();
				$this_media_alt = get_post_meta($this_id, '_wp_attachment_image_alt', TRUE);
				$this_media_title = get_the_title($this_id);
				$this_img_string = "<div class='audio-thumbnail-wrapper'><img class='attachment-thumbnail size-thumbnail audio-thumbnail' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=' alt='$this_media_alt' title='$this_media_title' decoding='async' loading='lazy' width='150' height='150'/></div>";
				$this_link = get_attachment_link($this_id);
				$thumbnails[] = "<a href='$this_link' title='$this_media_title'>$this_img_string</a>";
			} else if (str_contains($file_type, 'image')) {
				// for images
				$thumbnails[] = wp_get_attachment_link(get_the_ID(), 'thumbnail', true);
			} else {
				// if there's another file type that is not included above, log it to Query Monitor so that admins will know
				$log_message = "query included an unhandled filetype. The media item that triggered this has a post ID of " . $this_id . ". You might want to edit the code to be able to display them or set the media items as unpublished.";
				do_action('qm/warning', $log_message);
			}
		endwhile;
	endif; // end of media loop

	// Be kind; rewind
	wp_reset_postdata();

	return $thumbnails;
}
