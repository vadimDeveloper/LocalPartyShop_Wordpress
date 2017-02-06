<?php

		$hasslider = false;

		if(is_page(66) && $disableSlider!=true){			

			if($disableSlider!==true){

				get_template_part( 'testimonials-slider');

			}

			$hasslider = true;
		}

?>
