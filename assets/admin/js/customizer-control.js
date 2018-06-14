(function ($) {

    wp.customize.bind('ready', function () {

        var customize = this

        // Navbar Style ( Split || Left Align )
        customize( 'navbar_style', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'banner' === value ) {
                    
                    // Banner Style
                    
                    // Show
                    $('li#customize-control-navbar_banner_logo_alignment').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('pepsi-hidden');
                    
                    // Hide
                    $('li#customize-control-style_a_right_align_menu').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('pepsi-hidden');
                    
                } else if ( 'vertical' === value ) {
                    
                    // Show
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('pepsi-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_background_style').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_background').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_bg_image').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_drawer_background').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_accent').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_rounded').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_fill').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('pepsi-hidden');
                    
                } else if ( 'slim_left' === value ) {
                    
                    // Slim Left Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_right_align_menu').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('pepsi-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('pepsi-hidden');
                    
                } else {
                    
                    // Slim Split Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('pepsi-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('pepsi-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('pepsi-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('pepsi-hidden');
                    
                }
                
            }
            
        });
        
        // Custom Logo
        customize( 'pepsi_custom_header_height_percent', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
//                console.log(value + " fired");
                
                if ( parseInt(value) == 100 ) {
//                    console.log("true match");
                    $('li#customize-control-pepsi_custom_header_height_percent_mbl').addClass('pepsi-hidden');
                } else {
//                    console.log("false");
                    $('li#customize-control-pepsi_custom_header_height_percent_mbl').removeClass('pepsi-hidden');
                }
                
            }
            
        });

        // Navbar - Social Icon Toggle
        customize( 'navbar_show_social', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-navbar_social_drawer_background').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_link_foreground').removeClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-navbar_social_drawer_background').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_link_foreground').addClass('pepsi-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').addClass('pepsi-hidden');
                }
                
            }
            
        });

        // Blog Layout
        customize( 'blog_layout_style', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
//                console.log('BLOG LAYOUT ' + value);
                
                if ( value && value == 'blog_standard' ) {
                    $('li#customize-control-standard_blog_appearance_style').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-standard_blog_appearance_style').addClass('pepsi-hidden');
                }
                
                if ( value && value == 'blog_mosaic' ) {
                    $('li#customize-control-mosaic_blog_gap_spacing').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-mosaic_blog_gap_spacing').addClass('pepsi-hidden');
                }
                
            }
            
        });

        // Custom Header - Main Heading Toggle
        customize( 'custom_header_show_logo', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-pepsi_custom_header_logo_height').removeClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_logo_height_mbl').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-pepsi_custom_header_logo_height').addClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_logo_height_mbl').addClass('pepsi-hidden');
                }
                
            }
            
        });

        // Custom Header - Main Heading Toggle
        customize( 'custom_header_show_heading', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-custom_header_title_content').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_font_family').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_font_size').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_color').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_uppercase').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-custom_header_title_content').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_font_family').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_font_size').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_color').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_title_uppercase').addClass('pepsi-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Menu Toggle
        customize( 'custom_header_show_menu', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-custom_header_menu_font_family').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_font_size').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_color').removeClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-custom_header_menu_font_family').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_font_size').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_color').addClass('pepsi-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').addClass('pepsi-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Gradient Overlay
        customize( 'parallax_layers_include_color_layer', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'no' === value ) {
                    $('li#customize-control-parallax_layers_single_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('pepsi-hidden');
                } else if ( 'single' === value ) {
                    $('li#customize-control-parallax_layers_single_color').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('pepsi-hidden');
                } else {
                    $('li#customize-control-parallax_layers_single_color').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').removeClass('pepsi-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Height Units Toggle
        customize( 'pepsi_custom_header_height_unit', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'percent' === value ) {
                    $('li#customize-control-pepsi_custom_header_height_pixels').addClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_pixels_mbl').addClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_percent').removeClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_percent_mbl').removeClass('pepsi-hidden');
                } else {
                    $('li#customize-control-pepsi_custom_header_height_percent').addClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_percent_mbl').addClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_pixels').removeClass('pepsi-hidden');
                    $('li#customize-control-pepsi_custom_header_height_pixels_mbl').removeClass('pepsi-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Height Units Toggle
        customize( 'custom_header_style_toggle', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'parallax_vertical' === value ) {
                    $('li#customize-control-parallax_layers_texture_pattern').addClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').addClass('pepsi-hidden');
                } else {
                    $('li#customize-control-parallax_layers_texture_pattern').removeClass('pepsi-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').removeClass('pepsi-hidden');
                }
                
            }
            
        });
        
    });
    
})(jQuery);