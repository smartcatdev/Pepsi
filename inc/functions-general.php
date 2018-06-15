<?php


// Adds custom classes to the array of body classes.
add_filter( 'body_class', 'pepsi_body_classes' );

// Add a pingback url auto-discovery header for singularly identifiable articles.
add_action( 'wp_head', 'pepsi_pingback_header' );

// Set up theme defaults and register various theme support
add_action( 'after_setup_theme', 'pepsi_setup' );

// Create theme page in dashboard
add_action('admin_menu', 'pepsi_create_theme_menu' );

/**
 * Adds custom classes to the array of body classes.
 * 
 * @param array $classes Classes for the body element.
 * @return array
 */
function pepsi_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pepsi_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}


/**
 * Pepsi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pepsi
 */
if ( !function_exists( 'pepsi_setup' ) ) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function pepsi_setup() {
    
        if( !defined( 'PEPSI_VERSION' ) ) :
            define( 'PEPSI_VERSION', '1.3.0' );
        endif;
        
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Pepsi, use a find and replace
         * to change 'pepsi' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'pepsi', get_template_directory() . '/languages' );

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
            'primary-menu'              => esc_html__( 'Navbar: Primary Menu', 'pepsi' ),
            'split-primary-left'        => esc_html__( 'Navbar: Split - Left', 'pepsi' ),
            'split-primary-right'       => esc_html__( 'Navbar: Split - Right', 'pepsi' ),
            'mobile-menu'               => esc_html__( 'Mobile', 'pepsi' ),
            'custom-header'             => esc_html__( 'Custom Header', 'pepsi' ),
            'toolbar-menu'              => esc_html__( 'Toolbar Menu', 'pepsi' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array (
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array (
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ) );
        
    }

endif;


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) {
    $content_width = 1170;
}

function pepsi_create_theme_menu() {
    add_theme_page( __( 'Theme Docs', 'pepsi' ), __( 'Theme Docs', 'pepsi' ), 'edit_theme_options', 'pepsi-theme-info', function() {
        include_once get_template_directory() . '/admin/pepsi-menu.php';
    });
}

function pepsi_theme_path( $path = null ) {
    return trailingslashit( get_template_directory() ) . $path;
}

function pepsi_theme_url( $url = null ) {
    return trailingslashit( get_template_directory_uri() ) . $url;
}

add_action( 'after_setup_theme', 'pepsi_load_acid_customize', 99 );  
function pepsi_load_acid_customize() { 
    require get_template_directory() . '/inc/functions-customizer.php';
}