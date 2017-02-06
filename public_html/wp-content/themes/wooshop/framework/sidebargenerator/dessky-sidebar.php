<?php
if( ! function_exists("dessky_sidebar_admin")){
	function dessky_sidebar_admin(){
		$submenu_slug = 'dessky-themesidebar';
		$shortname = DESSKY_SHORTNAME;
		
		$optionstheme = array();
		
		$optionstheme['sidebar'] = array (
			
			array ( "name" => __("Sidebar Manager","dessky"), 
					"type" => "open"),
			
			array(	"name" => __('Sidebar', 'dessky'),
										"type" => "heading",
										"desc" => __('', 'dessky')),
			
			array( 	"name" => __('Sidebar Generator', 'dessky'),
										"desc" => __('Please enter name of new sidebar', 'dessky'),
										"id" => $shortname."_sidebar",
										"std" => "fade",
										"type" => "textarray"),
			
			array(	"type" 	=> "close"),
		);
	
		dessky_form_admin($optionstheme['sidebar'], $submenu_slug);
	}
}

if ( ! function_exists( 'dessky_sidebargen_menu' ) ) {
	function dessky_sidebargen_menu(){
		
		$submenu_slug = "dessky-themesidebar";
		$submenu_function = "dessky_sidebar_admin";
		add_theme_page( __('Sidebar Manager','dessky'), __('Sidebar Manager','dessky'), 'edit_themes', $submenu_slug, $submenu_function);
		
	}
	add_action('admin_menu', 'dessky_sidebargen_menu');
}