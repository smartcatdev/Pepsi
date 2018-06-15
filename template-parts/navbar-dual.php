<header id="masthead" class="site-header header-style-dual">

    <div id="banner-header-wrap">

        <div id="dual-header-toolbar">
        
            <?php if ( get_theme_mod( PEPSI_OPTIONS::NAVBAR_BOXED_CONTENT, PEPSI_DEFAULTS::NAVBAR_BOXED_CONTENT ) ) : ?>
            
                <div class="container">

            <?php endif; ?>
                    
                <?php if ( get_theme_mod( PEPSI_OPTIONS::NAVBAR_SHOW_SOCIAL, PEPSI_DEFAULTS::NAVBAR_SHOW_SOCIAL ) ) : ?>

                    <div class="navbar-social">

                        <?php if ( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_1, PEPSI_DEFAULTS::SOCIAL_ICON_1 ) != '' ) : ?>
                            <a class="navbar-icon" href="<?php echo esc_url( get_theme_mod( PEPSI_OPTIONS::SOCIAL_URL_1, PEPSI_DEFAULTS::SOCIAL_URL_1 ) ); ?>">
                                <span class="fab <?php echo esc_attr( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_1, PEPSI_DEFAULTS::SOCIAL_ICON_1 ) ); ?>"></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_2, PEPSI_DEFAULTS::SOCIAL_ICON_2 ) != '' ) : ?>
                            <a class="navbar-icon" href="<?php echo esc_url( get_theme_mod( PEPSI_OPTIONS::SOCIAL_URL_2, PEPSI_DEFAULTS::SOCIAL_URL_2 ) ); ?>">
                                <span class="fab <?php echo esc_attr( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_2, PEPSI_DEFAULTS::SOCIAL_ICON_2 ) ); ?>"></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_3, PEPSI_DEFAULTS::SOCIAL_ICON_3 ) != '' ) : ?>
                            <a class="navbar-icon" href="<?php echo esc_url( get_theme_mod( PEPSI_OPTIONS::SOCIAL_URL_3, PEPSI_DEFAULTS::SOCIAL_URL_3 ) ); ?>">
                                <span class="fab <?php echo esc_attr( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_3, PEPSI_DEFAULTS::SOCIAL_ICON_3 ) ); ?>"></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_4, PEPSI_DEFAULTS::SOCIAL_ICON_4 ) != '' ) : ?>
                            <a class="navbar-icon" href="<?php echo esc_url( get_theme_mod( PEPSI_OPTIONS::SOCIAL_URL_4, PEPSI_DEFAULTS::SOCIAL_URL_4 ) ); ?>">
                                <span class="fab <?php echo esc_attr( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_4, PEPSI_DEFAULTS::SOCIAL_ICON_4 ) ); ?>"></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_5, PEPSI_DEFAULTS::SOCIAL_ICON_5 ) != '' ) : ?>
                            <a class="navbar-icon" href="<?php echo esc_url( get_theme_mod( PEPSI_OPTIONS::SOCIAL_URL_5, PEPSI_DEFAULTS::SOCIAL_URL_5 ) ); ?>">
                                <span class="fab <?php echo esc_attr( get_theme_mod( PEPSI_OPTIONS::SOCIAL_ICON_5, PEPSI_DEFAULTS::SOCIAL_ICON_5 ) ); ?>"></span>
                            </a>
                        <?php endif; ?>

                    </div>

                <?php endif; ?>
                    
                <?php if ( has_nav_menu( 'toolbar-menu' ) ) : ?>

                    <?php wp_nav_menu( array( 
                        'theme_location'    => 'toolbar-menu', 
                        'menu_id'           => 'toolbar-menu',
                        'menu_class'        => 'toolbar-menu' 
                    ) ); ?>

                <?php else : ?>

                    <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>

                        <ul id="toolbar-menu" class="toolbar-menu">

                            <li class="menu-item menu-item-type-custom menu-item-object-custom">

                                <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
                                   <?php esc_html_e( 'Add a Toolbar Menu?', 'pepsi' ); ?>
                                </a>

                            </li>

                        </ul>

                    <?php endif; ?>

                <?php endif; ?>
                    
            <?php if ( get_theme_mod( PEPSI_OPTIONS::NAVBAR_BOXED_CONTENT, PEPSI_DEFAULTS::NAVBAR_BOXED_CONTENT ) ) : ?>
            
                </div>

            <?php endif; ?>

        </div>
        
        <div id="banner-header" class="<?php echo get_theme_mod( PEPSI_OPTIONS::NAVBAR_BOXED_CONTENT, PEPSI_DEFAULTS::NAVBAR_BOXED_CONTENT ) ? 'container' : ''; ?>">

            <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() && get_theme_mod( PEPSI_OPTIONS::NAVBAR_BRANDING_WHAT_TO_SHOW, PEPSI_DEFAULTS::NAVBAR_BRANDING_WHAT_TO_SHOW ) == 'logo' ) : ?>

                <div id="custom-logo-wrap" class="has-logo">
            
                    <?php the_custom_logo(); ?>

                </div>
                    
            <?php else : ?> 
            
                <div id="custom-logo-wrap">
            
                    <div class="site-branding">
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url() ); ?>">
                                <?php echo esc_html( get_bloginfo('name') ); ?>
                            </a>
                        </h1>
                        <?php if ( get_bloginfo( 'name' ) ) : ?>
                            <p class="site-tagline">
                                <a href="<?php echo esc_url( home_url() ); ?>">
                                    <?php echo esc_html( get_bloginfo( 'description' ) ); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>

                </div>
            
            <?php endif; ?> 
            
            <div id="banner-header-menu-wrap">

                <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>

                    <?php wp_nav_menu( array( 
                        'theme_location'    => 'primary-menu', 
                        'menu_id'           => 'banner-header-primary',
                        'menu_class'        => 'slim-header-menu' 
                    ) ); ?>

                <?php else : ?>

                    <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>

                        <ul id="banner-header-primary" class="slim-header-menu">

                            <li class="menu-item menu-item-type-custom menu-item-object-custom">

                                <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
                                   <?php esc_html_e( 'Add a Primary Menu?', 'pepsi' ); ?>
                                </a>

                            </li>

                        </ul>
                
                    <?php endif; ?>

                <?php endif; ?>
            
                <div class="clear"></div>
                
            </div>
            
            <?php do_action( 'pepsi_mobile_menu' ); ?>
            
        </div>

    </div>

</header>