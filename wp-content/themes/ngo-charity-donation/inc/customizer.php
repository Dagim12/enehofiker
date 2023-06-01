<?php
/**
 * NGO Charity Donation: Customizer
 *
 * @subpackage NGO Charity Donation
 * @since 1.0
 */

function ngo_charity_donation_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// Add custom control.
  	require get_parent_theme_file_path( 'inc/customize/customize_toggle.php' );

	// Register the custom control type.
	$wp_customize->register_control_type( 'NGO_Charity_Donation_Toggle_Control' );

	$wp_customize->add_section( 'ngo_charity_donation_typography_settings', array(
		'title'       => __( 'Typography', 'ngo-charity-donation' ),
		'priority'       => 2,
	) );

	$font_choices = array(
			'' => 'Select',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
			'Droid Sans:400,700' => 'Droid Sans',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif',
			'PT Sans:400,700,400italic,700italic' => 'PT Sans',
			'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			'Bitter:400,700,400italic' => 'Bitter',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
			'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
			'Roboto Slab:400,700' => 'Roboto Slab',
			'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
			'Rokkitt:400' => 'Rokkitt',
		);


	$wp_customize->add_setting( 'ngo_charity_donation_headings_text', array(
		'sanitize_callback' => 'ngo_charity_donation_sanitize_fonts',
	));

	$wp_customize->add_control( 'ngo_charity_donation_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'ngo-charity-donation'),
		'section' => 'ngo_charity_donation_typography_settings',
		'choices' => $font_choices

	));

	$wp_customize->add_setting( 'ngo_charity_donation_body_text', array(
		'sanitize_callback' => 'ngo_charity_donation_sanitize_fonts'
	));

	$wp_customize->add_control( 'ngo_charity_donation_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'ngo-charity-donation' ),
		'section' => 'ngo_charity_donation_typography_settings',
		'choices' => $font_choices
	) );

 	$wp_customize->add_section('ngo_charity_donation_pro', array(
        'title'    => __('UPGRADE NGO CHARITY PREMIUM', 'ngo-charity-donation'),
        'priority' => 1,
    ));

    $wp_customize->add_setting('ngo_charity_donation_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new NGO_Charity_Donation_Pro_Control($wp_customize, 'ngo_charity_donation_pro', array(
        'label'    => __('NGO CHARITY PREMIUM', 'ngo-charity-donation'),
        'section'  => 'ngo_charity_donation_pro',
        'settings' => 'ngo_charity_donation_pro',
        'priority' => 1,
    )));

    //Logo
    $wp_customize->add_setting('ngo_charity_donation_logo_max_height',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ngo_charity_donation_sanitize_number_absint'
	));
	$wp_customize->add_control('ngo_charity_donation_logo_max_height',array(
		'label'	=> esc_html__('Logo Width','ngo-charity-donation'),
		'section'	=> 'title_tagline',
		'type'		=> 'number'
	));
    $wp_customize->add_setting( 'ngo_charity_donation_logo_title', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new ngo_charity_donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_logo_title', array(
		'label'       => esc_html__( 'Show Site Title', 'ngo-charity-donation' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_logo_title',
	) ) );

    $wp_customize->add_setting( 'ngo_charity_donation_logo_text', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new ngo_charity_donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_logo_text', array(
		'label'       => esc_html__( 'Show Site Tagline', 'ngo-charity-donation' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_logo_text',
	) ) );

    // Theme General Settings
    $wp_customize->add_section('ngo_charity_donation_theme_settings',array(
        'title' => __('Theme General Settings', 'ngo-charity-donation'),
        'priority' => 1
    ) );

    $wp_customize->add_setting( 'ngo_charity_donation_sticky_header', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_sticky_header', array(
		'label'       => esc_html__( 'Show Sticky Header', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_sticky_header',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_theme_loader', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_theme_loader', array(
		'label'       => esc_html__( 'Show Site Loader', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_theme_loader',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_scroll_enable', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_scroll_enable', array(
		'label'       => esc_html__( 'Show Scroll Top', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_scroll_enable',
	) ) );

	$wp_customize->add_setting('ngo_charity_donation_scroll_options',array(
        'default' => 'right_align',
        'sanitize_callback' => 'ngo_charity_donation_sanitize_choices'
	));
	$wp_customize->add_control('ngo_charity_donation_scroll_options',array(
        'type' => 'select',
        'label' => __('Scroll Top Alignment','ngo-charity-donation'),
        'section' => 'ngo_charity_donation_theme_settings',
        'choices' => array(
            'right_align' => __('Right Align','ngo-charity-donation'),
            'center_align' => __('Center Align','ngo-charity-donation'),
            'left_align' => __('Left Align','ngo-charity-donation'),
        ),
	) );

	$wp_customize->add_setting( 'ngo_charity_donation_shop_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_shop_page_sidebar', array(
		'label'       => esc_html__( 'Show Shop Page Sidebar', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_shop_page_sidebar',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_wocommerce_single_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_wocommerce_single_page_sidebar', array(
		'label'       => esc_html__( 'Show Single Product Page Sidebar', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_wocommerce_single_page_sidebar',
	) ) );

    //theme width

	$wp_customize->add_section('ngo_charity_donation_theme_width_settings',array(
        'title' => __('Theme Width Option', 'ngo-charity-donation'),
        'priority' => 1
    ) );

	$wp_customize->add_setting('ngo_charity_donation_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'ngo_charity_donation_sanitize_choices'
	));
	$wp_customize->add_control('ngo_charity_donation_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','ngo-charity-donation'),
        'section' => 'ngo_charity_donation_theme_width_settings',
        'choices' => array(
            'full_width' => __('Fullwidth','ngo-charity-donation'),
            'Container' => __('Container','ngo-charity-donation'),
            'container_fluid' => __('Container Fluid','ngo-charity-donation'),
        ),
	) );

	// Post Layouts
    $wp_customize->add_section('ngo_charity_donation_layout',array(
        'title' => __('Post Layout', 'ngo-charity-donation'),
        'description' => __( 'Change the post layout from below options', 'ngo-charity-donation' ),
        'priority' => 1
    ) );

	$wp_customize->add_setting( 'ngo_charity_donation_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_post_sidebar', array(
		'label'       => esc_html__( 'Show Fullwidth', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_layout',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_post_sidebar',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_single_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_single_post_sidebar', array(
		'label'       => esc_html__( 'Show Single Post Fullwidth', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_layout',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_single_post_sidebar',
	) ) );

    $wp_customize->add_setting('ngo_charity_donation_post_option',array(
		'default' => 'simple_post',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_select'
	));
	$wp_customize->add_control('ngo_charity_donation_post_option',array(
		'label' => esc_html__('Select Layout','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_layout',
		'setting' => 'ngo_charity_donation_post_option',
		'type' => 'radio',
        'choices' => array(
            'simple_post' => __('Simple Post','ngo-charity-donation'),
            'grid_post' => __('Grid Post','ngo-charity-donation'),
        ),
	));

    $wp_customize->add_setting('ngo_charity_donation_grid_column',array(
		'default' => '3_column',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_select'
	));
	$wp_customize->add_control('ngo_charity_donation_grid_column',array(
		'label' => esc_html__('Grid Post Per Row','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_layout',
		'setting' => 'ngo_charity_donation_grid_column',
		'type' => 'radio',
        'choices' => array(
            '1_column' => __('1','ngo-charity-donation'),
            '2_column' => __('2','ngo-charity-donation'),
            '3_column' => __('3','ngo-charity-donation'),
            '4_column' => __('4','ngo-charity-donation'),
            '5_column' => __('6','ngo-charity-donation'),
        ),
	));

	$wp_customize->add_setting( 'ngo_charity_donation_date', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_date', array(
		'label'       => esc_html__( 'Hide Date', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_layout',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_date',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_admin', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_admin', array(
		'label'       => esc_html__( 'Hide Author/Admin', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_layout',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_admin',
	) ) );

	$wp_customize->add_setting( 'ngo_charity_donation_comment', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new NGO_Charity_Donation_Toggle_Control( $wp_customize, 'ngo_charity_donation_comment', array(
		'label'       => esc_html__( 'Hide Comment', 'ngo-charity-donation' ),
		'section'     => 'ngo_charity_donation_layout',
		'type'        => 'toggle',
		'settings'    => 'ngo_charity_donation_comment',
	) ) );

	// Top Header
    $wp_customize->add_section('ngo_charity_donation_top',array(
        'title' => __('Contact info', 'ngo-charity-donation'),
        'priority' => 1
    ) );

    $wp_customize->add_setting('ngo_charity_donation_call_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_call_text',array(
		'label' => esc_html__('Add Phone Text','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_call_text',
		'type'    => 'text'
	));

    $wp_customize->add_setting('ngo_charity_donation_call_number',array(
		'default' => '',
		'sanitize_callback' => 'ngo_charity_donation_sanitize_phone_number'
	));
	$wp_customize->add_control('ngo_charity_donation_call_number',array(
		'label' => esc_html__('Add Phone Number','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_call_number',
		'type'    => 'text'
	));

    $wp_customize->add_setting('ngo_charity_donation_email_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_email_text',array(
		'label' => esc_html__('Add Email Text','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_email_text',
		'type'    => 'text'
	));

    $wp_customize->add_setting('ngo_charity_donation_email_address',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email'
	));
	$wp_customize->add_control('ngo_charity_donation_email_address',array(
		'label' => esc_html__('Add Email Address','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_email_address',
		'type'    => 'text'
	));

    $wp_customize->add_setting('ngo_charity_donation_donate_btn_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_donate_btn_text',array(
		'label' => esc_html__('Add Donate Button Text','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_donate_btn_text',
		'type'    => 'text'
	));

    $wp_customize->add_setting('ngo_charity_donation_donate_btn_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_donate_btn_link',array(
		'label' => esc_html__('Add Donate Button URL','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_top',
		'setting' => 'ngo_charity_donation_donate_btn_link',
		'type'    => 'url'
	));

	// Social Media
    $wp_customize->add_section('ngo_charity_donation_urls',array(
        'title' => __('Social Media', 'ngo-charity-donation'),
        'description' => __( 'Add social media links in the below feilds', 'ngo-charity-donation' ),
        'priority' => 3
    ) );

	$wp_customize->add_setting('ngo_charity_donation_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_facebook',array(
		'label' => esc_html__('Facebook URL','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_urls',
		'setting' => 'ngo_charity_donation_facebook',
		'type'    => 'url'
	));

	$wp_customize->add_setting('ngo_charity_donation_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_twitter',array(
		'label' => esc_html__('Twitter URL','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_urls',
		'setting' => 'ngo_charity_donation_twitter',
		'type'    => 'url'
	));

	$wp_customize->add_setting('ngo_charity_donation_youtube',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_youtube',array(
		'label' => esc_html__('Youtube URL','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_urls',
		'setting' => 'ngo_charity_donation_youtube',
		'type'    => 'url'
	));

	$wp_customize->add_setting('ngo_charity_donation_instagram',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_instagram',array(
		'label' => esc_html__('Instagram URL','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_urls',
		'setting' => 'ngo_charity_donation_instagram',
		'type'    => 'url'
	));

    //Slider
	$wp_customize->add_section( 'ngo_charity_donation_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'ngo-charity-donation' ),
		'priority'   => 3,
	) );

	$ngo_charity_donation_args = array('numberposts' => -1);
	$post_list = get_posts($ngo_charity_donation_args);
	$ngo_charity_donation_i = 0;
	$pst_sls[]= __('Select','ngo-charity-donation');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $ngo_charity_donation_i = 1; $ngo_charity_donation_i <= 4; $ngo_charity_donation_i++ ) {
		$wp_customize->add_setting('ngo_charity_donation_post_setting'.$ngo_charity_donation_i,array(
			'sanitize_callback' => 'ngo_charity_donation_sanitize_select',
		));
		$wp_customize->add_control('ngo_charity_donation_post_setting'.$ngo_charity_donation_i,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','ngo-charity-donation'),
			'section' => 'ngo_charity_donation_slider_section',
		));
	}
	wp_reset_postdata();

	// Volunteer Section
	$wp_customize->add_section( 'ngo_charity_donation_volunteer_section' , array(
    	'title'      => __( 'Volunteer Section Settings', 'ngo-charity-donation' ),
		'priority'   => 4,
	) );

	$wp_customize->add_setting('ngo_charity_donation_volunteer_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_volunteer_title',array(
		'label'	=> esc_html__('Section Title ','ngo-charity-donation'),
		'section'	=> 'ngo_charity_donation_volunteer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ngo_charity_donation_volunteer_btn_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_volunteer_btn_text',array(
		'label'	=> esc_html__('Section Button Text','ngo-charity-donation'),
		'section'	=> 'ngo_charity_donation_volunteer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ngo_charity_donation_volunteer_btn_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('ngo_charity_donation_volunteer_btn_link',array(
		'label'	=> esc_html__('Section Button URL','ngo-charity-donation'),
		'section'	=> 'ngo_charity_donation_volunteer_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('ngo_charity_donation_volunteer_increament',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_volunteer_increament',array(
		'label'	=> esc_html__('Volunteer Box Increament','ngo-charity-donation'),
		'section'	=> 'ngo_charity_donation_volunteer_section',
		'type'		=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	));

	$ngo_charity_donation_volunteer = get_theme_mod('ngo_charity_donation_volunteer_increament');

	for ($ngo_charity_donation_i=1; $ngo_charity_donation_i <= $ngo_charity_donation_volunteer ; $ngo_charity_donation_i++) {

		$wp_customize->add_setting('ngo_charity_donation_volunteer_box_icon'.$ngo_charity_donation_i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('ngo_charity_donation_volunteer_box_icon'.$ngo_charity_donation_i,array(
			'label'	=> esc_html__('Icon ','ngo-charity-donation').$ngo_charity_donation_i,
			'section'	=> 'ngo_charity_donation_volunteer_section',
			'type'		=> 'text'
		));

		$wp_customize->add_setting('ngo_charity_donation_volunteer_box_number'.$ngo_charity_donation_i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('ngo_charity_donation_volunteer_box_number'.$ngo_charity_donation_i,array(
			'label'	=> esc_html__('Number ','ngo-charity-donation').$ngo_charity_donation_i,
			'section'	=> 'ngo_charity_donation_volunteer_section',
			'type'		=> 'text'
		));

		$wp_customize->add_setting('ngo_charity_donation_volunteer_box_title'.$ngo_charity_donation_i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('ngo_charity_donation_volunteer_box_title'.$ngo_charity_donation_i,array(
			'label'	=> esc_html__('Title ','ngo-charity-donation').$ngo_charity_donation_i,
			'section'	=> 'ngo_charity_donation_volunteer_section',
			'type'		=> 'text'
		));

	}


	//Footer
    $wp_customize->add_section( 'ngo_charity_donation_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'ngo-charity-donation' ),
    	'priority' => 6
	) );

    $wp_customize->add_setting('ngo_charity_donation_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ngo_charity_donation_footer_text',array(
		'label'	=> esc_html__('Copyright Text','ngo-charity-donation'),
		'section'	=> 'ngo_charity_donation_footer_copyright',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ngo_charity_donation_footer_widget',array(
	'default' => '4',
	'sanitize_callback' => 'ngo_charity_donation_sanitize_select'
));
	$wp_customize->add_control('ngo_charity_donation_footer_widget',array(
		'label' => esc_html__('Footer Per Column','ngo-charity-donation'),
		'section' => 'ngo_charity_donation_footer_copyright',
		'setting' => 'ngo_charity_donation_footer_widget',
		'type' => 'radio',
				'choices' => array(
						'1'   => __('1 Column', 'ngo-charity-donation'),
						'2'  => __('2 Column', 'ngo-charity-donation'),
						'3' => __('3 Column', 'ngo-charity-donation'),
						'4' => __('4 Column', 'ngo-charity-donation')
				),
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'ngo_charity_donation_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'ngo_charity_donation_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'ngo_charity_donation_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $ngo_charity_donation_i = 1; $ngo_charity_donation_i < ( 1 + $num_sections ); $ngo_charity_donation_i++ ) {
		$wp_customize->add_setting( 'panel_' . $ngo_charity_donation_i, array(
			'default'           => false,
			'sanitize_callback' => 'ngo_charity_donation_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $ngo_charity_donation_i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'ngo-charity-donation' ), $ngo_charity_donation_i ),
			'description'    => ( 1 !== $ngo_charity_donation_i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'ngo-charity-donation' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'ngo_charity_donation_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $ngo_charity_donation_i, array(
			'selector'            => '#panel' . $ngo_charity_donation_i,
			'render_callback'     => 'ngo_charity_donation_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'ngo_charity_donation_customize_register' );

function ngo_charity_donation_customize_partial_blogname() {
	bloginfo( 'name' );
}
function ngo_charity_donation_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function ngo_charity_donation_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function ngo_charity_donation_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('NGO_CHARITY_DONATION_PRO_LINK',__('https://www.ovationthemes.com/wordpress/ngo-charity-wordpress-theme/','ngo-charity-donation'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('NGO_Charity_Donation_Pro_Control')):
    class NGO_Charity_Donation_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( NGO_CHARITY_DONATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE NGO CHARITY PREMIUM','ngo-charity-donation');?> </a>
	        </div>
            <div class="col-md">
                <img class="ngo_charity_donation_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('NGO CHARITY PREMIUM - Features', 'ngo-charity-donation'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'ngo-charity-donation');?> </li>
                    <li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'ngo-charity-donation');?> </li>
                   	<li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'ngo-charity-donation');?> </li>
                   	<li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'ngo-charity-donation');?> </li>
                   	<li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'ngo-charity-donation');?> </li>
                   	<li class="upsell-ngo_charity_donation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'ngo-charity-donation');?> </li>
                </ul>
        	</div>
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( NGO_CHARITY_DONATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE NGO CHARITY PREMIUM','ngo-charity-donation');?> </a>
		    </div>
		    <p><?php printf(__('Please review us if you love our product on %1$sWordPress.org%2$s. </br></br>  Thank You', 'ngo-charity-donation'), '<a target="blank" href="https://wordpress.org/support/theme/ngo-charity-donation/reviews/">', '</a>');
            ?></p>
        </label>
    <?php } }
endif;
