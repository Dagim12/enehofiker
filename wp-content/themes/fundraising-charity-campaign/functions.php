<?php
/**
 * Theme functions and definitions
 *
 * @package Fundraising Charity Campaign
 */

if ( ! function_exists( 'fundraising_charity_campaign_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function fundraising_charity_campaign_enqueue_styles() {
		wp_enqueue_style( 'ngo-charity-donation-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'fundraising-charity-campaign-style', get_stylesheet_directory_uri() . '/style.css', array( 'ngo-charity-donation-style-parent' ), '1.0.0' );

		// Theme Customize CSS.
		require get_parent_theme_file_path( 'inc/extra_customization.php' );
		wp_add_inline_style( 'fundraising-charity-campaign-style',$ngo_charity_donation_custom_style );
	}
endif;
add_action( 'wp_enqueue_scripts', 'fundraising_charity_campaign_enqueue_styles', 99 );

function fundraising_charity_campaign_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'fundraising-charity-campaign-featured-image', 2000, 1200, true );
	add_image_size( 'fundraising-charity-campaign-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fundraising-charity-campaign' ),
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

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, and column width.
	*/
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}
add_action( 'after_setup_theme', 'fundraising_charity_campaign_setup' );

function fundraising_charity_campaign_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fundraising-charity-campaign' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'fundraising-charity-campaign' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'fundraising-charity-campaign' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'fundraising-charity-campaign' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'fundraising-charity-campaign' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'fundraising-charity-campaign' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fundraising-charity-campaign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fundraising_charity_campaign_widgets_init' );

function fundraising_charity_campaign_customize_register() {
  	global $wp_customize;

  	$wp_customize->remove_section( 'ngo_charity_donation_pro' );
}
add_action( 'customize_register', 'fundraising_charity_campaign_customize_register', 11 );

function fundraising_charity_campaign_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function fundraising_charity_campaign_customize( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_stylesheet_directory_uri() ). '/assets/css/customizer.css');

	$wp_customize->add_section('fundraising_charity_campaign_pro', array(
		'title'    => __('UPGRADE CHARITY PREMIUM', 'fundraising-charity-campaign'),
		'priority' => 1,
	));

	$wp_customize->add_setting('fundraising_charity_campaign_pro', array(
		'default'           => null,
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(new Fundraising_Charity_Campaign_Pro_Control($wp_customize, 'fundraising_charity_campaign_pro', array(
		'label'    => __('CHARITY PREMIUM', 'fundraising-charity-campaign'),
		'section'  => 'fundraising_charity_campaign_pro',
		'settings' => 'fundraising_charity_campaign_pro',
		'priority' => 1,
	)));

	// About Us Section
	$wp_customize->add_section( 'fundraising_charity_campaign_about_us_section' , array(
    	'title'      => __( 'About Us Settings', 'fundraising-charity-campaign' ),
		'priority'   => 4,
	) );

	$wp_customize->add_setting('fundraising_charity_campaign_about_us_settigs',array(
		'sanitize_callback' => 'fundraising_charity_campaign_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('fundraising_charity_campaign_about_us_settigs',array(
		'type'    => 'dropdown-pages',
		'label' => __('Select Page','fundraising-charity-campaign'),
		'section' => 'fundraising_charity_campaign_about_us_section',
	));

}
add_action( 'customize_register', 'fundraising_charity_campaign_customize' );

function fundraising_charity_campaign_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'fundraising_charity_campaign_enqueue_comments_reply' );

define('FUNDRAISING_CHARITY_CAMPAIGN_PRO_LINK',__('https://www.ovationthemes.com/wordpress/charity-campaign-wordpress-theme/','fundraising-charity-campaign'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Fundraising_Charity_Campaign_Pro_Control')):
    class Fundraising_Charity_Campaign_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( FUNDRAISING_CHARITY_CAMPAIGN_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CHARITY PREMIUM','fundraising-charity-campaign');?> </a>
            </div>
            <div class="col-md">
                <img class="fundraising_charity_campaign_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('CHARITY PREMIUM - Features', 'fundraising-charity-campaign'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'fundraising-charity-campaign');?> </li>
                    <li class="upsell-fundraising_charity_campaign"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'fundraising-charity-campaign');?> </li>
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( FUNDRAISING_CHARITY_CAMPAIGN_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CHARITY PREMIUM','fundraising-charity-campaign');?> </a>
            </div>
        </label>
    <?php } }
endif;

if ( ! defined( 'NGO_CHARITY_DONATION_SUPPORT' ) ) {
define('NGO_CHARITY_DONATION_SUPPORT',__('https://wordpress.org/support/theme/fundraising-charity-campaign','fundraising-charity-campaign'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_REVIEW' ) ) {
define('NGO_CHARITY_DONATION_REVIEW',__('https://wordpress.org/support/theme/fundraising-charity-campaign/reviews/#new-post','fundraising-charity-campaign'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_LIVE_DEMO' ) ) {
define('NGO_CHARITY_DONATION_LIVE_DEMO',__('https://www.ovationthemes.com/demos/fundraising-charity-campaign/','fundraising-charity-campaign'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_BUY_PRO' ) ) {
define('NGO_CHARITY_DONATION_BUY_PRO',__('https://www.ovationthemes.com/wordpress/charity-campaign-wordpress-theme/','fundraising-charity-campaign'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_PRO_DOC' ) ) {
define('NGO_CHARITY_DONATION_PRO_DOC',__('https://www.ovationthemes.com/docs/ot-fundraising-charity-campaign-pro-doc/','fundraising-charity-campaign'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_THEME_NAME' ) ) {
define('NGO_CHARITY_DONATION_THEME_NAME',__('Premium Charity Campaign Theme','fundraising-charity-campaign'));
}
