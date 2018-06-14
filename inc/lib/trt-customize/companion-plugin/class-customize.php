<?php

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Pepsi_Customize {

    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {
        
        static $instance = null;

        if ( is_null( $instance ) ) {
            $instance = new self;
            $instance->setup_actions();
        }

        return $instance;
    }

    /**
     * Constructor method.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function __construct() {
        
    }

    /**
     * Sets up initial actions.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function setup_actions() {

        // Register panels, sections, settings, controls, and partials.
        add_action( 'customize_register', array ( $this, 'sections' ) );

        // Register scripts and styles for the controls.
        add_action( 'customize_controls_enqueue_scripts', array ( $this, 'enqueue_control_scripts' ), 0 );
    }

    /**
     * Sets up the customizer sections.
     *
     * @since  1.0.0
     * @access public
     * @param  object  $manager
     * @return void
     */
    public function sections( $manager ) {

        // Load custom sections.
        require_once( trailingslashit( get_template_directory() ) . 'inc/lib/trt-customize/companion-plugin/section-pro.php' );

        // Register custom section types.
        $manager->register_section_type( 'Pepsi_Customize_Section_Pro' );

        // Register sections.
        $manager->add_section(
            new Pepsi_Customize_Section_Pro(
                $manager, 'pepsi_companion', array (
                    'title'             => esc_html__( 'Pepsi Theme Options & Widgets', 'pepsi' ),
                    'install_text'      => esc_html__( 'Activate Options', 'pepsi' ),
                    'dismiss_text'      => esc_html__( 'Dismiss', 'pepsi' ),
                    'install_url'       => esc_url( pepsi_features_install_url() ),
                    'description'       => esc_html__( 'It seems that you have not yet installed the Pepsi Features plugin. It is highly recommended to install the plugin. It includes 3 header styles, 3 blog styles, over 140 customization options, one-click install theme-presets and 7 advanced widgets, completely free!', 'pepsi' ),
                    'confirm_text'      => esc_html__( 'Are you sure? The theme features & widgets will provide you with tons of customization options', 'pepsi' ),
                    'confirm_button'    => esc_html__( 'Confirm', 'pepsi' ),
                )
            )
        );
    }

    /**
     * Loads theme customizer CSS.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue_control_scripts() {

        wp_enqueue_script( 'pepsi-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/lib/trt-customize/companion-plugin/customize-controls.js', array ( 'customize-controls' ) );
        wp_enqueue_style( 'pepsi-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/lib/trt-customize/companion-plugin/customize-controls.css' );
        
        wp_localize_script( 'pepsi-pro-customize-controls', 'pepsi_customize', array(
            'ajax_url'                  => admin_url( 'admin-ajax.php' ),
            'pepsi_dismiss_nonce'      => wp_create_nonce( 'pepsi_dismiss_nonce' )
        ) );
        
    }

}

// remove this when pushing live
//set_theme_mod( PEPSI_OPTIONS::COMPANION_NOTICE_DISMISSED, false );
// If user has dismissed the notice, do not display it
if( ! get_theme_mod( PEPSI_OPTIONS::COMPANION_NOTICE_DISMISSED, PEPSI_DEFAULTS::COMPANION_NOTICE_DISMISSED ) 
        && !function_exists( 'pepsi\init' )) {
    Pepsi_Customize::get_instance();
}

