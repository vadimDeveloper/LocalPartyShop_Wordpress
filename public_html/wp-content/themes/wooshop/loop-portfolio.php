<?php if ( ! have_posts() ) : ?>
<article id="post-0" class="post error404 not-found">
    <h1 class="posttitle"><?php _e( 'Not Found', 'dessky' ); ?></h1>
    <div class="entry">
        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'dessky' ); ?></p>
        <?php get_search_form(); ?>
    </div>
</article>
<?php endif; ?>


<?php 
	$disabletitle = of_get_option('dessky_pf_disable_title' ,'false');
	$disabledesc = of_get_option('dessky_pf_disable_desc' ,'false');
	$longdesc = of_get_option('dessky_pf_lengthchar' ,'');
							
	
	$idnum = 1;
	
	$output ='';
	$output .='<div class="dessky-display-portfolio">';
	$output .='<ul class="dessky-display-pf-col-4">';

	
	while ( have_posts() ) : the_post(); 
			$custom = get_post_custom($post->ID);
			$cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
			$cf_lightbox = (isset($custom["lightbox"][0]))? $custom["lightbox"][0] : "";
			$cf_externallink = (isset($custom["external-link"][0]))? $custom["external-link"][0] : "";
			
			
			//get portfolio
			$attachments = get_children( array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'order' => '',
			'post_mime_type' => 'image')
			);
			
			
			foreach ( $attachments as $att_id => $attachment ) {
			 
			$getimage = wp_get_attachment_image_src($att_id, 'post-col4', true);
			$portfolioimage = $getimage[0];
			$cf_thumb2 ='<img src="'.$portfolioimage.'" alt="" class="scale-with-grid" />';
			 }
			 //
			
			if($cf_thumb!=""){
				$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  class='scale-with-grid' />";
			}elseif(has_post_thumbnail($post->ID)){
				$cf_thumb = get_the_post_thumbnail($post->ID, 'post-col4', array('class' => 'scale-with-grid'));
			}else{
				$cf_thumb = $cf_thumb2;
			}
			
			
			if($cf_lightbox!=""){
				$golink = $cf_lightbox;
				$rollover = "rollover";
				$rel = " data-rel=prettyPhoto[]";
			}elseif($cf_externallink!=""){
				$golink = $cf_externallink;
				$rollover = "rollover gotolink";
				$rel = "";
			}else{
				$golink = get_permalink();
				$rollover = "rollover gotopost";
				$rel = "";
			}
			
			
			if(($idnum%4) == 0){$classpf = "nomargin";}else{$classpf = "";}
			if($disabletitle==true && $disabledesc==true){$classpf.= " no-pf-text";}else{$classpf.="";}
			
			$output .='<li class="'.$classpf.'">';
			$output .='<div class="dessky-display-pf-img">';
			$output .='<a class="image" href="'.$golink.'" '.$rel.' title="'.get_the_title().'">';
			$output .='<span class="'.$rollover.'"></span>';
			$output .=$cf_thumb;
			$output .='</a>';
			$output .='</div>';
			
			$output.='<span class="shadowpfimg"></span>';
			
			$output .='<div class="dessky-display-pf-text">';
					if($disabletitle!=true){
						$output .='<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
					}
					if($disabledesc!=true){
						$excerpt = get_the_excerpt();
						if($longdesc==""){
							$longdesc = 25;
						}
						$output .='<span>'.dessky_string_limit_char($excerpt, $longdesc).'</span>';
					}
			$output .='</div>';
			
			$output .='<div class="dessky-display-clear"></div>';
			$output .='</li>';
				
			$idnum++; $classpf="";
				
	endwhile; // End the loop. Whew.
	
		
	$output .='</ul>';
	$output .='<div class="clearfix"></div>';
	$output .='</div><!-- end #dessky-display-portfolio -->';
	
	echo $output;

?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
 <?php if(function_exists('wp_pagenavi')) { ?>
	 <?php wp_pagenavi(); ?>
 <?php }else{ ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'dessky' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dessky' ) ); ?></div>
	</div><!-- #nav-below -->
<?php }?>
<?php endif;?>

<?php wp_reset_query();?>