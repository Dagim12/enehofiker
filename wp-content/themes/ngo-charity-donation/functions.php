<?php
/**
 * NGO Charity Donation functions and definitions
 *
 * @subpackage NGO Charity Donation
 * @since 1.0
 */

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'ngo_charity_donation_loop_columns', 999);
if (!function_exists('ngo_charity_donation_loop_columns')) {
	function ngo_charity_donation_loop_columns() {
		return 3;
	}
}

function ngo_charity_donation_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function ngo_charity_donation_sanitize_checkbox( $ngo_charity_donation_input ) {
	return ( ( isset( $ngo_charity_donation_input ) && true == $ngo_charity_donation_input ) ? true : false );
}

function ngo_charity_donation_sanitize_select( $ngo_charity_donation_input, $setting ){
    $ngo_charity_donation_input = sanitize_key($ngo_charity_donation_input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $ngo_charity_donation_input, $choices ) ? $ngo_charity_donation_input : $setting->default );
}

function ngo_charity_donation_sanitize_choices( $ngo_charity_donation_input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $ngo_charity_donation_input, $control->choices ) ) {
        return $ngo_charity_donation_input;
    } else {
        return $setting->default;
    }
}

function ngo_charity_donation_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function ngo_charity_donation_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}

function ngo_charity_donation_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<div class="link-more text-center"><a href="%1$s" class="more-link py-2 px-4">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'ngo-charity-donation' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'ngo_charity_donation_excerpt_more' );

function ngo_charity_donation_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url("themes.php?page=ngo-charity-donation-guide-page") );
    }
}
add_action('after_setup_theme', 'ngo_charity_donation_notice');

function ngo_charity_donation_add_new_page() {
    $edit_page = admin_url().'post-new.php?post_type=page';
    echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

    exit;
}
add_action( 'wp_ajax_ngo_charity_donation_add_new_page','ngo_charity_donation_add_new_page' );

function ngo_charity_donation_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'ngo-charity-donation-featured-image', 2000, 1200, true );
	add_image_size( 'ngo-charity-donation-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ngo-charity-donation' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', ngo_charity_donation_fonts_url() ) );

}
add_action( 'after_setup_theme', 'ngo_charity_donation_setup' );

function ngo_charity_donation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ngo-charity-donation' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'ngo-charity-donation' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ngo-charity-donation' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ngo-charity-donation' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ngo-charity-donation' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ngo-charity-donation' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Category Dropdown', 'ngo-charity-donation' ),
		'id'            => 'product-cat',
		'description'   => __( 'Add widgets here to appear in your header.', 'ngo-charity-donation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'ngo_charity_donation_widgets_init' );

function ngo_charity_donation_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Inter:wght@100;200;300;400;500;600;700;800;900';
	$font_family[] = 'Outfit:wght@100;200;300;400;500;600;700;800;900';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

//Enqueue scripts and styles.
function ngo_charity_donation_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ngo-charity-donation-fonts', ngo_charity_donation_fonts_url(), array() );

	//Bootstarp
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'ngo-charity-donation-style', get_stylesheet_uri() );

	wp_style_add_data('ngo-charity-donation-style', 'rtl', 'replace');

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'ngo-charity-donation-style',$ngo_charity_donation_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'ngo-charity-donation-block-style', get_template_directory_uri().'/assets/css/blocks.css' );

	//Custom JS
	wp_enqueue_script( 'ngo-charity-donation-custom.js', get_theme_file_uri( '/assets/js/theme-script.js' ), array( 'jquery' ), true );

	//Nav Focus JS
	wp_enqueue_script( 'ngo-charity-donation-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	//Superfish JS
	wp_enqueue_script( 'superfish-js', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ),true );

	//Bootstarp JS
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ngo_charity_donation_scripts' );

function ngo_charity_donation_fonts_scripts() {
	$headings_font = esc_html(get_theme_mod('ngo_charity_donation_headings_text'));
	$body_font = esc_html(get_theme_mod('ngo_charity_donation_body_text'));

	if( $headings_font ) {
		wp_enqueue_style( 'ngo-charity-donation-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'ngo-charity-donation-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $body_font ) {
		wp_enqueue_style( 'ngo-charity-donation-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
	} else {
		wp_enqueue_style( 'ngo-charity-donation-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'ngo_charity_donation_fonts_scripts' );

function ngo_charity_donation_enqueue_admin_script( $hook ) {

	// Admin JS
	wp_enqueue_script( 'ngo-charity-donation-admin.js', get_theme_file_uri( '/assets/js/ngo-charity-donation-admin.js' ), array( 'jquery' ), true );

	wp_localize_script('ngo-charity-donation-admin.js', 'ngo_charity_donation_scripts_localize',
        array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php'))
        )
    );
}
add_action( 'admin_enqueue_scripts', 'ngo_charity_donation_enqueue_admin_script' );

// Enqueue editor styles for Gutenberg
function ngo_charity_donation_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'ngo-charity-donation-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'ngo-charity-donation-fonts', ngo_charity_donation_fonts_url(), array() );
}
add_action( 'enqueue_block_editor_assets', 'ngo_charity_donation_block_editor_styles' );

function ngo_charity_donation_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'ngo_charity_donation_front_page_template' );

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

require get_parent_theme_file_path( '/inc/typofont.php' );

require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );
