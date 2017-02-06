<?php
$sliderarrange = of_get_option('dessky_slider_arrange');
$sliderDisableText = of_get_option('dessky_slider_disable_text');
?>

<!-- SLIDER -->

<div class="clearfix">
  <div id="outer-slider">
    <section id="slider">
      <div id="slideritems" class="flexslider">
        <ul class="slides">
          <?php
                        query_posts('post_type=testimonial-view&showposts=&paged='.$paged); 
						
                        while ( have_posts() ) : the_post();
                        
                        $custom = get_post_custom($post->ID);
                        
                        $output="";
                        $output .='<li>';
                        
                                                 
                            
                           //slider text
                           if($sliderDisableText!=true){
                               $output .='<div class="flex-caption">';
                               
								   $output .='<h2>'.get_the_title().'</h2>';
								   $output .='<p>'.get_the_content().'</p>';
															   
                               $output .='</div>';
                           }
                            
                        $output .='</li>';
                        
                        echo $output;
                        
                        endwhile;
                        wp_reset_query();
                        ?>
        </ul>
      </div>
    </section>
  </div>
</div>
<!-- END SLIDER --> 

