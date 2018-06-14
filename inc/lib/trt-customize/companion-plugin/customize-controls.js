( function( api ) {

	// Extends our custom "companion-plugin" section.
	api.sectionConstructor['companion-plugin'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

    

} )( wp.customize );

(function ($) {
    
    // Clicker so that theme editor can dismiss notice to install plugin
    $(document).on( 'click', '.pepsi-dismiss-companion', function(e) {
       
        e.preventDefault()
        
        $.ajax({
            url         : pepsi_customize.ajax_url,
            type        : 'post',
            dataType    : 'json',
            data        : {
                'action'                : 'pepsi_dismiss_companion',
                'pepsi_dismiss_nonce'  : pepsi_customize.pepsi_dismiss_nonce
            }
        })
        
        .done( function( data) {
            wp.customize.section('pepsi_companion').deactivate()
        })
       
    })
    
    $(document).on( 'click', '.pepsi-initiate-dismiss', function(e) {
        $(this).hide()
        $('.pepsi-dismiss-confirm').slideDown(300) 
    })
    
})(jQuery);