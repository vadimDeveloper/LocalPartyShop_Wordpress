<?php
function dessky_post_type_portfolio() {
	register_post_type( 'pdetail',
                array( 
				'label' => __('Portfolio', 'dessky'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => array( 'slug' => 'pdetail', 'with_front' => false ),
				'hierarchical' => true,
				'menu_position' => 5,
				'has_archive' => true,
				'supports' => array(
						 'title',
						 'editor',
						 'custom-fields',
						 'thumbnail',
						 'revisions',
						 'excerpt')
					) 
				);
				
	register_taxonomy( 'pcategory', array( 'pdetail' ), array(
		'hierarchical' => true,
		'label' =>  __('Portfolio Categories', 'dessky'),
		'query_var' => true,
		'rewrite' => array( 'slug' => 'pcategory', 'with_front' => false ),
		'show_ui' => true,
	));
}

add_action('init', 'dessky_post_type_portfolio');
?>
