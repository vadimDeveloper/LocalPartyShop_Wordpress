<?php
// *********** Dessky Recent Comments  Widget ***********
class DESSKY_RecentCommentWidget extends WP_Widget_Recent_Comments {

	function DESSKY_RecentCommentWidget() {
		$widget_ops = array('classname' => 'widget_dessky_recent_comments', 'description' => __('Dessky -  Recent Comments','dessky') );
		$this->WP_Widget('dessky-recent-comments', __('Dessky -  Recent Comments','dessky'), $widget_ops);
	}
	
	function widget( $args, $instance ) {
		global $wpdb, $comments, $comment;

		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Dessky Recent Comments','dessky') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		$comment_len = 60;

		if ( !$comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
			$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT 15");
			wp_cache_add( 'recent_comments', $comments, 'widget' );
		}

		$comments = array_slice( (array) $comments, 0, $number );
?>
		<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<ul class="dessky-recent-comment-widget"><?php
			if ( $comments ) : foreach ( (array) $comments as $comment) :?>
			<li class="recentcomments">
			<?php
			echo '<div class="alignleft">'.get_avatar( $comment, 40, 40 ).'</div>';
			printf( __( '%s ', 'dessky' ), sprintf( '%s', get_comment_author_link() ) ); 
			echo '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">';
			echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); if (strlen($comment->comment_content) > $comment_len) echo '...'; ;
			echo '</a>';
			?>
			<span class="clear"></span>
            
            </li>
            
            <?php
			endforeach; endif;?></ul>
		<?php echo $after_widget; ?>
<?php
	}
}
?>