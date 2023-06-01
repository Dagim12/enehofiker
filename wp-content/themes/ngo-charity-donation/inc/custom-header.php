<?php
/**
 * Custom header
 */

function ngo_charity_donation_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ngo_charity_donation_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 100,
		'wp-head-callback'       => 'ngo_charity_donation_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'ngo_charity_donation_custom_header_setup' );

if ( ! function_exists( 'ngo_charity_donation_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see ngo_charity_donation_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'ngo_charity_donation_header_style' );
function ngo_charity_donation_header_style() {
	if ( get_header_image() ) :
	$custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center top;
		}";
	   	wp_add_inline_style( 'ngo-charity-donation-style', $custom_css );
	endif;
}
endif;