<?php
/**
 * The Sidebar containing the post widget areas.
 *
 * @package WordPress
 * @subpackage WooShop
 * @since WooShop 1.0
 */
 
global $post;
$custom = get_post_custom($post->ID);
$prefix = "dessky_";
$defaultsidebar = "page-account";
$pagesidebar = (isset($custom[$prefix."sidebar"][0]))? $custom[$prefix."sidebar"][0] : $defaultsidebar;
?>

<div class="widget-area">
	<?php if ( ! dynamic_sidebar( $pagesidebar ) ) : ?><?php endif; // end general widget area ?>
</div>
<div>
    <ul>
        <li>
            <a href="http://www.localpartyshop.com/my-account/edit-account/"> Edit Account</a>
        </li>
    </ul>
</div>