<?php

/**
 * Pepsi Theme Customizer
 *
 * @package Pepsi
 */
if ( !class_exists( 'AcidConfig' ) ) { include_once get_template_directory() . '/inc/lib/Acid/acid.php'; }

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pepsi_customize_register( $wp_customize ) {
    
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    
    
    // Housekeeping ------------------------------------------------------------
    $wp_customize->get_section( 'header_image' )->panel = 'panel_custom_header';
    $wp_customize->get_section( 'title_tagline' )->title = __( 'General Settings', 'pepsi' );
    $wp_customize->get_section( 'title_tagline' )->panel = 'panel_title_tagline';
//    $wp_customize->get_panel('widgets')->title = __( 'Page Builder & Widgets' );
    // End Housekeeping --------------------------------------------------------
    
    
    // Priority ----------------------------------------------------------------
    $wp_customize->get_section( 'title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_navbar' )->priority = 2;
    $wp_customize->get_panel( 'panel_custom_header' )->priority = 3;
    $wp_customize->get_panel( 'panel_blog' )->priority = 4;
    $wp_customize->get_panel( 'panel_appearance' )->priority = 5;
    // End Priority ------------------------------------------------------------
    
    // Selective Refresh -------------------------------------------------------
    if ( isset( $wp_customize->selective_refresh ) ) {
        
        $wp_customize->selective_refresh->add_partial( 'blogname', array (
            'selector' => '.site-title a',
            'render_callback' => 'pepsi_customize_partial_blogname',
        ) );
        
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array (
            'selector' => '.site-description',
            'render_callback' => 'pepsi_customize_partial_blogdescription',
        ) );
        
        $wp_customize->selective_refresh->add_partial( PEPSI_OPTIONS::NAVBAR_SHOW_SOCIAL, array(
            'selector'  => '.navbar-social'
        ) );
        
        $wp_customize->selective_refresh->add_partial( PEPSI_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE, array(
            'selector'  => '#custom-header-content'
        ) );
        
        $wp_customize->selective_refresh->add_partial( PEPSI_OPTIONS::BLOG_SHOW_DATE, array(
            'selector'  => '.masonry_card_blog .post-date'
        ) );
        
        $wp_customize->selective_refresh->add_partial( PEPSI_OPTIONS::BLOG_CARD_FONT_SIZE_DSK, array(
            'selector'  => '.masonry_card_blog .entry-title'
        ) );
        
        $wp_customize->selective_refresh->add_partial( PEPSI_OPTIONS::BLOG_SHOW_COMMENT_COUNT, array(
            'selector'  => '.masonry_card_blog .meta-stats'
        ) );
        
    }
    // End Selective Refresh ---------------------------------------------------
}

add_action( 'customize_register', 'pepsi_customize_register', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pepsi_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pepsi_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pepsi_customize_preview_js() {
    wp_enqueue_style( 'pepsi-customizer-preview-style', get_template_directory_uri() . '/assets/admin/css/customizer-preview.css', PEPSI_VERSION, null );
    wp_enqueue_script( 'pepsi-customizer-preview-script', get_template_directory_uri() . '/assets/admin/js/customizer-preview.js', array ( 'jquery', 'customize-preview' ), PEPSI_VERSION, true );
}
add_action( 'customize_preview_init', 'pepsi_customize_preview_js' );


function pepsi_customize_controls_js() {
    wp_enqueue_script( 'pepsi-customizer-control', get_template_directory_uri() . '/assets/admin/js/customizer-control.js', array ( 'jquery', 'customize-controls' ), PEPSI_VERSION, true );
    wp_enqueue_style( 'pepsi-customizer-style', get_template_directory_uri() . '/assets/admin/css/customizer-alt.css', PEPSI_VERSION, null );
}
add_action( 'customize_controls_enqueue_scripts', 'pepsi_customize_controls_js' );


$acid = acid_instance( get_template_directory_uri() . '/inc/lib/' );

$data = array (
    
    'sections'  => array(
        
        'static_front_page'  => array(
            
            'title'         => __( 'Homepage Settings', 'pepsi' ),
            'desciption'    => __( 'You can choose what\'s displayed on the homepage of your site. It can be posts in reverse chronological order (classic blog), or a fixed/static page. To set a static homepage, you first need to create two Pages. One will become the homepage, and the other will be where your posts are displayed.', 'pepsi' ),
            'options'       => array(
                
                PEPSI_OPTIONS::HOMEPAGE_SHOW_CONTENT => array (
                    'type'          => 'toggle',
                    'label'         => __( 'Show the Frontpage Content?', 'pepsi' ),
                    'description'   => __( 'While this is on, the content of the page set as the static Homepage will be visible', 'pepsi' ),
                    'default'       => PEPSI_DEFAULTS::HOMEPAGE_SHOW_CONTENT,
                ),
                
            ),
            
        ),
        
    ),

    'panels' => array (

        // Panel: Site Title & Logo --------------------------------------------
        'panel_title_tagline' => array (

            'title'         => __( 'Site Title & Logo', 'pepsi' ),
            'sections'      => array (
                
                // Section : Site Title & Logo: Advanced -----------------------
                'section_title_tagline' => array (

                    'title' => __( 'Advanced Settings', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::NAVBAR_BRANDING_WHAT_TO_SHOW => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Branding', 'pepsi' ),
                            'description'   => __( 'Set whether the Navbar shows Site Title & Tagline or the custom Logo (if one is set).', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_WHAT_TO_SHOW,
                            'choices'   => array (
                                'title_tagline'     => __( 'Title & Tagline', 'pepsi' ),
                                'logo'              => __( 'Logo', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_ALWAYS_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Logo - Always Visible?', 'pepsi' ),
                            'description'   => __( 'If on, the logo will be visible even when Slim Navbar is collapsed / unstuck', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_ALWAYS_SHOW_LOGO,
                        ),
                        PEPSI_OPTIONS::NAVBAR_LOGO_HORIZONTAL_PADDING => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Horizontal Padding', 'pepsi' ),
                            'description'   => __( 'Set the space (in pixels) between menu links and the logo', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LOGO_HORIZONTAL_PADDING
                        ),
                        PEPSI_OPTIONS::NAVBAR_LOGO_HEIGHT_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Desktop)', 'pepsi' ),
                            'description'   => __( 'Set the logo height for the desktop Navbar', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LOGO_HEIGHT_DSK
                        ),
                        PEPSI_OPTIONS::NAVBAR_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Mobile)', 'pepsi' ),
                            'description'   => __( 'Set the logo height for the mobile Navbar', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LOGO_HEIGHT_MBL
                        ),
                        PEPSI_OPTIONS::NAVBAR_SITE_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Title - Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SITE_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Title - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SITE_TITLE_FONT_SIZE
                        ),
                        PEPSI_OPTIONS::NAVBAR_SITE_TITLE_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Site Title - Letter Spacing', 'pepsi' ),
                            'description'   => __( 'Set the scaling "em" value. Can be positive or negative. 0 for normal spacing.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SITE_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'pepsi' ),
                                '-.075'     => __( '-.075em', 'pepsi' ),
                                '-.050'     => __( '-.050em', 'pepsi' ),
                                '-.025'     => __( '-.025em', 'pepsi' ),
                                '0.0'       => __( '0.00em (Default)', 'pepsi' ),
                                '.025'      => __( '.025em', 'pepsi' ),
                                '.050'      => __( '.050em', 'pepsi' ),
                                '.075'      => __( '.075em', 'pepsi' ),
                                '.100'      => __( '.100em', 'pepsi' ),
                                '.250'      => __( '.250em', 'pepsi' ),
                                '.500'      => __( '.500em (Widest)', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_SITE_TITLE_ALL_CAPS => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Site Title - All Uppercase?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SITE_TITLE_ALL_CAPS
                        ),
                        PEPSI_OPTIONS::NAVBAR_HIDE_TAGLINE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Hide Site Tagline?', 'pepsi' ),
                            'description'   => __( 'Both the Title & Tagline show by default when no logo is chosen', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_HIDE_TAGLINE,
                        ),
                        PEPSI_OPTIONS::NAVBAR_TAGLINE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Tagline - Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_TAGLINE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Tagline - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_TAGLINE_FONT_SIZE
                        ),
                        
                    )

                ),
                
            ), // End of Site Identity

        ), // End of Site Identity Panel
            
            
        // Panel: Custom Header ------------------------------------------------
        'panel_custom_header' => array (

            'title'         => __( 'Header', 'pepsi' ),
            'desciption'    => __( 'Customize the header banner on your site', 'pepsi' ),
            'sections'      => array (

                // Section : Custom Header Settings ----------------------------
                'section_custom_header_general' => array (

                    'title' => __( 'General Settings', 'pepsi' ),
                    'options' => array (
                        // Style
                        PEPSI_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Header - Parallax Style', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_STYLE_TOGGLE,
                            'choices'   => array (
                                'parallax_vertical'     => __( 'Vertical Scroll', 'pepsi' ),
                                'parallax_layers'       => __( 'Perspective Layers', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_HEIGHT_CALC => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Height Calculation', 'pepsi' ),
                            'description'   => __( 'This allows you to choose between using % values or fixed pixel values for setting the header height', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_HEIGHT_CALC,
                            'choices'   => array (
                                'percent'   => __( 'Use % of browser height', 'pepsi' ),
                                'fixed'     => __( 'Use a fixed pixel value', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (%)', 'pepsi' ),
                            'description'   => __( 'Setting this to 100 will match the Header height to the browser window on both Desktop and Mobile devices.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT,
                            'min'           => 25,
                            'max'           => 100,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (%)', 'pepsi' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT_MBL,
                            'max'           => 100,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_HEIGHT_PX => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (px)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX,
                            'min'           => 250,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_HEIGHT_PX_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (px)', 'pepsi' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX_MBL,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_PLX_INTENSITY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Parallax Effect - Intensity', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_PLX_INTENSITY,
                            'choices'   => array (
                                'subtle'            => __( 'Subtle', 'pepsi' ),
                                'default'           => __( 'Medium (Default)', 'pepsi' ),
                                'high'              => __( 'High', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TEXTURE_IMG => array (
                            'type'          => 'image',
                            'label'         => __( 'Perspective Layers - Transparent Pattern', 'pepsi' ),
                            'description'   => __( 'https://www.transparenttextures.com', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TEXTURE_IMG,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TEXTURE_OPAC => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Perspective Layers - Pattern (Opacity)', 'pepsi' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TEXTURE_OPAC,
                        ),
                        
                    )

                ),
                
                // Section : Custom Header Locations ----------------------------
                'section_custom_header' => array (

                    'title' => __( 'Display Locations', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_POSTS => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Posts?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_POSTS,
                        ),
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_PAGES => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Pages?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_PAGES,
                        ),
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_FRONT => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Front Page?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_FRONT,
                        ),
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_BLOG => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Blog?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_BLOG,
                        ),
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_ARCHIVE => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Archive Pages?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_ARCHIVE,
                        ),
                        
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_ON_SHOP => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Shop Page?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_ON_SHOP,
                        ),
                        
                    )

                ),

                // Section : Custom Header - Logo Settings ---------------------
                'section_custom_header_logo' => array (

                    'title' => __( 'Content', 'pepsi' ),
                    'options' => array (

                        // Logo
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Site Logo?', 'pepsi' ),
                            'description'   => __( 'If on, the Custom Logo for the site will be displayed', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_LOGO,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo (px)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo for Mobile (px)', 'pepsi' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT_MBL,
                        ),
                        
                        // Main Heading
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_TITLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Main Heading?', 'pepsi' ),
                            'description'   => __( 'If on, the primary content heading will be displayed', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_TITLE
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_CONTENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'What to Display?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_CONTENT,
                            'choices'   => array (
                                'site_title'        => __( 'Site Title', 'pepsi' ),
                                'site_description'  => __( 'Site Description', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_SIZE
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'pepsi' ),
                                '-.075'     => __( '-.075em', 'pepsi' ),
                                '-.050'     => __( '-.050em', 'pepsi' ),
                                '-.025'     => __( '-.025em', 'pepsi' ),
                                '0.0'       => __( '0.00em', 'pepsi' ),
                                '.025'      => __( '.025em', 'pepsi' ),
                                '.050'      => __( '.050em', 'pepsi' ),
                                '.075'      => __( '.075em', 'pepsi' ),
                                '.100'      => __( '.100em', 'pepsi' ),
                                '.250'      => __( '.250em (Default)', 'pepsi' ),
                                '.500'      => __( '.500em (Widest)', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'All Uppercase?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_ALL_CAPS
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_COLOR
                        ),

                    )

                ),

                // Section : Custom Header - Menu Settings ---------------------
                'section_custom_header_menu' => array (

                    'title' => __( 'Custom Menu', 'pepsi' ),
                    'options' => array (

                        // Menu
                        PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_MENU => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Menu?', 'pepsi' ),
                            'description'   => __( 'If on, the "Custom Header" menu will be displayed (if one is set)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_MENU
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_FONT_SIZE
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Menu - Link Letter Spacing', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'pepsi' ),
                                '-.075'     => __( '-.075em', 'pepsi' ),
                                '-.050'     => __( '-.050em', 'pepsi' ),
                                '-.025'     => __( '-.025em', 'pepsi' ),
                                '0.0'       => __( '0.00em', 'pepsi' ),
                                '.025'      => __( '.025em', 'pepsi' ),
                                '.050'      => __( '.050em', 'pepsi' ),
                                '.075'      => __( '.075em', 'pepsi' ),
                                '.100'      => __( '.100em', 'pepsi' ),
                                '.250'      => __( '.250em', 'pepsi' ),
                                '.500'      => __( '.500em (Default/Widest)', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_COLOR
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Link Spacing', 'pepsi' ),
                            'description'   => __( 'Amount of space in px between each link in the menu', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_LINKS_GAP
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_MENU_BUTTONS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style all Custom Header menu items as Buttons?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_MENU_BUTTONS
                        ),
                       
                    )

                ),

                // Section : Custom Header Style - Parallax Layers -------------
                'section_custom_header_plx_vertical' => array (

                    'title' => __( 'Color / Gradient Overlay', 'pepsi' ),
                    'options' => array (

                        PEPSI_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Include a colored overlay layer?', 'pepsi' ),
                            'description'   => __( 'If "Yes", a semi-transparent colored layer will be added between the texture and content layers', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE,
                            'choices'   => array (
                                'no'        => __( 'No Color', 'pepsi' ),
                                'single'    => __( 'Single Color', 'pepsi' ),
                                'gradient'  => __( 'Gradient', 'pepsi' ),
                            )
                        ),

                        // Overlay - Single Color
                        PEPSI_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Color Overlay - Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_COLOR,
                        ),
                        PEPSI_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Color Overlay - Color (Opacity)', 'pepsi' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_OPACITY,
                        ),

                        // Overlay - Gradient
                        PEPSI_OPTIONS::GRADIENT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Gradient - Style', 'pepsi' ),
                            'description'   => __( 'Choose from linear or radial', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_STYLE,
                            'choices'   => array (
                                'linear'    => __( 'Linear', 'pepsi' ),
                                'radial'    => __( 'Radial', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::GRADIENT_OVERALL_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient - Layer Opacity', 'pepsi' ),
                            'description'   => __( 'This option can be used to set transparency for the entire gradient. Set 0.0 for transparent, up to 1.0 for solid/opaque', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_OVERALL_OPACITY,
                        ),
                        PEPSI_OPTIONS::GRADIENT_LINEAR_DIRECTION => array (
                            'type'          => 'select',
                            'label'         => __( 'Linear Gradient - Direction', 'pepsi' ),
                            'description'   => __( 'Set the linear gradient direction (Start to End)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_LINEAR_DIRECTION,
                            'choices'   => array (
                                'up'        => __( 'Up', 'pepsi' ),
                                'down'      => __( 'Down', 'pepsi' ),
                                'right'     => __( 'Right', 'pepsi' ),
                                'left'      => __( 'Left', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::GRADIENT_START_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - Start Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_START_COLOR,
                        ),
                        PEPSI_OPTIONS::GRADIENT_START_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - Start Color (Opacity)', 'pepsi' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_START_COLOR_OPACITY,
                        ),
                        PEPSI_OPTIONS::GRADIENT_END_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - End Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_END_COLOR,
                        ),
                        PEPSI_OPTIONS::GRADIENT_END_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - End Color (Opacity)', 'pepsi' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::GRADIENT_END_COLOR_OPACITY,
                        ),
                        
                    )

                ),

            ), // End of Custom Header Sections

        ), // End of Custom Header Panel

        // Panel: Blog ---------------------------------------------------------
        'panel_blog' => array (

            'title'         => __( 'Blog', 'pepsi' ),
            'desciption'    => __( 'Customize the blog and archive pages on your site', 'pepsi' ),
            'sections'      => array (

                // Section : Blog General Settings ------------------------------
                'section_blog_general' => array (

                    'title' => __( 'General Settings', 'pepsi' ),
                    'options' => array (

                        PEPSI_OPTIONS::BLOG_LAYOUT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Style', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_LAYOUT_STYLE,
                            'choices'   => array (
                                'blog_standard' => __( 'Standard', 'pepsi' ),
                                'blog_masonry'  => __( 'Masonry - Cards', 'pepsi' ),
                                'blog_mosaic'   => __( 'Mosaic - Grid', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::BLOG_SHOW_DATE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Date Posted?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_SHOW_DATE,
                        ),
                        PEPSI_OPTIONS::BLOG_SHOW_AUTHOR => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Author?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_SHOW_AUTHOR,
                        ),
                        PEPSI_OPTIONS::BLOG_SHOW_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Content / Excerpt?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_SHOW_CONTENT,
                        ),
                        PEPSI_OPTIONS::BLOG_SHOW_CATEGORY => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Category Footer?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_SHOW_CATEGORY,
                        ),
                        PEPSI_OPTIONS::BLOG_SHOW_COMMENT_COUNT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show the Comment Count in the Meta Stats tab?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_SHOW_COMMENT_COUNT,
                        ),
                        PEPSI_OPTIONS::BLOG_EXCERPT_TRIM_NUM => array (
                            'type'          => 'number',
                            'label'         => __( 'Automatic Excerpt - Trim by Number of Words', 'pepsi' ),
                            'description'   => __( 'If no manual excerpt exists, a post will show this many words of preview content', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_EXCERPT_TRIM_NUM,
                        ),
                        PEPSI_OPTIONS::BLOG_READ_MORE_TEXT => array (
                            'type'          => 'text',
                            'label'         => __( 'Automatic Excerpt - "Read more" Link Text', 'pepsi' ),
                            'description'   => __( 'This link only shows on posts with no manual excerpt, as a content preview will be used instead', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_READ_MORE_TEXT,
                        ),

                    )

                ),
                
                // Section : Blog Layout Settings ------------------------------
                'section_blog_advanced' => array (

                    'title' => __( 'Advanced Settings', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::BLOG_LAYOUT_NUM_COLS => array (
                            'type'          => 'select',
                            'label'         => __( 'Layout - Number of Columns', 'pepsi' ),
                            'description'   => __( 'Mobile devices will automatically show fewer columns to maximize space.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_LAYOUT_NUM_COLS,
                            'choices'   => array (
                                '1col'      => __( 'Single Column', 'pepsi' ),
                                '2col'      => __( 'Two Columns', 'pepsi' ),
                                '3col'      => __( 'Three Columns', 'pepsi' ),
                                '4col'      => __( 'Four Columns', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::BLOG_CARD_APPEARANCE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Card Appearance', 'pepsi' ),
                            'description'   => __( 'Select whether the Standard style blog cards should appear flat, or as raised cards with a shadow.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_CARD_APPEARANCE,
                            'choices'   => array (
                                'flat'      => __( 'Flat', 'pepsi' ),
                                'raised'    => __( 'Raised', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::BLOG_CARD_BORDER_RADIUS => array (
                            'type'          => 'number',
                            'label'         => __( 'Round Corners on Posts in the Blog?', 'pepsi' ),
                            'description'   => __( 'Set this to 0 for sharp corners, or set the rounding value in pixels.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_CARD_BORDER_RADIUS,
                        ),
                        PEPSI_OPTIONS::BLOG_CARD_MOSAIC_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Space around each Mosaic tile?', 'pepsi' ),
                            'description'   => __( 'This is the uncombined padding around each tile. For example, setting this to 5px per tile will equal a 10px wide gutter. Set to 0 for gapless tiles.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_CARD_MOSAIC_GAP,
                        ),
                        PEPSI_OPTIONS::BLOG_CARD_FONT_SIZE_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Desktop)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_CARD_FONT_SIZE_DSK,
                        ),
                        PEPSI_OPTIONS::BLOG_CARD_FONT_SIZE_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Mobile)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_CARD_FONT_SIZE_MBL,
                        ),
                        PEPSI_OPTIONS::BLOG_META_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Date & Author - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::BLOG_META_FONT_SIZE,
                        ),

                    )

                ),

            ), // End of Blog Sections

        ), // End of Blog Panel

        // Panel: Navbar -------------------------------------------------------
        null => array (

            'sections'       => array (

                'section_nav_social_links' => array (

                    'title' => __( 'Social Links', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::SOCIAL_URL_1 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #1 - URL', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_URL_1
                        ),
                        PEPSI_OPTIONS::SOCIAL_ICON_1 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #1 - Icon', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_ICON_1,
                            'choices'       => pepsi_get_icons( 'social' )
                        ),
                        PEPSI_OPTIONS::SOCIAL_URL_2 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #2 - URL', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_URL_2
                        ),
                        PEPSI_OPTIONS::SOCIAL_ICON_2 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #2 - Icon', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_ICON_2,
                            'choices'       => pepsi_get_icons( 'social' )
                        ),
                        PEPSI_OPTIONS::SOCIAL_URL_3 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #3 - URL', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_URL_3
                        ),
                        PEPSI_OPTIONS::SOCIAL_ICON_3 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #3 - Icon', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_ICON_3,
                            'choices'       => pepsi_get_icons( 'social' )
                        ),
                        PEPSI_OPTIONS::SOCIAL_URL_4 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #4 - URL', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_URL_4
                        ),
                        PEPSI_OPTIONS::SOCIAL_ICON_4 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #4 - Icon', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_ICON_4,
                            'choices'       => pepsi_get_icons( 'social' )
                        ),
                        PEPSI_OPTIONS::SOCIAL_URL_5 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #5 - URL', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_URL_5
                        ),
                        PEPSI_OPTIONS::SOCIAL_ICON_5 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #5 - Icon', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::SOCIAL_ICON_5,
                            'choices'       => pepsi_get_icons( 'social' )
                        ),

                    )

                ),
                
            ), // End of Social Section
            
        ), // End of Social Panel

        // Panel: Navbar -------------------------------------------------------
        'panel_navbar' => array (

            'title'         => __( 'Navbar', 'pepsi' ),
            'desciption'    => __( 'Customize the primary navbar on your site, including control over appearance & behaviour', 'pepsi' ),
            'sections'      => array (
                
                // Section : Navbar General Settings ---------------------------
                'section_nav_general' => array (

                    'title' => __( 'General Settings', 'pepsi' ),
                    'options' => array (

                        PEPSI_OPTIONS::NAVBAR_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Style', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_STYLE,
                            'choices'   => array (
                                'slim_split'    => __( 'Slim - Centered & Split', 'pepsi' ),
                                'slim_left'     => __( 'Slim - Left Aligned', 'pepsi' ),
                                'banner'        => __( 'Banner', 'pepsi' ),
                                'dual'          => __( 'Dual', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_LINKS_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Links - Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LINKS_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_LINKS_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LINKS_FONT_SIZE
                        ),
                        PEPSI_OPTIONS::NAVBAR_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Gap Between Links', 'pepsi' ),
                            'label'         => __( 'Set the pixel value for the amount of space between links', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_LINKS_GAP
                        ),
                        PEPSI_OPTIONS::NAVBAR_HAS_SHADOW => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Add a box shadow to the Navbar?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_HAS_SHADOW,
                        ),
                        PEPSI_OPTIONS::NAVBAR_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Social Links in Navbar?', 'pepsi' ),
                            'description'   => __( 'If on, social links will display in the Navbar. Navbar styles display these in different ways', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SHOW_SOCIAL,
                        ),
                        
                    )

                ),

                // Section : Slim Style Settings ---------------------------
                'section_nav_style_a' => array (

                    'title' => __( 'Advanced Settings', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::NAVBAR_INITIAL_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Initial)', 'pepsi' ),
                            'description'   => __( 'When the Slim Navbar is at the very top of the page (unstuck)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_INITIAL_HEIGHT
                        ),
                        PEPSI_OPTIONS::NAVBAR_STICKY_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Sticky)', 'pepsi' ),
                            'description'   => __( 'When the Slim Navbar is sticky, after the user scrolls down the page', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_STICKY_HEIGHT
                        ),
                        PEPSI_OPTIONS::NAVBAR_RIGHT_ALIGN_MENU => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Right Aligned Menu?', 'pepsi' ),
                            'description'   => __( 'If on, the menu will be right-aligned. For the "Slim - Left Aligned" style of Navbar, the menu will replace the Social Links section', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_RIGHT_ALIGN_MENU,
                        ),
                        PEPSI_OPTIONS::NAVBAR_BOXED_CONTENT => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Box the Content?', 'pepsi' ),
                            'description'   => __( 'If on, the Navbar content will be lined up with the main content of the page instead of the left & right bounds of the window', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BOXED_CONTENT,
                        ),
                        PEPSI_OPTIONS::NAVBAR_TRANSPARENT_MENU_BG => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Transparent Menu?', 'pepsi' ),
                            'description'   => __( 'If on, the menu will be transparent, allowing the Navbar background (color or image) to show through', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_TRANSPARENT_MENU_BG,
                        ),
                        PEPSI_OPTIONS::NAVBAR_BRANDING_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - Alignment', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'pepsi' ),
                                'center'    => __( 'Centered', 'pepsi' ),
                                'right'     => __( 'Right', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_MENU_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Menu - Alignment', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_MENU_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'pepsi' ),
                                'center'    => __( 'Centered', 'pepsi' ),
                                'right'     => __( 'Right', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above', 'pepsi' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding (for the Banner style of Navbar)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_DSK
                        ),
                        PEPSI_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below', 'pepsi' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding (for the Banner style of Navbar)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK
                        ),
                        PEPSI_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above (Mobile)', 'pepsi' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding on mobile devices (for the Banner style of Navbar)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_MBL
                        ),
                        PEPSI_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below (Mobile)', 'pepsi' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding on mobile devices (for the Banner style of Navbar)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL
                        ),
                        PEPSI_OPTIONS::NAVBAR_FINAL_LINK_ACCENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style final Navbar link as a CTA?', 'pepsi' ),
                            'description'   => __( 'When toggled on, the last (right-most) link in the Navbar will appear as a unique button callout', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_FINAL_LINK_ACCENT
                        ),
                        PEPSI_OPTIONS::NAVBAR_FINAL_LINK_ROUNDED => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Rounded button?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_FINAL_LINK_ROUNDED
                        ),
                        PEPSI_OPTIONS::NAVBAR_FINAL_LINK_FILL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Color fill?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_FINAL_LINK_FILL
                        ),

                    )

                ),

                // Section : Navbar Colors -------------------------------------
                'section_nav_colors' => array (

                    'title' => __( 'Colors', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::NAVBAR_BG_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Background Style', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BG_STYLE,
                            'choices'   => array (
                                'color'     => __( 'Color', 'pepsi' ),
                                'image'     => __( 'Background Image', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Background Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Foreground Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_MENU_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Background Color', 'pepsi' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the background color for the menu bar', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_MENU_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_MENU_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Foreground Color', 'pepsi' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the foreground color for the menu bar', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_MENU_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::NAVBAR_BG_IMAGE => array (
                            'type'          => 'image',
                            'label'         => __( 'Background Image', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_BG_IMAGE,
                        ),
                        PEPSI_OPTIONS::NAVBAR_SOCIAL_BG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Drawer Background', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SOCIAL_BG_COLOR,
                        ),
                        PEPSI_OPTIONS::NAVBAR_SOCIAL_FG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR,
                        ),
                        PEPSI_OPTIONS::NAVBAR_SOCIAL_FG_COLOR_HOVER => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons (Hover)', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR_HOVER,
                        ),

                    )

                ),

            ), // End of Navbar Sections

        ), // End of Navbar Panel

        // Panel: Appearance ---------------------------------------------------
        'panel_appearance' => array (

            'title'         => __( 'Appearance', 'pepsi' ),
            'description'   => __( 'Customize your site colors, fonts, and more', 'pepsi' ),
            'sections'      => array (

                // Section : Colors --------------------------------------------
                'section_colors' => array (

                    'title'         => __( 'Skin Colors', 'pepsi' ),
                    'description'   => __( 'Customize the color theme in use on your site', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::COLOR_SKIN_PRIMARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Primary', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::COLOR_SKIN_PRIMARY,
                            'choices'   => array(
                                '#f04265'       => __( 'Cherry Gloss', 'pepsi' ),
                                '#13ecb6'       => __( 'Seafoam Coast', 'pepsi' ),
                                '#7f66ff'       => __( 'Royal Lilac', 'pepsi' ),
                                '#00d4ff'       => __( 'Sky Blue', 'pepsi' ),
                            ),
                        ),
                        PEPSI_OPTIONS::COLOR_SKIN_SECONDARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Secondary', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::COLOR_SKIN_SECONDARY,
                            'choices'   => array(
                                '#d60059'       => __( 'Magenta Rose', 'pepsi' ),
                                '#04aeae'       => __( 'Tide Pool', 'pepsi' ),
                                '#6e3399'       => __( 'Wildberry', 'pepsi' ),
                                '#0b84da'       => __( 'Ocean Swell', 'pepsi' ),
                            ),
                        ),

                    ),

                ),

                // Section : Fonts ---------------------------------------------
                'fonts' => array (

                    'title'         => __( 'Fonts', 'pepsi' ),
                    'description'   => __( 'Customize the fonts in use on your site. Visit <a target="_BLANK" href="https://fonts.google.com/"> Google Fonts to see font options.</a> Please be advised some fonts on this link may not be present in the theme, as Google Fonts are constantly updated. We periodically update the font list here from Google Fonts.', 'pepsi' ),
                    'options' => array (
                        
                        // Primary Font
                        PEPSI_OPTIONS::FONT_PRIMARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Primary Font - For Headings & Titles', 'pepsi' ),
                            'default'   => PEPSI_DEFAULTS::FONT_PRIMARY,
                            'choices'   => pepsi_fonts(),
                        ),
                        PEPSI_OPTIONS::FONT_HEADINGS_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing for Headings & Titles', 'pepsi' ),
                            'description'   => __( 'Set to 0 for normal spacing, negative for smaller gap between letters, positive for increased separation.', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FONT_HEADINGS_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'pepsi' ),
                                '-.075'     => __( '-.075em', 'pepsi' ),
                                '-.050'     => __( '-.050em', 'pepsi' ),
                                '-.025'     => __( '-.025em', 'pepsi' ),
                                '0.0'         => __( '0.00em (Default)', 'pepsi' ),
                                '.025'      => __( '.025em', 'pepsi' ),
                                '.050'      => __( '.050em', 'pepsi' ),
                                '.075'      => __( '.075em', 'pepsi' ),
                                '.100'      => __( '.100em (Widest)', 'pepsi' ),
                            )
                        ),

                        // Secondary Font
                        PEPSI_OPTIONS::FONT_SECONDARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Secondary Font - For Content', 'pepsi' ),
                            'default'   => PEPSI_DEFAULTS::FONT_SECONDARY,
                            'choices'   => pepsi_fonts(),
                        ),
                        PEPSI_OPTIONS::FONT_BODY_SIZE => array(
                            'type'      => 'number',
                            'label'     => __( 'Secondary Font - Text Size (px)', 'pepsi' ),
                            'default'   => PEPSI_DEFAULTS::FONT_BODY_SIZE,
                        ),

                    ),

                ),
                
                // Section : Smooth Scrolling ----------------------------------
                'section_scroll' => array (

                    'title'         => __( 'Smooth Scrolling', 'pepsi' ),
                    'description'   => __( 'Customize whether the Smooth Scrolling feature is enabled on your site', 'pepsi' ),
                    'options' => array (
                        
                        PEPSI_OPTIONS::EASE_SCROLL_TOGGLE => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Enable Smooth Scrolling?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::EASE_SCROLL_TOGGLE,
                        ),

                    ),

                ),

            ), // End of Appearance Sections

        ), // End of Appearance Panel

        // Panel: Footer -------------------------------------------------------
        'panel_footer' => array (

            'title'         => __( 'Footer', 'pepsi' ),
            'desciption'    => __( 'Customize the theme footer', 'pepsi' ),
            'sections'      => array (

                // Section : Pre-Footer Widget Area Settings  ------------------
                'section_pre_footer' => array (

                    'title'     => __( 'Pre-Footer Sidebar', 'pepsi' ),
                    'options'   => array (
                        
                        PEPSI_OPTIONS::FOOTER_NUM_WIDGET_COLS => array (
                            'type'          => 'range',
                            'label'         => __( 'Number of Widget Columns' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_NUM_WIDGET_COLS,
                            'min'           => 1,
                            'max'           => 4,
                            'step'          => 1
                        ),
                        PEPSI_OPTIONS::WIDGETS_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Widget Titles - Font Family', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WIDGETS_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'pepsi' ),
                                'secondary' => __( 'Use Secondary Font', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::WIDGETS_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Widget Titles - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WIDGETS_TITLE_FONT_SIZE,
                        ),
                        PEPSI_OPTIONS::WIDGETS_TITLE_FONT_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Widget Titles - Letter Spacing', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WIDGETS_TITLE_FONT_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'pepsi' ),
                                '-.075'     => __( '-.075em', 'pepsi' ),
                                '-.050'     => __( '-.050em', 'pepsi' ),
                                '-.025'     => __( '-.025em', 'pepsi' ),
                                '0.0'       => __( '0.00em', 'pepsi' ),
                                '.025'      => __( '.025em', 'pepsi' ),
                                '.050'      => __( '.050em', 'pepsi' ),
                                '.075'      => __( '.075em', 'pepsi' ),
                                '.100'      => __( '.100em', 'pepsi' ),
                                '.250'      => __( '.250em (Default)', 'pepsi' ),
                                '.500'      => __( '.500em (Widest)', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::WIDGETS_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Widget Titles - All Uppercase?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WIDGETS_TITLE_ALL_CAPS,
                        ),
                        PEPSI_OPTIONS::FOOTER_BORDER_TOP_THICKNESS => array (
                            'type'          => 'number',
                            'label'         => __( 'Colored Top Border - Thickness', 'pepsi' ),
                            'description'   => __( 'If set to a value greater than 0, the Prefooter will include a primary color top border of this many pixels', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_BORDER_TOP_THICKNESS,
                        ),
                        
                    )
                    
                ),
                        
                // Section : Footer General Settings  --------------------------
                'section_footer_general' => array (

                    'title'     => __( 'General Settings', 'pepsi' ),
                    'options'   => array (

                        PEPSI_OPTIONS::FOOTER_BOXED_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Boxed Content?', 'pepsi' ),
                            'description'   => __( 'If on, the Footer will be lined up with the main content instead of the left & right bounds of the window', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_BOXED_CONTENT,
                        ),
                        PEPSI_OPTIONS::FOOTER_CENTER_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Centered?', 'pepsi' ),
                            'description'   => __( 'If on, the Footer content will be centered', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_CENTER_BRANDING,
                        ),
                        PEPSI_OPTIONS::FOOTER_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Social?', 'pepsi' ),
                            'description'   => __( 'If on, the Footer will include the social icon links you have set', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_SHOW_SOCIAL,
                        ),
                        PEPSI_OPTIONS::FOOTER_SHOW_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Branding?', 'pepsi' ),
                            'description'   => __( 'If on,  the Footer will include either an alternate custom logo or your site title', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_SHOW_BRANDING,
                        ),
                        PEPSI_OPTIONS::FOOTER_SHOW_COPYRIGHT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Copyright?', 'pepsi' ),
                            'description'   => __( 'If on, the Footer will include the copyright tagline you set', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_SHOW_COPYRIGHT,
                        ),
                        PEPSI_OPTIONS::FOOTER_COPYRIGHT_TAGLINE => array (
                            'type'          => 'text',
                            'label'         => __( 'Copyright - Tagline Text', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE,
                        ),
                        PEPSI_OPTIONS::FOOTER_BRANDING_TYPE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - What to Display?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_BRANDING_TYPE,
                            'choices'   => array (
                                'site_title'    => __( 'Show Site Title', 'pepsi' ),
                                'alt_logo'      => __( 'Show Logo', 'pepsi' ),
                            )
                        ),
                        PEPSI_OPTIONS::FOOTER_ALTERNATE_LOGO => array (
                            'type'          => 'image',
                            'label'         => __( 'Branding - Logo', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_ALTERNATE_LOGO,
                        ),
                        PEPSI_OPTIONS::FOOTER_ALTERNATE_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Logo Height', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_ALTERNATE_LOGO_HEIGHT,
                        ),
                        PEPSI_OPTIONS::FOOTER_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_SITE_TITLE_FONT_SIZE
                        ),
                        PEPSI_OPTIONS::FOOTER_SITE_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Branding - All Uppercase?', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_SITE_TITLE_ALL_CAPS
                        ),
                        PEPSI_OPTIONS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Copyright - Font Size', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE
                        ),

                    )

                ),

                // Section : Footer Colors -------------------------------------
                'section_footer_colors' => array (

                    'title'     => __( 'Colors', 'pepsi' ),
                    'options'   => array (
                        
                        // Pre-Footer Background
                        PEPSI_OPTIONS::PRE_FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Background Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::PRE_FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),

                        // Pre-Footer Foreground
                        PEPSI_OPTIONS::PRE_FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Foreground Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::PRE_FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),
                        
                        // Pre-Footer Widget Titles
                        PEPSI_OPTIONS::PRE_FOOTER_WIDGET_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Prefooter: Widgets Title Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::PRE_FOOTER_WIDGET_TITLE_COLOR,
                        ),
                        
                        // Footer Background
                        PEPSI_OPTIONS::FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Background Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#000000'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),

                        // Footer Foreground
                        PEPSI_OPTIONS::FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Foreground Color', 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'pepsi' ),
                                '#ffffff'    => __( 'Light', 'pepsi' ),
                            )
                        ),

                    )

                ),

            ), // End of Footer Sections

        ), // End of Footer Panel

        // Panel: WooCommerce --------------------------------------------------
        'woocommerce' => array (

            'title'         => __( 'WooCommerce', 'pepsi' ),
            'sections'      => array (

                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_featured' => array (

                    'title'     => __( 'Featured Products', 'pepsi' ),
                    'options'   => array (
                        
                        PEPSI_OPTIONS::WOO_SHOW_FEATURED_PRODUCTS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Featured Products at the top of the Shop page?' , 'pepsi' ),
                            'description'   => __( 'To feature a product, click the corresponding star icon on the Products page.' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_SHOW_FEATURED_PRODUCTS,
                        ),
                        PEPSI_OPTIONS::WOO_SHOW_FEATURED_PRODUCT_HEADING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show "Featured" Header Banner?' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_SHOW_FEATURED_PRODUCT_HEADING,
                        ),
                        PEPSI_OPTIONS::WOO_FEATURED_PRODUCTS_NUM_COLS => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Featured Products Per Row' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_FEATURED_PRODUCTS_NUM_COLS,
                            'choices'       => array (
                                'two'   => __( 'Two', 'pepsi' ),
                                'three' => __( 'Three', 'pepsi' ),
                            )
                        ),
                        
                    )
                    
                ),
                
                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_slide_cart' => array (

                    'title'     => __( 'Slide-In Cart', 'pepsi' ),
                    'options'   => array (
                        
                        PEPSI_OPTIONS::WOO_SLIDE_CART_TOGGLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include the Slide-In Cart Drawer?' , 'pepsi' ),
                            'description'   => __( 'If this is on, users can click a tab on the right side of the page to open a drawer displaying the items currently added to their cart.' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_SLIDE_CART_TOGGLE,
                        ),
                        PEPSI_OPTIONS::WOO_SLIDE_CART_TAB_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Tab: Color' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_SLIDE_CART_TAB_COLOR,
                        ),
                        PEPSI_OPTIONS::WOO_SLIDE_CART_TAB_ICON => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Tab: Icon' , 'pepsi' ),
                            'default'       => PEPSI_DEFAULTS::WOO_SLIDE_CART_TAB_ICON,
                            'choices'       => array (
                                'fa-shopping-cart'      =>  __( 'Cart', 'pepsi' ),
                                'fa-shopping-bag'       =>  __( 'Bag', 'pepsi' ),
                                'fa-shopping-basket'    =>  __( 'Basket', 'pepsi' ),
                            )
                        ),
                        
                    )
                    
                ),
                
            ), // End of Footer Sections

        ), // End of WooCommerce Panel
       
    ), // End of Panels

);

$acid->config( $data );
