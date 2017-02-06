<?php
session_start();
add_action('wp_ajax_getqtycart', 'getqtycart');
add_action('wp_ajax_nopriv_getqtycart', 'getqtycart');

function getqtycart(){

	//check_ajax_referer( 'add-to-cart', 'security' );
	
	$thecarts = $_SESSION['cart'];
	$totalcart = 0;
	if(is_array($thecarts)){
		foreach($thecarts as $thecart){
			if(is_numeric($thecart["quantity"])){
				$totalcart += $thecart["quantity"];
			}
		}
	}
	return $totalcart;
}