<?php
/**
 * Template Name: Testimonials
 *
 * A custom page template for testimonial page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

get_header(); ?>


		<?php $sidebarposition = of_get_option('dessky_sidebar_position' ,'right'); ?>
        
        <!-- MAIN CONTENT -->
        <div id="outermain" class="inner">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                
                    <section id="content" class="nine columns <?php if($sidebarposition=="left"){echo "positionright omega";}else{echo "positionleft alpha";}?>">
                        <div class="main padcontent">
                        
							<?php the_content(); ?>
                            
                            <?php 
								query_posts('post_type=testimonial-view&showposts=&paged='.$paged); 
								
								$output="";
								while ( have_posts() ) : the_post(); 
								$custom = get_post_custom($post->ID);
								$cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
								
								if($cf_thumb!=""){
									$thumb = '<img src='. $cf_thumb .' alt="" class="frame"/>';
								}elseif(has_post_thumbnail($post->ID) ){
									$thumb = get_the_post_thumbnail($post->ID, 'post-testimonial', array('alt' => '', 'class' => 'frame'));
								}else{
									$thumb ="";
								}
								
								$output.="<div class='dessky-testimonial'>";
								$output.= $thumb;
								$output.="<p class='testi-desc'>".get_the_title()."</p>";
								$output.="<div class='testi-text'>".get_the_content()."</div>";
								$output.="<div class='clear'></div>";
								$output.="</div>";
								
								endwhile;
								
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
                            <?php endif;  wp_reset_query();?>
                            
                    	<div class="clear"></div><!-- clear float --> 
                        </div><!-- main -->
                    </section><!-- content -->
                    
                    <aside id="sidebar" class="three columns <?php if($sidebarposition=="left"){echo "positionleft alpha";}else{echo "positionright omega";}?>">
                        <?php get_sidebar('page');?>  
                    </aside><!-- sidebar -->
                    
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer(); ?>