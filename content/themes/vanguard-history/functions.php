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
	wp_enqueue_style( 'vanguard-history-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'vanguard-history-style', 'rtl', 'replace' );

	wp_enqueue_script( 'vanguard-history-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

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
     register_taxonomy( 'ensemble', array( 'page','attachment', 'year-story' ), $args );
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
     register_taxonomy( 'vhs_year', array( 'page','attachment', 'year-story' ), $args );
}
add_action( 'init', 'register_taxonomy_ensemble' );
add_action( 'init', 'register_taxonomy_vhs_year' );
