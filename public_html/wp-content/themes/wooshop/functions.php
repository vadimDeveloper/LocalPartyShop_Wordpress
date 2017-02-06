<?php

/********** DESSKY DEFINITION *************/
global $themeoptionsvalue, $themedata, $themename ; 

$themename 			=  'WooShop';
$admin_path 		= get_template_directory() . '/framework/adminoptions/';
$includes_path 		= get_template_directory() . '/framework/';
define('DESSKY_THEMENAME', $themename);
define('DESSKY_SHORTNAME', "dessky");
define('DESSKY_PARENTMENU_SLUG', 'desskytheme-settings');
define('DESSKY_FRAMEWORKPATH', get_template_directory() . '/framework/');

/********** END DESSKY DEFINITION *************/

//Theme Options
require_once get_template_directory() . '/options.php';

// Sidebar Generator
require_once $includes_path . 'sidebargenerator/dessky-form.php';
require_once $includes_path . 'sidebargenerator/dessky-sidebar.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Portfolio init
require_once $includes_path . 'portfolio-init.php';

//Testimonial init
require_once $includes_path . 'testimonial-init.php';

//Metaboxes
require_once $includes_path . 'metaboxes.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Header function
require_once $includes_path . 'header-function.php';

//Footer function
require_once $includes_path . 'footer-function.php';

//Additional function
require_once $includes_path . 'theme-shortcode.php';

//Loading jQuery
require_once $includes_path . 'theme-scripts.php';

//Loading Style Css
require_once $includes_path . 'theme-styles.php';

require_once $includes_path . 'getqtycart.php';

// New Version Theme Update Notifier
require_once $includes_path . 'theme-update.php';
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // no php needed above it
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); // php is not closed in the last line


?>