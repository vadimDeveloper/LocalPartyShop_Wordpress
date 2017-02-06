<?php
/**
 * The Template for displaying single portfolio posts.
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

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dessky' ), 'after' => '</div>' ) ); ?>
                            <?php edit_post_link( __( 'Edit', 'dessky' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-content -->
                        
                    </div><!-- #post -->
                    
                    <?php endwhile; ?>
                        
                    <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
	
<?php get_footer(); ?>