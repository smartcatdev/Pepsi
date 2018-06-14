<?php

/**
 * Enqueue scripts and styles.
 */
function pepsi_scripts() {
    
    wp_enqueue_style( 'pepsi-style', get_stylesheet_uri() );

    // Fonts
    $fonts = pepsi_fonts();
    if ( get_theme_mod( PEPSI_OPTIONS::FONT_PRIMARY, PEPSI_DEFAULTS::FONT_PRIMARY ) == get_theme_mod( PEPSI_OPTIONS::FONT_SECONDARY, PEPSI_DEFAULTS::FONT_SECONDARY ) ) :
        // Fonts are the same, enqueue once
        wp_enqueue_style('pepsi-google-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( $fonts[ get_theme_mod( PEPSI_OPTIONS::FONT_PRIMARY, PEPSI_DEFAULTS::FONT_PRIMARY ) ] ), array(), PEPSI_VERSION ); 
    else :
        // Fonts are different, enqueue together
        wp_enqueue_style('pepsi-google-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( $fonts[ get_theme_mod( PEPSI_OPTIONS::FONT_PRIMARY, PEPSI_DEFAULTS::FONT_PRIMARY ) ] . '|' . $fonts[ get_theme_mod( PEPSI_OPTIONS::FONT_SECONDARY, PEPSI_DEFAULTS::FONT_SECONDARY ) ] ), array(), PEPSI_VERSION ); 
    endif;

    // Styles
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/bootstrap.min.css', array(), PEPSI_VERSION );
    wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/lib/font-awesome/fontawesome-all.min.css', array(), PEPSI_VERSION );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/lib/animate/animate.css', array(), PEPSI_VERSION );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.css', null, PEPSI_VERSION );
    wp_enqueue_style( 'pepsi-util', get_template_directory_uri() . '/assets/css/util.css', array(), PEPSI_VERSION );
    wp_enqueue_style( 'pepsi', get_template_directory_uri() . '/assets/css/pepsi.css', array(), PEPSI_VERSION );
    if ( class_exists( 'woocommerce' ) ) :
        wp_enqueue_style( 'pepsi-wc', get_template_directory_uri() . '/assets/css/pepsi-woocommerce.css', array(), PEPSI_VERSION );
    endif;
    
    // Scripts
    wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/lib/sticky-js/jquery.sticky.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'bootstrap-tabs', get_template_directory_uri() . '/assets/lib/bootstrap/bootstrap.min.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'bootstrap-toolkit', get_template_directory_uri() . '/assets/lib/bootstrap-toolkit/bootstrap-toolkit.min.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/lib/wow/wow.min.js', array( 'jquery' ), PEPSI_VERSION, true );
    wp_enqueue_script( 'jquery-lettering', get_template_directory_uri() . '/assets/lib/lettering/jquery.lettering.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'jquery-textillate', get_template_directory_uri() . '/assets/lib/textillate/jquery.textillate.js', array('jquery','jquery-lettering'), PEPSI_VERSION, true );
    wp_enqueue_script( 'jquery-easeScroll', get_template_directory_uri() . '/assets/lib/ease-scroll/jquery.easeScroll.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array( 'jquery' ), PEPSI_VERSION );
    wp_enqueue_script( 'bigSlide', get_template_directory_uri() . '/assets/lib/big-slide/bigSlide.min.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'jquery-slimScroll', get_template_directory_uri() . '/assets/lib/slim-scroll/jquery.slimscroll.min.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/assets/lib/jquery-parallax/jquery.parallax.js', array('jquery'), PEPSI_VERSION, false );
    wp_enqueue_script( 'pepsi-parallax', get_template_directory_uri() . '/assets/lib/pepsi-parallax/parallax.js', array('jquery'), PEPSI_VERSION, true );
    wp_enqueue_script( 'pepsi-general', get_template_directory_uri() . '/assets/js/pepsi-general.js', array( 'jquery', 'wow', 'jquery-textillate', 'slick' ), PEPSI_VERSION, true );
    wp_enqueue_script( 'pepsi-header', get_template_directory_uri() . '/assets/js/pepsi-header.js', array('jquery'), PEPSI_VERSION, false );
    wp_enqueue_script( 'pepsi-resize', get_template_directory_uri() . '/assets/js/pepsi-resize.js', array('jquery','masonry'), PEPSI_VERSION, true );
    
    // _s
    wp_enqueue_script( 'pepsi-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), PEPSI_VERSION, true );
    wp_enqueue_script( 'pepsi-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), PEPSI_VERSION, true );

    // Localization Data
    $parallax_preset = pepsi_get_parallax_preset();
    $pepsi_header_JS = array(
        'parallax_image_layer'          => $parallax_preset['image_layer'],
        'parallax_texture_layer'        => $parallax_preset['texture_layer'],
        'parallax_color_layer'          => $parallax_preset['color_layer'],
        'parallax_content_layer'        => $parallax_preset['content_layer'],
        'toolbar_height'                => get_theme_mod( PEPSI_OPTIONS::TOOLBAR_HEIGHT, PEPSI_DEFAULTS::TOOLBAR_HEIGHT ) ? intval( get_theme_mod( PEPSI_OPTIONS::TOOLBAR_HEIGHT, PEPSI_DEFAULTS::TOOLBAR_HEIGHT ) ) : 0,
    );
    $pepsi_general_JS = array(
        'ease_scroll_toggle'            => get_theme_mod( PEPSI_OPTIONS::EASE_SCROLL_TOGGLE, PEPSI_DEFAULTS::EASE_SCROLL_TOGGLE ) ? 'yes' : 'no',
    );
    $pepsi_parallax_JS = array(
        'intensity_value'   => pepsi_get_parallax_preset('vertical')
    );
    
    // Localizations
    wp_localize_script( 'pepsi-header', 'pepsi_local', $pepsi_header_JS );
    wp_localize_script( 'pepsi-general', 'pepsi_local_general', $pepsi_general_JS );
    wp_localize_script( 'pepsi-parallax', 'pepsi_local_parallax', $pepsi_parallax_JS );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
}
add_action( 'wp_enqueue_scripts', 'pepsi_scripts' );