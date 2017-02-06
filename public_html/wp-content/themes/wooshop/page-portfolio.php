<?php
/**
 * Template Name: Portfolio
 *
 * A custom page template for portfolio page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */

get_header(); ?>
       
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                			
                            <div id="dessky-display-portfolio">
							<?php
								$cats = of_get_option('dessky_pf_category' ,'');
								$disabletitle = of_get_option('dessky_pf_disable_title' ,'false');
								$disabledesc = of_get_option('dessky_pf_disable_desc' ,'false');
								$longdesc = of_get_option('dessky_pf_lengthchar' ,'');
								$categories = $cats;
                            ?>
                              <ul class="dessky-display-pf-col-4">
                                    <?php
										$idnum = 1;
										if($categories!="0"){
											$catname = get_term($categories,"pcategory");
											$catinclude = '&pcategory='. $catname->slug ;
										}else{
											$catinclude = '';
										}
										if(!is_front_page()){
											$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
										}else{
											$paged = (get_query_var('page')) ? get_query_var('page') : 1;
										}
                                        query_posts('post_type=pdetail'. $catinclude .' &showposts=8&orderby=date&paged='.$paged); 
                                        
                                        
                                        while ( have_posts() ) : the_post(); 
                                            
                                        $custom = get_post_custom($post->ID);
                                        $cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
                                        $cf_lightbox = (isset($custom["lightbox"][0]))? $custom["lightbox"][0] : "";
                                        $cf_externallink = (isset($custom["external-link"][0]))? $custom["external-link"][0] : "";
                                        
                                        
                                        //get post-thumbnail attachment
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
                                         
                                        
                                        //thumb image
										if($cf_thumb!=""){
                                            $cf_thumb = "<img src='" . $cf_thumb . "' alt='' class='scale-with-grid' />";
                                        }elseif(has_post_thumbnail($post->ID)){
                                            $cf_thumb = get_the_post_thumbnail($post->ID, 'post-col4', array('class' => 'scale-with-grid'));
                                        }else{
                                            $cf_thumb = $cf_thumb2;
                                        }
                                        
                                        //fade action
                                        if($cf_lightbox!=""){
                                            $golink = $cf_lightbox;
                                            $rollover = "rollover";
                                            $rel = " data-rel=prettyPhoto[".$catname->slug."]";
                                        }elseif($cf_externallink!=""){
                                            $golink = $cf_externallink;
                                            $rollover = "rollover gotolink";
                                            $rel = "";
                                        }else{
                                            $golink = get_permalink();
                                            $rollover = "rollover gotopost";
                                            $rel = "";
                                        }
                                        
                                        
                                        $ids = get_the_ID();
                                       
                                        $classpf = "";

                                        if(($idnum%4) == 0){$classpf .= "nomargin ";}
										
										if($disabletitle==true && $disabledesc==true){$classpf.= " no-pf-text";}else{$classpf.="";}

                                            ?>
                                                <li class="<?php echo $key.' '.$classpf;?>">
                                                        <?php 
                                                        $output="";
														if($cf_thumb!=""){
                                                        $output.='<div class="dessky-display-pf-img">';
                                                            $output .='<a class="image" href="'.$golink.'" '.$rel.' title="'.get_the_title().'">';
                                                            $output .='<span class="'.$rollover.'"></span>';
                                                            $output .=$cf_thumb;
                                                            $output .='</a>';
                                                        $output.='</div>';
														$output.='<span class="shadowpfimg"></span>';
														}
                                                        $output.='<div class="dessky-display-pf-text">';
                                                            if($disabletitle!=true){
                                                                $output .='<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
                                                            }
                                                            if($disabledesc!=true){
																$excerpt = get_the_excerpt();
																if($longdesc==""){
																	$longdesc = 25;
																}
																$output .='<span>'.dessky_string_limit_char($excerpt, $longdesc).'</span>';
                                                            }
                                                        $output.='</div>';
                                                        echo $output;
                                                         ?>
                                                </li>
                                                <?php 
                                                $idnum++; $classpf=""; 
                                        endwhile; // End the loop. Whew.
                                 ?>
                              </ul>
                              
                           </div>
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
                            <?php wp_reset_query(); ?>
                      <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer(); ?>