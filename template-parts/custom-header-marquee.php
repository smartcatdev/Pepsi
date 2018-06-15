<?php $header_image = get_header_image(); ?>

<div id="pepsi-custom-header" class="marquee-header pepsi_parallax" data-plx-img="<?php echo esc_url( $header_image ); ?>">

    <div id="custom-header-overlay" class="<?php echo get_theme_mod( PEPSI_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE, PEPSI_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE ) == 'no' ? 'no' : esc_attr( get_theme_mod( PEPSI_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE, PEPSI_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE ) ); ?>">
    </div>

    <div id="custom-header-content" class="marquee-header" data-stellar-offset-parent="true">

        <div class="marquee">
        
            <div class="marquee-inner">
        
                <?php if ( get_theme_mod( PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_LOGO, PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_LOGO ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>

                    <?php the_custom_logo(); ?>

                <?php endif; ?>

                <?php if ( get_theme_mod( PEPSI_OPTIONS::CUSTOM_HEADER_SHOW_TITLE, PEPSI_DEFAULTS::CUSTOM_HEADER_SHOW_TITLE ) ) : ?>

                    <h2 class="custom-header-title textillate wow">

                        <?php 
                        switch ( get_theme_mod( PEPSI_OPTIONS::CUSTOM_HEADER_TITLE_CONTENT, PEPSI_DEFAULTS::CUSTOM_HEADER_TITLE_CONTENT ) ) :

                            case 'site_title' :
                                echo esc_html( get_bloginfo('name') );
                                break;

                            case 'site_description' :
                                echo esc_html( get_bloginfo('description') );
                                break;

                            default :
                                echo esc_html( get_bloginfo('name') );

                        endswitch; ?>

                    </h2>

                <?php endif; ?>

            </div>
        
        </div>
        
    </div>

</div>