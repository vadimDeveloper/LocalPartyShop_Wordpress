<?php
function dessky_post_type_testimonial() {
	register_post_type( 'testimonial-view',
                array( 
				'label' => __('Testimonials', 'dessky'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'exclude_from_search' =>true,
				'supports' => array(
				                     'title',
									 'editor',
									 'thumbnail',
									 'custom-fields',
                                     'revisions')
					) 
				);
				
}
add_action('init', 'dessky_post_type_testimonial');
?>