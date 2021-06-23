<?php
/**
 * slnm-base functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slnm-base
 */

if ( ! function_exists( 'slnm_base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slnm_base_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on slnm-base, use a find and replace
	 * to change 'slnm-base' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'slnm-base', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'slnm-base' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'script',
		'style',
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Add stylesheets with content styles to the TinyMCE editor in WordPress admin
	 */
	add_editor_style(array(
		get_template_directory_uri() . '/css/base/base.css?20210610',
		get_template_directory_uri() . '/css/modules/image.css?20210610',
		get_template_directory_uri() . '/css/_tinymce.css?20210611',
	));

}
endif;
add_action( 'after_setup_theme', 'slnm_base_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
/*function slnm_base_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'slnm_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'slnm_base_content_width', 0 ); */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function slnm_base_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'slnm-base' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'slnm-base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'slnm_base_widgets_init' ); */

/**
 * Enqueue scripts and styles.
 */
function slnm_base_scripts() {
	/** enqueue stylesheets **/
	wp_enqueue_style( 'slnm-base-css-style', get_stylesheet_uri() );

	// base stylesheet
	wp_enqueue_style( 'slnm-base-css-base', get_template_directory_uri() . '/css/base/base.css', array(), '20170314' );
	// layout stylesheets
	wp_enqueue_style( 'slnm-base-css-layout', get_template_directory_uri() . '/css/layout/layout.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-grid', get_template_directory_uri() . '/css/layout/grid.css', array(), '20170314' );
	// module stylesheets
	wp_enqueue_style( 'slnm-base-css-module-branding', get_template_directory_uri() . '/css/modules/branding.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-navigation', get_template_directory_uri() . '/css/modules/navigation.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-image', get_template_directory_uri() . '/css/modules/image.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-entry', get_template_directory_uri() . '/css/modules/entry.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-slider', get_template_directory_uri() . '/css/modules/slider.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-quote', get_template_directory_uri() . '/css/modules/quote.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-button', get_template_directory_uri() . '/css/modules/button.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-profile', get_template_directory_uri() . '/css/modules/profile.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-modal', get_template_directory_uri() . '/css/modules/modal.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-form', get_template_directory_uri() . '/css/modules/form.css', array(), '20170314' );
	wp_enqueue_style( 'slnm-base-css-module-searchform', get_template_directory_uri() . '/css/modules/searchform.css', array(), '20170314' );
	// helper styleheet
	wp_enqueue_style( 'slnm-base-css-helpers', get_template_directory_uri() . '/css/helpers.css', array(), '20170314' );

	/** enqueue javascripts **/
	wp_enqueue_script( 'slnm-base-js-searchform', get_template_directory_uri() . '/js/searchform.js', array('jquery'), '20170110', true );
	wp_enqueue_script( 'slnm-base-js-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20161227', true );
	wp_enqueue_script( 'slnm-base-js-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20161227', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'slnm_base_scripts' );


/****************** Include theme modules php files ******************/

/**
 * A place for generic functions
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Clean SMACSS classes including active classes for custom post type menu items, parents and ancestors
 */
require get_template_directory() . '/inc/clean-navigation-css-classes.php';
