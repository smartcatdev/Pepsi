<?php

// Register sidebars
add_action( 'widgets_init', 'pepsi_widgets_init' );


/**
 * Register widget area.
 *
 */
function pepsi_widgets_init() {

    register_sidebar( array (
        'name'              => esc_html__( 'Footer', 'pepsi' ),
        'id'                => 'sidebar-footer',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="' . 'col-sm-' . esc_attr( 12 / get_theme_mod( PEPSI_OPTIONS::FOOTER_NUM_WIDGET_COLS, PEPSI_DEFAULTS::FOOTER_NUM_WIDGET_COLS ) ) . ' widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));
    
    register_sidebar( array (
        'name'              => esc_html__( 'Frontpage - Above Content', 'pepsi' ),
        'id'                => 'sidebar-front-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Frontpage - Below Content', 'pepsi' ),
        'id'                => 'sidebar-front-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Blog - Above Content', 'pepsi' ),
        'id'                => 'sidebar-blog-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Blog - Below Content', 'pepsi' ),
        'id'                => 'sidebar-blog-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Post - Above Content', 'pepsi' ),
        'id'                => 'sidebar-post-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Post - Below Content', 'pepsi' ),
        'id'                => 'sidebar-post-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));
    
    register_sidebar( array (
        'name'              => esc_html__( 'Page - Above Content', 'pepsi' ),
        'id'                => 'sidebar-page-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Page - Below Content', 'pepsi' ),
        'id'                => 'sidebar-page-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));
    
    
    register_sidebar( array (
        'name'              => esc_html__( 'Page Template A - Above Content', 'pepsi' ),
        'id'                => 'sidebar-page-a-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Page Template A - Below Content', 'pepsi' ),
        'id'                => 'sidebar-page-a-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));
    
    register_sidebar( array (
        'name'              => esc_html__( 'Shop - Above Content', 'pepsi' ),
        'id'                => 'sidebar-shop-above',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    )); 
    
    register_sidebar( array (
        'name'              => esc_html__( 'Shop - Below Content', 'pepsi' ),
        'id'                => 'sidebar-shop-below',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Shop', 'pepsi' ),
        'id'                => 'sidebar-shop',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Sidebar A', 'pepsi' ),
        'id'                => 'sidebar-side-a',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Sidebar B', 'pepsi' ),
        'id'                => 'sidebar-side-b',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Sidebar C', 'pepsi' ),
        'id'                => 'sidebar-side-c',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array (
        'name'              => esc_html__( 'Blog & Archive', 'pepsi' ),
        'id'                => 'sidebar-blog-side',
        'description'       => esc_html__( 'Add widgets here.', 'pepsi' ),
        'before_widget'     => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));
    
}
