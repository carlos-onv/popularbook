(function ($) {
    "use strict"; 
	jQuery(document).ready(function ($) {
		jQuery('.menu-item-submenu_type').change(function(){
			var el = jQuery(this);
			var el_value 	= el.val();
			var el_id 		= el.attr('id');
			var menu_id 	= 'menu-item-'+el_id.substring(36);
			if( el_value == 'widget_area' ) {
				jQuery("#"+menu_id+" .el_multicolumn").hide();
				jQuery("#"+menu_id+" .el_widget_area").show();
			}else if( el_value == 'multicolumn' ){
				jQuery("#"+menu_id+" .el_widget_area").hide();
				jQuery("#"+menu_id+" .el_multicolumn").show();
			}else if( el_value == 'standard' ){
				jQuery("#"+menu_id+" .el_widget_area").hide();
				jQuery("#"+menu_id+" .el_multicolumn").hide();
			}
		})
	});  
}(jQuery));
