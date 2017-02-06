<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */


include_once (get_template_directory() . '/framework/widgets/dessky-recent-comment.php');
include_once (get_template_directory() . '/framework/widgets/dessky-recent-posts.php');
// Twitter widget is removed because Twitter has discontinued its unauthenticated v1.0 API
//include_once (get_template_directory() . '/framework/widgets/dessky-recent-tweet.php');

add_action("widgets_init", "load_dessky_widgets");

function load_dessky_widgets() {
	register_widget("DESSKY_RecentCommentWidget");
	register_widget("DESSKY_RecentPostWidget");
// Twitter widget is removed because Twitter has discontinued its unauthenticated v1.0 API	
//	register_widget("DESSKY_RecentTweetWidget");
}
?>