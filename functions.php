<?php
/**
 * slnm functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slnm
 */

if ( ! function_exists( 'slnm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slnm_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on slnm, use a find and replace
	 * to change 'slnm' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'slnm', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'slnm' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'slnm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function slnm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'slnm_content_width', 640 );
}
add_action( 'after_setup_theme', 'slnm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slnm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'slnm' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'slnm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'slnm_widgets_init' );

/**
 * Remove unused WP additions to HEAD
 *
 */
// Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );
// Bloat
remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed.

/**
 * Enqueue scripts and styles.
 */
function slnm_scripts() {
	wp_enqueue_style( 'slnm-style', get_stylesheet_uri() );

	wp_enqueue_style( 'slnm-base', get_template_directory_uri() . '/css/base/base.css' );
	wp_enqueue_style( 'slnm-layout', get_template_directory_uri() . '/css/layout/layout.css' );
	wp_enqueue_style( 'slnm-grid', get_template_directory_uri() . '/css/layout/grid.css' );

	wp_enqueue_style( 'slnm-module-branding', get_template_directory_uri() . '/css/modules/branding.css' );
	wp_enqueue_style( 'slnm-module-navigation', get_template_directory_uri() . '/css/modules/navigation.css' );
	wp_enqueue_style( 'slnm-module-entry', get_template_directory_uri() . '/css/modules/entry.css' );
	wp_enqueue_style( 'slnm-module-slider', get_template_directory_uri() . '/css/modules/slider.css' );
	wp_enqueue_style( 'slnm-module-quote', get_template_directory_uri() . '/css/modules/quote.css' );
	wp_enqueue_style( 'slnm-module-button', get_template_directory_uri() . '/css/modules/button.css' );
	wp_enqueue_style( 'slnm-module-profile', get_template_directory_uri() . '/css/modules/profile.css' );
	wp_enqueue_style( 'slnm-module-modal', get_template_directory_uri() . '/css/modules/modal.css' );
	wp_enqueue_style( 'slnm-module-form', get_template_directory_uri() . '/css/modules/form.css' );

	wp_enqueue_style( 'slnm-helpers', get_template_directory_uri() . '/css/helpers.css' );

	wp_enqueue_script( 'slnm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20161227', true );
	wp_enqueue_script( 'slnm-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20161227', true);

}
add_action( 'wp_enqueue_scripts', 'slnm_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/navigation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Remove unused admin menu-items
 */
function hhvp_remove_admin_menu_items() {

	//remove_menu_page( 'index.php' );                  //Dashboard
	remove_menu_page( 'edit.php' );                   //Posts
	//remove_menu_page( 'upload.php' );                 //Media
	//remove_menu_page( 'edit.php?post_type=page' );    //Pages
	remove_menu_page( 'edit-comments.php' );          //Comments
	//remove_menu_page( 'themes.php' );                 //Appearance
	//remove_menu_page( 'plugins.php' );                //Plugins
	//remove_menu_page( 'users.php' );                  //Users
	//remove_menu_page( 'tools.php' );                  //Tools
	//remove_menu_page( 'options-general.php' );        //Settings

}
add_action( 'admin_menu', 'hhvp_remove_admin_menu_items' );
