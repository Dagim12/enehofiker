<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * After setup theme hook
 */
function revive_charity_theme_setup()
{

    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'revive-charity', get_stylesheet_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
    
    add_image_size( 'revive-charity-donation-post', 780, 520, true );
    add_image_size( 'revive-charity-give', 768, 400, true );
    add_image_size( 'revive-charity-blog', 350, 244, true );

}
add_action('after_setup_theme', 'revive_charity_theme_setup');

/**
 * Load assets.
 */
function revive_charity_enqueue_styles() {

    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];

    wp_enqueue_style( 'benevolent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'revive-charity', get_stylesheet_directory_uri() . '/style.css', array('benevolent-style'), $version );

    wp_enqueue_script( 'revive-charity-custom', get_stylesheet_directory_uri() . '/js' . $build . '/child-custom' . $suffix . '.js', array( 'jquery' ), $version, true );

    $array = array(
        'rtl'  => is_rtl(),
    );

    wp_localize_script( 'revive-charity-custom', 'revive_charity_data', $array );
}
add_action( 'wp_enqueue_scripts', 'revive_charity_enqueue_styles' );

function revive_charity_remove_parent_action(){
    remove_action( 'customize_register', 'benevolent_customizer_theme_info' );
}
add_action( 'init', 'revive_charity_remove_parent_action' );

function revive_charity_customizer_overide_values( $wp_customize ) {
    $wp_customize->get_control( 'benevolent_intro_one_image' )->width = 350;
    $wp_customize->get_control( 'benevolent_intro_one_image' )->height = 270;
    $wp_customize->get_control( 'benevolent_intro_two_image' )->width = 350;
    $wp_customize->get_control( 'benevolent_intro_two_image' )->height = 270;
    $wp_customize->get_control( 'benevolent_intro_three_image' )->width = 350;
    $wp_customize->get_control( 'benevolent_intro_three_image' )->height = 270;
}
add_action( 'customize_register', 'revive_charity_customizer_overide_values', 40 );

function revive_charity_customizer_options( $wp_customize ){

    $wp_customize->add_section( 'theme_info' , array(
        'title'       => __( 'Information Links' , 'revive-charity' ),
        'priority'    => 6,
        ));

    $wp_customize->add_setting('theme_info_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));
    
    $theme_info = '';
    $theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'revive-charity' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'revive-charity' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=revive-charity/' ) . '" target="_blank">' . __( 'here', 'revive-charity' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'revive-charity' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/revive-charity/' ) . '" target="_blank">' . __( 'here', 'revive-charity' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'revive-charity' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blnak">' . __( 'here', 'revive-charity' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More Details', 'revive-charity' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank">' . __( 'here', 'revive-charity' ) . '</a></span><br />';
    

    $wp_customize->add_control( new Theme_Info_Custom_Control( $wp_customize ,'theme_info_theme',array(
        'label' => __( 'About Revive Charity' , 'revive-charity' ),
        'section' => 'theme_info',
        'description' => $theme_info
        )));

    $wp_customize->add_setting('theme_info_more_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));


    if( revive_charity_is_give_activated() ){
        /** Give Section */
        $wp_customize->add_section(
            'revive_charity_give_settings',
            array(
                'title' => __( 'Give Section', 'revive-charity' ),
                'priority' => 55,
                'panel' => 'benevolent_home_page_settings',
            )
        );
        
        /** Enable/Disable Give Section */
        $wp_customize->add_setting(
            'revive_charity_ed_give_section',
            array(
                'default' => false,
                'sanitize_callback' => 'benevolent_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            'revive_charity_ed_give_section',
            array(
                'label' => __( 'Enable Give Section', 'revive-charity' ),
                'section' => 'revive_charity_give_settings',
                'type' => 'checkbox',
            )
        );

        /** give Section Title */
        $wp_customize->add_setting(
            'revive_charity_give_section_title',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport' => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'revive_charity_give_section_title',
            array(
                'label' => __( 'Give Section Title', 'revive-charity' ),
                'section' => 'revive_charity_give_settings',
                'type' => 'text',
            )
        );

        $wp_customize->selective_refresh->add_partial('revive_charity_give_section_title', array(
            'selector' => '.home .give-section .header h2.main-title',
            'render_callback' => 'revive_charity_get_revive_charity_give_section_title',
        ));
        
        /** Give Section Content */
        $wp_customize->add_setting(
            'revive_charity_give_section_content',
            array(
                'default' => '',
                'sanitize_callback' => 'wp_kses_post',
                'transport' => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'revive_charity_give_section_content',
            array(
                'label' => __( 'Give Section Content', 'revive-charity' ),
                'section' => 'revive_charity_give_settings',
                'type' => 'textarea',
            )
        );

        $wp_customize->selective_refresh->add_partial('revive_charity_give_section_content', array(
            'selector' => '.home .give-section .header p',
            'render_callback' => 'revive_charity_get_revive_charity_give_section_content',
        ));

    }
    
    $wp_customize->add_setting(
        'revive_charity_blog_viewall',
        array(
            'default' => __( 'READ ALL BLOG', 'revive-charity' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'revive_charity_blog_viewall',
        array(
            'label' => __( 'Blog Section View All Text', 'revive-charity' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'text',
            'priority' => '50'
        )
    );

    $wp_customize->add_setting(
        'revive_charity_blog_viewall_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'revive_charity_blog_viewall_link',
        array(
            'label' => __( 'View All Url', 'revive-charity' ),
            'section' => 'benevolent_blog_settings',
            'type' => 'text',
            'priority' => '60'
        )
    );

    $wp_customize->add_setting(
        'revive_charity_community_readmore',
        array(
            'default' => __( 'LEARN MORE', 'revive-charity' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'revive_charity_community_readmore',
        array(
            'label' => __( 'Community Section Read more Text', 'revive-charity' ),
            'section' => 'benevolent_community_settings',
            'type' => 'text',
            'priority' => '20'
        )
    );

    /** Logo Six */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_six',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_six',
           array(
               'label'      => __( 'Upload Logo Six', 'revive-charity' ),
               'section'    => 'benevolent_sponsor_settings',
               'priority' => '20'
           )
       )
    );
    
    /** Logo Six Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_six_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_six_url',
        array(
            'label' => __( 'Logo Six Url', 'revive-charity' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
            'priority' => '20'
        )
    );

    /** Logo Seven */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_seven',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_seven',
           array(
               'label'      => __( 'Upload Logo Seven', 'revive-charity' ),
               'section'    => 'benevolent_sponsor_settings',
               'priority'   => '30'
           )
       )
    );
    
    /** Logo Seven Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_seven_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_seven_url',
        array(
            'label' => __( 'Logo Seven Url', 'revive-charity' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
            'priority'   => '30'
        )
    );

    /** Logo Eight */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_eight',
        array(
            'default' => '',
            'sanitize_callback' => 'benevolent_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'benevolent_sponsor_logo_eight',
           array(
               'label'      => __( 'Upload Logo Eight', 'revive-charity' ),
               'section'    => 'benevolent_sponsor_settings',
               'priority'   => '40'
           )
       )
    );
    
    /** Logo Seven Url */
    $wp_customize->add_setting(
        'benevolent_sponsor_logo_eight_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'benevolent_sponsor_logo_eight_url',
        array(
            'label' => __( 'Logo Eight Url', 'revive-charity' ),
            'section' => 'benevolent_sponsor_settings',
            'type' => 'text',
            'priority'   => '40'
        )
    );

}
add_action( 'customize_register', 'revive_charity_customizer_options' );

function revive_charity_get_revive_charity_give_section_content(){
    return esc_html( get_theme_mod( 'revive_charity_give_section_content' ) );
}

function revive_charity_get_revive_charity_give_section_title(){
    return esc_html( get_theme_mod( 'revive_charity_give_section_title' ) );
}

/** Check Is Give Donation Plugin Activate **/
function revive_charity_is_give_activated(){
    return class_exists( 'Give' ) ? true : false;
}

/**
 * Fuction to get Sections 
 */
function revive_charity_get_section(){
    $ed_stats = get_theme_mod( 'benevolent_ed_stats_section' );
    if( $ed_stats ){
        $add_class = 'our-community';
    }else{
        $add_class = 'our-community no-stats';
    }
    
    $sections = array( 
        'intro-section' => array(
            'class' => 'intro',
            'id'    => 'intro'    
        ),
        'community-section' => array(
            'class' => $add_class,
            'id'    => 'community'
        ),
        'stats-section' => array(
            'class' => 'stats',
            'id'    => 'stats'
        ),
        'give-section' => array(
            'class' => 'give-section',
            'id'    => 'give'
        ),
        'blog-section' => array(
            'class' => 'blog-section',
            'id'    => 'blog'
        ),
        'sponsor-section' => array(
            'class' => 'sponsors',
            'id'    => 'sponsor'
        )              
    );
        
    $enabled_section = array();
    foreach ( $sections as $section ) {
        if( $section['id'] == 'give' ){
            if(revive_charity_is_give_activated()){
                if(get_theme_mod( 'revive_charity_ed_give_section',false )){
                    $enabled_section[] = array(
                        'id' => $section['id'],
                        'class' => $section['class']
                    );
                }
            }
        }else{
            if(get_theme_mod( 'benevolent_ed_' . $section['id'] . '_section',false )){
                $enabled_section[] = array(
                    'id' => $section['id'],
                    'class' => $section['class']
                );
            }
        }
    }
    return $enabled_section;
}

add_action( 'tgmpa_register', 'revive_charity_register_required_plugins', 15 );

function revive_charity_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => __( 'Give Donation Plugin','revive-charity' ),
            'slug'      => 'give',
            'required'  => false,
        ),
   
    );

    $config = array(
        'id'           => 'revive-charity',    // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}

/**
 * Add custom classes to the array of post classes.
*/
function revive_charity_post_classes( $classes ){

    if( revive_charity_is_give_activated() ){
        if( is_post_type_archive( 'give_forms' ) || is_singular('give_forms') ){
            $classes[] = 'post';
        }
    }
    return $classes;
}
add_filter( 'post_class', 'revive_charity_post_classes' );

if( revive_charity_is_give_activated() ){
    remove_action( 'give_single_form_summary', 'give_template_single_title', 5 );
    add_action( 'give_before_single_form_summary', 'give_template_single_title', 4 );
}

/** 
* Footer Credit
**/
function benevolent_footer_credit(){
    $copyright_text = get_theme_mod( 'benevolent_footer_copyright_text' );
    $text  = '<div class="site-info"><div class="container">';
    $text .= '<span class="copyright">';
      if( $copyright_text ){
        $text .=  wp_kses_post( $copyright_text );
      }else{
        $text .=  esc_html__( '&copy; ', 'revive-charity' ) . date_i18n( esc_html__( 'Y', 'revive-charity' ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
      }
    $text .= '.</span>';
    if ( function_exists( 'the_privacy_policy_link' ) ) {
       $text .= get_the_privacy_policy_link();
   }
    $text .= '<span class="by">';
    $text .= esc_html__( 'Revive Charity | Developed By ', 'revive-charity' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'revive-charity' ) . '</a>.';
    $text .= sprintf( esc_html__( ' Powered by %s', 'revive-charity' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'revive-charity' ) ) .'" target="_blank">WordPress</a>.' );
    $text .= '</span></div></div>';
    echo apply_filters( 'benevolent_footer_text', $text );    
}

/**
 * Register custom fonts.
 */
function benevolent_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Raleway, translate this to 'off'. Do not translate into your own language.
    */
    $lexenddeca_font = _x( 'on', 'Lexend Deca: on or off', 'revive-charity' );

    if ( 'off' !== $lexenddeca_font ) {
        $font_families = array();

        if ( 'off' !== $lexenddeca_font ) {
            $font_families[] = 'Lexend Deca:100,200,300,400,500,600,700';
        }
       
        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'subset'  => urlencode( 'latin,latin-ext' ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}