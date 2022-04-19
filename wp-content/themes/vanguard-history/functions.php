<?php
/**
 * Vanguard History functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vanguard_History
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

@ini_set( 'upload_max_size' , '2000M' );
@ini_set( 'post_max_size', '2000M');
@ini_set( 'max_execution_time', '500' );

if ( ! function_exists( 'vanguard_history_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vanguard_history_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Vanguard History, use a find and replace
		 * to change 'vanguard-history' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vanguard-history', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'vanguard-history' ),
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
		add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'vanguard_history_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vanguard_history_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vanguard_history_content_width', 640 );
}
add_action( 'after_setup_theme', 'vanguard_history_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vanguard_history_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'vanguard-history' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vanguard-history' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'vanguard_history_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vanguard_history_scripts() {
	wp_enqueue_style( 'vanguard-history-style', get_stylesheet_uri(), array(), false );

	wp_enqueue_script( 'vanguard-history-navigation', get_template_directory_uri() . '/js/custom/navigation.js', array(), false, true );

	wp_enqueue_script( 'vanguard-history-test', get_template_directory_uri() . '/js/custom/test.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vanguard_history_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom taxonomies
 */
function register_taxonomy_ensemble() {
   $labels = array(
       'name'              => _x( 'Ensemble', 'taxonomy general name' ),
       'singular_name'     => _x( 'Ensemble', 'taxonomy singular name' ),
       'search_items'      => __( 'Search Ensembles' ),
       'all_items'         => __( 'All Ensembles' ),
       'parent_item'       => __( 'Parent Ensemble' ),
       'parent_item_colon' => __( 'Parent Ensemble:' ),
       'edit_item'         => __( 'Edit Ensemble' ),
       'update_item'       => __( 'Update Ensemble' ),
       'add_new_item'      => __( 'Add New Ensemble' ),
       'new_item_name'     => __( 'New Ensemble Name' ),
       'menu_name'         => __( 'Ensemble' ),
   );
   $args   = array(
       'hierarchical'      => false, // make it hierarchical (like categories)
       'labels'            => $labels,
       'show_ui'           => true,
       'show_admin_column' => true,
       'query_var'         => true,
       'rewrite'           => [ 'slug' => 'ensemble' ],
   );
   register_taxonomy( 'ensemble', array( 'page','attachment', 'year_story' ), $args );
}
function register_taxonomy_vhs_year() {
   $labels = array(
       'name'              => _x( 'Year', 'taxonomy general name' ),
       'singular_name'     => _x( 'Year', 'taxonomy singular name' ),
       'search_items'      => __( 'Search Years' ),
       'all_items'         => __( 'All Years' ),
       'parent_item'       => __( 'Parent Year' ),
       'parent_item_colon' => __( 'Parent Year:' ),
       'edit_item'         => __( 'Edit Year' ),
       'update_item'       => __( 'Update Year' ),
       'add_new_item'      => __( 'Add New Year' ),
       'new_item_name'     => __( 'New Year Name' ),
       'menu_name'         => __( 'Year' ),
   );
   $args   = array(
       'hierarchical'      => false, // make it hierarchical (like categories)
       'labels'            => $labels,
       'show_ui'           => true,
       'show_admin_column' => true,
       'query_var'         => true,
       'rewrite'           => [ 'slug' => 'vhs_year' ],
   );
   register_taxonomy( 'vhs_year', array( 'page','attachment', 'year_story' ), $args );
}
function register_taxonomy_media_visibility(){
	$labels = array(
			'name'              => _x( 'Visibility Status', 'taxonomy general name' ),
			'singular_name'     => _x( 'Visibility Status', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Visibility Statuses' ),
			'all_items'         => __( 'All Visitbility Statuses' ),
			'parent_item'       => __( 'Parent Visibility Status' ),
			'parent_item_colon' => __( 'Parent Visibility Status:' ),
			'edit_item'         => __( 'Edit Visibility Status' ),
			'update_item'       => __( 'Update Visibility Status' ),
			'add_new_item'      => __( 'Add New Visibility Status' ),
			'new_item_name'     => __( 'New Visibility Status Name' ),
			'menu_name'         => __( 'Visibility Status' ),
	);
	$args   = array(
			'hierarchical'      => true, // make it hierarchical (like categories)
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'create_posts'      => false,
			'rewrite'           => [ 'slug' => 'media_visibility' ],
	);
	register_taxonomy( 'media_visibility', 'attachment', $args );
}

function add_tags_to_pages() {
register_taxonomy_for_object_type( 'post_tag', 'page' );
}

add_action( 'init', 'add_tags_to_pages');
add_action( 'init', 'register_taxonomy_ensemble' );
add_action( 'init', 'register_taxonomy_vhs_year' );
add_action( 'init', 'register_taxonomy_media_visibility' );
//add_action('add_meta_boxes', 'add_custom_meta_box_media_visibility');
//add_action('add_attachment', 'save_media_visibility'); //originally was add_action('save_post',...)

/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function media_visibility_radio_buttons( $args ) {
if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'media_visibility' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'media_visibility_radio_buttons' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class media_visibility_radio_buttons extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
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

add_filter( 'wp_terms_checklist_args', 'media_visibility_radio_buttons' );

/**
 * Custom post types
 */

 function vhs_custom_post_type() {
    register_post_type('year_story',
        array(
            'labels'      => array(
                'name'          => __('Year Stories', 'textdomain'),
                'singular_name' => __('Year Story', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
        )
    );
}
add_action('init', 'vhs_custom_post_type');

/**
 * Upload form submissions to media library
 */
function form_to_media_library($entry){
	// WordPress environment
  /*
	// $filename should be the path to a file in the upload directory.
$filename = '/path/to/uploads/2013/03/filename.jpg';

// The ID of the post this attachment is for.
$parent_post_id = 37;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
    'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
    'post_mime_type' => $filetype['type'],
    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
    'post_content'   => '',
    'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Generate the metadata for the attachment, and update the database record.
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );

set_post_thumbnail( $parent_post_id, $attach_id );
	*/
	// from https://developer.wordpress.org/reference/functions/wp_insert_attachment/#div-comment-948

	// set filename
	$upload_path = GFFormsModel::get_upload_path( $entry[ 'form_id' ] );
  $upload_url = GFFormsModel::get_upload_url( $entry[ 'form_id' ] );
  $filename_verbose = str_replace( $upload_url, $upload_path, $entry[ '1' ] );
	$filename = trim($filename_verbose, ' "[]\ ');
	do_action( 'qm/debug', $filename );

	// check the type of file. We'll use this as the 'post_mime_type'
	$filetype = wp_check_filetype( basename( $filename ), null );

	// Get the path to the upload directory.
	$wp_upload_dir = wp_upload_dir();

	// Prepare an array of post data for the attachment.
	$attachment = array(
	    'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	    'post_mime_type' => $filetype['type'],
	    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	    'post_content'   => '',
	    'post_status'    => 'inherit'
	);

	// Insert the attachment.
	$attach_id = wp_insert_attachment( $attachment, $filename );

	// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Generate the metadata for the attachment, and update the database record.
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );
}

// targets the specific form by form ID of 1
add_action( 'gform_after_submission_1', 'form_to_media_library', 10, 2 );
