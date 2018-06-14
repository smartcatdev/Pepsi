<div class="wrap" id="pepsi-docs">
    
    <h2>
        <?php esc_html_e( 'Pepsi Theme Guide & Documentation', 'pepsi' ); ?>
    </h2>
    
    <div id="pepsi-flex-wrap">
    
        <div id="pepsi-docs-menu">
            
            <ul class="parent-nav">

                <?php pepsi_docs_tab( '#welcome', __( 'Welcome to Pepsi', 'pepsi' ) ); ?>

                <?php pepsi_docs_tab( '#setup', __( 'Quick-Start Guide', 'pepsi' ), array(
                    '#choose-navbar'            => __( 'Navbar', 'pepsi' ),
                    '#add-menu'                 => __( 'Menus', 'pepsi' ),
                    '#setup-blog'               => __( 'Blog', 'pepsi' ),
                    '#customize-header'         => __( 'Header', 'pepsi' ),
                    '#page-templates'           => __( 'Page Templates', 'pepsi' ),
                    '#theme-presets'            => __( 'Theme Presets', 'pepsi' ),
                ) ); ?>

                <?php if ( !function_exists( '\pepsi_pro\init' ) ) : ?>
                    <li>
                        <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-upgrade' ) ); ?>">
                            <?php _e( 'Pepsi Pro', 'pepsi' ) ?>
                        </a>
                    </li>
                <?php endif; ?>
                

                
            </ul>

        </div>

        <div id="pepsi-docs-content">
            
            <?php if( !function_exists( 'pepsi\init' ) ) : ?>
            <div id="pepsi-features-notice">

                <h3>
                    <span class="fas fa-lightbulb icon-rotate"></span>
                    <?php esc_html_e( 'Pepsi Features', 'pepsi' ); ?>
                </h3>
                <p>
                    <?php esc_html_e( 'It seems that you have not yet installed the Pepsi Features plugin. It is highly recommended to install the plugin. It includes 3 header styles, 3 blog styles, over 140 customization options, one-click install theme-presets and 6 advanced widgets, completely free!', 'pepsi' ); ?>
                </p>

            </div>
            <?php endif; ?>

            <div id="welcome">
                <?php pepsi_render_doc( 'welcome' ); ?>
            </div>

            <div id="setup">
                <?php pepsi_render_doc( 'setup' ); ?>
            </div>

        </div>
        
    </div>
    
</div>