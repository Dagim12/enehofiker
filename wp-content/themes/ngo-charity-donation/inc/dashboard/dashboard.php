<?php

add_action( 'admin_menu', 'ngo_charity_donation_gettingstarted' );
function ngo_charity_donation_gettingstarted() {    	
	add_theme_page( esc_html__('Theme Documentation', 'ngo-charity-donation'), esc_html__('Theme Documentation', 'ngo-charity-donation'), 'edit_theme_options', 'ngo-charity-donation-guide-page', 'ngo_charity_donation_guide');   
}

function ngo_charity_donation_admin_theme_style() {
   wp_enqueue_style('ngo-charity-donation-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'ngo_charity_donation_admin_theme_style');

if ( ! defined( 'NGO_CHARITY_DONATION_SUPPORT' ) ) {
define('NGO_CHARITY_DONATION_SUPPORT',__('https://wordpress.org/support/theme/ngo-charity-donation/','ngo-charity-donation'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_REVIEW' ) ) {
define('NGO_CHARITY_DONATION_REVIEW',__('https://wordpress.org/support/theme/ngo-charity-donation/reviews/','ngo-charity-donation'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_LIVE_DEMO' ) ) {
define('NGO_CHARITY_DONATION_LIVE_DEMO',__('https://www.ovationthemes.com/demos/ngo-charity-donation/','ngo-charity-donation'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_BUY_PRO' ) ) {
define('NGO_CHARITY_DONATION_BUY_PRO',__('https://www.ovationthemes.com/wordpress/ngo-charity-wordpress-theme/','ngo-charity-donation'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_PRO_DOC' ) ) {
define('NGO_CHARITY_DONATION_PRO_DOC',__('https://www.ovationthemes.com/docs/ot-ngo-charity-pro-doc/','ngo-charity-donation'));
}
if ( ! defined( 'NGO_CHARITY_DONATION_THEME_NAME' ) ) {
define('NGO_CHARITY_DONATION_THEME_NAME',__('Premium NGO Charity Theme','ngo-charity-donation'));
}

/**
 * Theme Info Page
 */
function ngo_charity_donation_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme(); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'ngo-charity-donation'); ?><?php echo esc_html($theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( NGO_CHARITY_DONATION_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'ngo-charity-donation'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( NGO_CHARITY_DONATION_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'ngo-charity-donation'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','ngo-charity-donation'); ?></h3>
					<p><?php esc_html_e('To setup the NGO Charity theme follow the below steps.','ngo-charity-donation'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('2. Setup Contact Info','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Contact info >> Add your phone number and email address.','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ngo_charity_donation_top') ); ?>" target="_blank"><?php esc_html_e('Add Contact Info','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('3. Setup Menus','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('4. Setup Social Icons','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add social links.','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ngo_charity_donation_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ngo_charity_donation_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','ngo-charity-donation'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','ngo-charity-donation'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','ngo-charity-donation'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates >> Publish it.','ngo-charity-donation'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','ngo-charity-donation'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ngo_charity_donation_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','ngo-charity-donation'); ?></a>

					<h4><?php esc_html_e('3. Setup Volunteer Section Settings','ngo-charity-donation'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Volunteer Section Settings >> Add Content','ngo-charity-donation'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ngo_charity_donation_volunteer_section') ); ?>" target="_blank"><?php esc_html_e('Add Volunteer','ngo-charity-donation'); ?></a>
				</div>
          	</div>
			<div class="col-md-3">
				<h3><?php echo esc_html(NGO_CHARITY_DONATION_THEME_NAME); ?></h3>
				<img class="ngo_charity_donation_img_responsive" style="width: 100%;" src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
					<a class="button-primary buynow" href="<?php echo esc_url( NGO_CHARITY_DONATION_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'ngo-charity-donation'); ?></a>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( NGO_CHARITY_DONATION_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'ngo-charity-donation'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( NGO_CHARITY_DONATION_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'ngo-charity-donation'); ?></a>
					<hr>
				</div>
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
		</div>
	</div>

<?php }?>
