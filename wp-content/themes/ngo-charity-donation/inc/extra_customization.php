<?php 

	/*---------------------------Width -------------------*/

	$ngo_charity_donation_custom_style= "";
	
	$ngo_charity_donation_theme_width = get_theme_mod( 'ngo_charity_donation_width_options','full_width');

    if($ngo_charity_donation_theme_width == 'full_width'){

		$ngo_charity_donation_custom_style .='body{';

			$ngo_charity_donation_custom_style .='max-width: 100%;';

		$ngo_charity_donation_custom_style .='}';

	}else if($ngo_charity_donation_theme_width == 'Container'){

		$ngo_charity_donation_custom_style .='body{';

			$ngo_charity_donation_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

		$ngo_charity_donation_custom_style .='}';

	}else if($ngo_charity_donation_theme_width == 'container_fluid'){

		$ngo_charity_donation_custom_style .='body{';

			$ngo_charity_donation_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$ngo_charity_donation_custom_style .='}';
	}

	//---------------------------------------------------------------------------------------------

	$ngo_charity_donation_sticky_header = get_theme_mod('ngo_charity_donation_sticky_header');

	if($ngo_charity_donation_sticky_header != true){

		$ngo_charity_donation_custom_style .='.menu_header.fixed{';

			$ngo_charity_donation_custom_style .='position: static;';
			
		$ngo_charity_donation_custom_style .='}';
	}

	/*---------------------------Scroll-top-position -------------------*/
	
	$ngo_charity_donation_scroll_options = get_theme_mod( 'ngo_charity_donation_scroll_options','right_align');

    if($ngo_charity_donation_scroll_options == 'right_align'){

		$ngo_charity_donation_custom_style .='.scroll-top button{';

			$ngo_charity_donation_custom_style .='';

		$ngo_charity_donation_custom_style .='}';

	}else if($ngo_charity_donation_scroll_options == 'center_align'){

		$ngo_charity_donation_custom_style .='.scroll-top button{';

			$ngo_charity_donation_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$ngo_charity_donation_custom_style .='}';

	}else if($ngo_charity_donation_scroll_options == 'left_align'){

		$ngo_charity_donation_custom_style .='.scroll-top button{';

			$ngo_charity_donation_custom_style .='right: auto; left:5%; margin: 0 auto';

		$ngo_charity_donation_custom_style .='}';
	}

	//---------------------------------------------------------------------------

	$ngo_charity_donation_logo_max_height = get_theme_mod('ngo_charity_donation_logo_max_height');

	if($ngo_charity_donation_logo_max_height != false){

		$ngo_charity_donation_custom_style .='.custom-logo-link img{';

			$ngo_charity_donation_custom_style .='max-height: '.esc_html($ngo_charity_donation_logo_max_height).'px;';
			
		$ngo_charity_donation_custom_style .='}';
	}