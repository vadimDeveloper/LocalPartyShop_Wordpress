        <?php

		//$disableSlider = of_get_option('dessky_disable_slider' ,'false');

		//$hasslider = false;

		if(is_front_page() && $disableSlider!=true){

			

			if($disableSlider!==true){

				get_template_part( 'slider');

			}

			$hasslider = true;

		}

        ?>

        

        	