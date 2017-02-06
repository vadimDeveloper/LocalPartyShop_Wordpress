<?php

/*********For Localization**************/
load_theme_textdomain( 'dessky', get_template_directory().'/framework/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/framework/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
/*********End For Localization**************/


// The excerpt based on character
if(!function_exists("dessky_string_limit_char")){
	function dessky_string_limit_char($excerpt, $substr=0, $strmore = "..."){
		$string = strip_tags(str_replace('...', '...', $excerpt));
		if ($substr>0) {
			$string = substr($string, 0, $substr);
		}
		if(strlen($excerpt)>=$substr){
			$string .= $strmore;
		}
		return $string;
	}
}
// The excerpt based on words
if(!function_exists("dessky_string_limit_words")){
	function dessky_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  
	  return implode(' ', $words);
	}
}

if ( ! isset( $content_width ) )
	$content_width = 610;

add_action( 'after_setup_theme', 'dessky_setup' );


/* Remove inline styles printed when the gallery shortcode is used.*/
function dessky_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'dessky_remove_gallery_css' );

/*Template for comments and pingbacks. */
if ( ! function_exists( 'dessky_comment' ) ) :
function dessky_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php //echo get_avatar( $comment, 60, 60 ); ?>
			<img class="avatar avatar-60 photo" width="60" height="60" src="http://0.gravatar.com/avatar/21ecbc5fb334068eae24691ddd6261d9?s=60&d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&r=G&forcedefault=1" alt="">
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', 'dessky' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <span class="time">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', 'dessky' ), get_comment_date(),  get_comment_time() ); ?></a>
                <?php edit_comment_link( __( '(Edit)', 'dessky' ), ' ' );?>
            </span>/
            <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ,'reply_text' => 'Reply') ) ); ?></span>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'dessky' ); ?></em>
			<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'dessky' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'dessky'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/* social icon */
if (!function_exists('dessky_socialicon')){
	function dessky_socialicon(){
		
		$socialfolder = get_template_directory_uri() . '/assets/images/social/';

		$outputli = "";
		$twitterlink = of_get_option( DESSKY_SHORTNAME . '_twitter_link', "" );
		if($twitterlink!=""){
			$twittericon = $socialfolder . "icon-twitter.png" ;
			$outputli .= '<li><a href="'.$twitterlink.'"><span class="icon-img" style="background-image:url('.$twittericon.')"></span></a></li>'."\n";
		}
		
		$facebooklink = of_get_option( DESSKY_SHORTNAME . '_facebook_link', "" );
		if($facebooklink!=""){
			$facebookicon = $socialfolder . "icon-facebook.png" ;
			$outputli .= '<li><a href="'.$facebooklink.'"><span class="icon-img" style="background-image:url('.$facebookicon.')"></span></a></li>'."\n";
		}
		
		$gpluslink = of_get_option( DESSKY_SHORTNAME . '_googleplus_link', "" );
		if($gpluslink!=""){
			$gplusicon = $socialfolder . "icon-googleplus.png" ;
			$outputli .= '<li><a href="'.$gpluslink.'"><span class="icon-img" style="background-image:url('.$gplusicon.')"></span></a></li>'."\n";
		}
		
		$pinterestlink = of_get_option( DESSKY_SHORTNAME . '_pinterest_link', "" );
		if($pinterestlink!=""){
			$pinteresticon = $socialfolder . "icon-pinterest.png" ;
			$outputli .= '<li><a href="'.$pinterestlink.'"><span class="icon-img" style="background-image:url('.$pinteresticon.')"></span></a></li>'."\n";
		}
		
		$socialcustom = of_get_option( DESSKY_SHORTNAME . '_socialicon_custom', "" );
		if($socialcustom!=""){
			$outputli .= $socialcustom."\n";
		}
		
		$output = "";
		if($outputli!=""){
			$output .= '<ul class="sn">';
			$output .= $outputli;
			$output .= '</ul>';
		}
		return $output;
	}
}//end if(!function_exists('dessky_get_socialicon'))

/*Prints HTML with meta information for the current post (category, tags and permalink).*/
if ( ! function_exists( 'dessky_posted_in' ) ) :
function dessky_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Categories: %1$s <br/> Tags: %2$s', 'dessky' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Categories: %1$s', 'dessky' );
	} else {
		$posted_in = __( '', 'dessky' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*Clearing the automatic paragraphs and breaks on shortcodes that WordPress is adding automatically when filtering content.*/
function dessky_paragraph_formatter($content) { 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
	$content = str_replace('<br />', '', $content);
	$content = str_replace('<p><div', '<div', $content);
	return $content;
}

/* for top menu */
function nav_page_fallback() {
if(is_front_page()){$class="current_page_item";}else{$class="";}
print '<ul id="topnav" class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home','dessky').' ">'.__('Home','dessky').'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}

/* for user menu */
function nav_user_fallback() {
if(is_front_page()){$class="current_page_item";}else{$class="";}
print '<ul id="user-nav" class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home','dessky').' ">'.__('Home','dessky').'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}



/* Filter Custom Post Type Categories */
add_action( 'restrict_manage_posts', 'dessky_add_taxonomy_filters' );
function dessky_add_taxonomy_filters() {
	global $typenow;
	
	$taxonomy = 'pcategory';
	if( $typenow=='pdetail'){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>".__('View All','dessky')." "."$tax_name</option>";
			foreach ($terms as $term) { 
				$selectedstr = '';
				if(isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug){
					$selectedstr = ' selected="selected"';
				}
				echo '<option value='. $term->slug. $selectedstr . '>' . $term->name .' (' . $term->count .')</option>'; 
			}
			echo "</select>";
		}
	}
}

//get id portfolio filterable
function dessky_portfolio_getcategoryids($id){
	global $wpdb;
	$qryString = "
		SELECT	d.term_id FROM ".$wpdb->posts." a 
		INNER 	JOIN ".$wpdb->term_relationships." b ON a.ID = b.object_id 
		INNER 	JOIN ".$wpdb->term_taxonomy." c ON b.term_taxonomy_id = c.term_taxonomy_id
		INNER	JOIN ".$wpdb->terms."  d ON c.term_id = d.term_id
		WHERE 	a.post_type = 'pdetail'
	";
	if(strlen($id)>0){
		$qryString .= " AND	a.ID = '".$id."'";
	}
	$numposts = $wpdb->get_results($qryString, ARRAY_A);
	return $numposts;
}


/* for lighter  color button  */
function hex_lighter($hex,$factor = 30) 
    { 
    $new_hex = ''; 
     
    $base['R'] = hexdec($hex{0}.$hex{1}); 
    $base['G'] = hexdec($hex{2}.$hex{3}); 
    $base['B'] = hexdec($hex{4}.$hex{5}); 
     
    foreach ($base as $k => $v) 
        { 
        $amount = 255 - $v; 
        $amount = $amount / 100; 
        $amount = round($amount * $factor); 
        $new_decimal = $v + $amount; 
     
        $new_hex_component = dechex($new_decimal); 
        if(strlen($new_hex_component) < 2) 
            { $new_hex_component = "0".$new_hex_component; } 
        $new_hex .= $new_hex_component; 
        } 
         
    return $new_hex;     
} 


/* for shortcode widget  */
add_filter('widget_text', 'do_shortcode');


// CUSTOM POST TYPES ARCHIVE FILTER
// Attention! This could affect post/pages display in the admin

/*
add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {
   // if ( is_home() && false == $query->query_vars['suppress_filters'] )
    if ( false == $query->query_vars['suppress_filters'] )
        $query->set( 'post_type', array( 'post', 'page', 'bitachon' ) );

    return $query;
}*/


// CUSTOM POST TEMPLATE

function my_cpt_post_types( $post_types ) {
$post_types[] = 'testimonials';
return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );

/*
	Remove WooCommerce Warning
*/
add_theme_support('woocommerce');

/*
	Adding Logout Link
*/

add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'topmenu' && class_exists( 'woocommerce' )) {
        $items .= '<li><a href="'. wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) ) .'">' . __( 'Log Out', 'dessky'  ) . '</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'topmenu' && class_exists( 'woocommerce' )) {
        $items .= '<li><a href="' . get_permalink( woocommerce_get_page_id( 'myaccount' ) ) . '">' . __( 'Log In', 'dessky'  ) . '</a></li>';
    }
    return $items;
}

// Display 100 products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 100;' ), 20 );

function display_breadcrumbs() {
    ?><div class="breadcrumbs"><?php thesis_breadcrumbs(); ?></div><?php
}
function the_breadcrumb() {
    global $post;
    echo '<div class="breadcrumbs">';
    echo '<ul>';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li class="breadcrumbs_separator" style > / </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="breadcrumbs_separator"> / </li><li> ');
            if (is_single()) {
                echo '</li><li class="breadcrumbs_separator"> / </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                $anc = get_post_ancestors($post->ID);
                $title = get_the_title();
                foreach (array_reverse($anc) as $ancestor) {
                    $output = '<li>
                                    <a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">
                                        ' . get_the_title($ancestor) . '
                                    </a>
                            </li><li class="breadcrumbs_separator">/</li>';

                    echo $output;
                }
                echo '<strong title="' . $title . '"> ' . $title . '</strong>';
            } else {
                echo '<li><strong> ' . get_the_title() . '</strong></li>';
            }
        }
    }
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
    echo '</div>';
}
function get_my_menu(){

    echo ' <ul id="topnav" class="sf-menu sf-js-enabled sf-shadow l_tinynav1"><li id="menu-item-24" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-24"><a href="http://www.localpartyshop.com/">Home</a></li>
                            <li id="menu-item-63" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-63"><a class="sf-with-ul" href="http://www.localpartyshop.com/product-category/balloons/">Balloons<span class="sf-sub-indicator"> »</span></a>
                                <ul style="float: none; width: 12em; display: none; visibility: hidden;" class="sub-menu">
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-80" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-80"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/balloons/latex-balloons/">Latex Balloons</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-77" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-77"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/balloons/foil-balloons/">Foil Balloons</a></li>
                                </ul>
                            </li>
                            <li id="menu-item-68" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-68"><a class="sf-with-ul" href="http://www.localpartyshop.com/product-category/party-themes/">Party Themes<span class="sf-sub-indicator"> »</span></a>
                                <ul style="float: none; width: 12em; display: none; visibility: hidden;" class="sub-menu">
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1565" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1565"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/anniversary/">Anniversary</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-426" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-426"><a class="sf-with-ul" style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/">Birthday Party<span class="sf-sub-indicator"> »</span></a>
                                        <ul style="left: 12em; float: none; width: 12em; display: none; visibility: hidden;" class="sub-menu">
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-272" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-272"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/adult-birthday/">Adult Birthday</a></li>
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-273" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/boys-birthday/">Boys Birthday</a></li>
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-274" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/girls-birthday/">Girls Birthday</a></li>
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-408" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-408"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/teens-birthday/">Teen’s Birthday</a></li>
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1564" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1564"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/party-bags-fillers/">Party Bags Fillers</a></li>
                                            <li style="white-space: normal; float: left; width: 100%;" id="menu-item-282" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-282"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/birthday-party/party-by-colour/">Party By Colour</a></li>
                                        </ul>
                                    </li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1398" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1398"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/hen-party/">Hen Party</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1574" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1574"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/stag-party/">Stag Party</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1569" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1569"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/fathers-day/">Father’s Day</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1766" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1766"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/engagement/">Engagement Party</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1576" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1576"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/wedding/">Wedding Day</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1570" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1570"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/halloween/">Halloween</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1566" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1566"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/christmas/">Christmas</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1572" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1572"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/new-years-eve/">New Year’s Eve</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-849" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-849"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/mothers-day/">Mother’s Day</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1567" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1567"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/easter/">Easter</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1573" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1573"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/stpatricks-day/">St Patrick’s Day</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1575" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1575"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/party-themes/valentines-day/">Valentine’s Day</a></li>
                                </ul>
                            </li>
                            <li id="menu-item-62" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-62"><a href="http://www.localpartyshop.com/product-category/fancy-dress/">Fancy Dress</a></li>
                            <li id="menu-item-72" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-72"><a href="http://www.localpartyshop.com/product-category/cards/">Cards</a></li>
                            <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-122"><a class="sf-with-ul" href="http://www.localpartyshop.com/product-category/gifts/">Gifts<span class="sf-sub-indicator"> »</span></a>
                                <ul style="float: none; width: 12em; display: none; visibility: hidden;" class="sub-menu">
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1561" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1561"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/gifts/for-him/">For Him</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1562" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1562"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/gifts/for-her/">For Her</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1560" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1560"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/gifts/for-kids/">For Kids</a></li>
                                    <li style="white-space: normal; float: left; width: 100%;" id="menu-item-1563" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1563"><a style="float: none; width: auto;" href="http://www.localpartyshop.com/product-category/gifts/handmade-gifts/">Handmade Gifts</a></li>
                                </ul>
                            </li>

                            <li id="menu-item-347" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-347"><a href="http://www.localpartyshop.com/product-category/party-accessories/">Accessories</a></li>
                             <li id="menu-item-3000" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3000 "><a href="http://www.localpartyshop.com/product-category/sale/">Sale</a>
                        </ul>';
//                        <select class="tinynav tinynav1"><option>Navigation</option><option value="http://www.localpartyshop.com/">Home</option><option value="http://www.localpartyshop.com/product-category/balloons/">Balloons »</option><option value="http://www.localpartyshop.com/product-category/balloons/latex-balloons/">Latex Balloons</option><option value="http://www.localpartyshop.com/product-category/balloons/foil-balloons/">Foil Balloons</option><option value="http://www.localpartyshop.com/product-category/party-themes/">Party Themes »</option><option value="http://www.localpartyshop.com/product-category/party-themes/anniversary/">Anniversary</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/">Birthday Party »</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/adult-birthday/">Adult Birthday</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/boys-birthday/">Boys Birthday</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/girls-birthday/">Girls Birthday</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/teens-birthday/">Teen’s Birthday</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/party-bags-fillers/">Party Bags Fillers</option><option value="http://www.localpartyshop.com/product-category/party-themes/birthday-party/party-by-colour/">Party By Colour</option><option value="http://www.localpartyshop.com/product-category/party-themes/hen-party/">Hen Party</option><option value="http://www.localpartyshop.com/product-category/party-themes/stag-party/">Stag Party</option><option value="http://www.localpartyshop.com/product-category/party-themes/fathers-day/">Father’s Day</option><option value="http://www.localpartyshop.com/product-category/party-themes/engagement/">Engagement Party</option><option value="http://www.localpartyshop.com/product-category/party-themes/wedding/">Wedding Day</option><option value="http://www.localpartyshop.com/product-category/party-themes/halloween/">Halloween</option><option value="http://www.localpartyshop.com/product-category/party-themes/christmas/">Christmas</option><option value="http://www.localpartyshop.com/product-category/party-themes/new-years-eve/">New Year’s Eve</option><option value="http://www.localpartyshop.com/product-category/party-themes/mothers-day/">Mother’s Day</option><option value="http://www.localpartyshop.com/product-category/party-themes/easter/">Easter</option><option value="http://www.localpartyshop.com/product-category/party-themes/stpatricks-day/">St Patrick’s Day</option><option value="http://www.localpartyshop.com/product-category/party-themes/valentines-day/">Valentine’s Day</option><option value="http://www.localpartyshop.com/product-category/fancy-dress/">Fancy Dress</option><option value="http://www.localpartyshop.com/product-category/cards/">Cards</option><option value="http://www.localpartyshop.com/product-category/gifts/">Gifts »</option><option value="http://www.localpartyshop.com/product-category/gifts/for-him/">For Him</option><option value="http://www.localpartyshop.com/product-category/gifts/for-her/">For Her</option><option value="http://www.localpartyshop.com/product-category/gifts/for-kids/">For Kids</option><option value="http://www.localpartyshop.com/product-category/gifts/handmade-gifts/">Handmade Gifts</option><option value="http://www.localpartyshop.com/product-category/party-accessories/">Accessories</option></select>';
}

function get_selector_categories($cat_id){

    echo '<select onchange="getval(this);" style="position: absolute; z-index: 1; top: 7px; left: 5px; box-shadow: 0 0 3px 1px #666; -moz-border-shadow:0 0 3px 1px #666;
    -webkit-border-shadow:0 0 3px 1px #666; color: #000; background: transparent url(\'http://ukzone.localpartyshop.netdna-cdn.com/wp-content/themes/wooshop/assets/images/menubar.png\') repeat-x scroll 0% 0%; border-radius: 5px; -moz-border-radius:5px;
    -webkit-border-radius:5px; padding: 10px; width: 35%; height: 3em !important;font-size: 1.2em;">';
    $args2 = array(
        'taxonomy' => 'product_cat',
        'parent' => $cat_id
    );
    $sub_cats = get_categories($args2);

    if ($sub_cats) {
        foreach ($sub_cats as $cat) {
            echo '<option  value="' . get_term_link((int)$cat->term_id, 'product_cat') . '" style=" color: #000; background: transparent url(\'http://www.localpartyshop.com/wp-content/uploads/2015/08/party-header-front.jpg\') repeat-x scroll 0% 0%; padding: 8px;">';

            echo $cat->name;
            echo '</option>';
        }
    }
    echo '</select>';
}
?>