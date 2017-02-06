<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title><?php dessky_document_title(); ?></title>
    <?php $bodyclass = ""; ?>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="alternate" id="templateurl" href="<?php echo get_template_directory_uri(); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->

    <?php
    $favicon = of_get_option('dessky_favicon');
    if ($favicon == "") {
        ?>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico"/>
    <?php } else { ?>
        <link rel="shortcut icon" href="<?php echo $favicon; ?>"/>
    <?php } ?>

    <?php

    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if (is_singular() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
    ?>

</head>

<body <?php body_class($bodyclass); ?>>


<div id="bodychild">
    <div id="outercontainer">

        <!-- HEADER -->
        <div id="outerheader" style="background-image: url('http://www.localpartyshop.com/wp-content/uploads/2015/07/Fig2PH2.png'); background-repeat: repeat; background-position: center top;background-attachment: scroll; border-top-right-radius: 30px; border-top-left-radius: 30px;">
            <div class="container">
                <header id="top" class="twelve columns">
                    <div id="logo" class="three columns alpha" ><?php dessky_logo(); // print the logo html?></div>
                     <div id="headerright" class="six columns omega">
                        <?php if (class_exists('woocommerce')) { ?>
                            <?php global $woocommerce; ?>
                            <div id="chart">
                                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" id="shopping-cart"></a>
                                <h6><?php _e('Shopping Cart', 'dessky'); ?></h6>

                                <p><?php _e('You have', 'dessky'); ?> <?php
                                    //* display items number */
                                    $transl_item = __('item', 'dessky');
                                    $transl_items = __('items', 'dessky');
                                    echo sprintf(_n('%d ' . $transl_item . '', '%d ' . $transl_items . '', $woocommerce->cart->cart_contents_count, 'dessky'), $woocommerce->cart->cart_contents_count);?></p>
                            </div>
                        <?php } ?>
                        <div class="clear"></div>
                        <?php wp_nav_menu(array(
                            'container' => 'ul',
                            'menu_id' => 'user-nav',
                            'depth' => 0,
                            'sort_column' => 'menu_order',
                            'fallback_cb' => 'false',
                            'theme_location' => 'topmenu'
                        ));
                        ?>
                    </div>
                    <section id="navigation" class="twelve columns">
                        <nav id="nav-wrap">

                            <?php get_my_menu(); ?>


                            <!--						--><?php //wp_nav_menu( array(
                            //                          'container'       => 'ul',
                            //                          'menu_class'      => 'sf-menu',
                            //                          'menu_id'         => 'topnav',
                            //                          'depth'           => 0,
                            //                          'sort_column'    => 'menu_order',
                            //                          'fallback_cb'     => 'false',
                            //                          'theme_location' => 'mainmenu'
                            //                          ));
                            //
                            ?>
                        </nav>
                        <!-- nav -->

                        <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="bgsearch">
                                <input type="text" name="s" id="s"
                                       onfocus="if (this.value == '<?php _e('Search', 'dessky'); ?>') {this.value = '';}"
                                       onblur="if (this.value == '') {this.value = '<?php _e('Search for product', 'dessky'); ?>';}"
                                       value="<?php _e('Search', 'dessky'); ?>"/>
<!--                                <input class="searchbutton" type="submit" value="">-->
                                <input type="hidden" name="post_type" value="product"/>
                            </div>
                        </form>
                        <div class="clear"></div>
                    </section>
                    <div class="clear"></div>
                </header>
            </div>
        </div>
        <!-- END HEADER -->
        

