<?php
/**
 * The template for displaying 404 pages (Not Found).
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
                    
                    <p>
                    <?php _e( 'Apologies, but the page you requested could not be found. Go to Home page or use search.', 'dessky' ); ?>
                    </p>
                    <form action="http://www.localpartyshop.com/">
                        <button class="button" type="submit" style="margin-bottom: 1em;"> RETURN TO HOME PAGE</button></form>
                    <?php get_template_part('searchform'); ?>
                    
                    <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    
<?php get_footer(); ?>