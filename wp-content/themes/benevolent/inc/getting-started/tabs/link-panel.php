<?php
/**
 * Right Buttons Panel.
 *
 * @package Benevolent
 */
?>
<div class="panel-right">
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'benevolent' ); ?></h4>
		<p><?php esc_html_e( 'The Pro version of the theme allows you to change the look and feel of the website with just a few clicks. You can easily change the color, background image and pattern as well as fonts of the website with the Pro version. Also, the Pro theme features more homepage sections than free version to allow you to showcase your organization services in a better way boosting the growth of the organization. Furthermore, the premium theme comes with multiple predefined page templates.', 'benevolent' ); ?></p>
		<p><?php esc_html_e( 'Also, the Pro version gets regular updates and has a dedicated support team to solve your queries.', 'benevolent' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/benevolent-pro/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'benevolent' ); ?>" target="_blank">
            <?php esc_html_e( 'Read more about the features here', 'benevolent' ); ?>
        </a>
	</div><!-- .panel-aside Theme Support -->
	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'benevolent' ); ?></h4>
		<p><?php esc_html_e( 'Need help with WordPress and our theme as quickly as possible? Visit our well-organized documentation.', 'benevolent' ); ?></p>
		<p><?php esc_html_e( 'Our documentation comes with a step-by-step guide from installing WordPress to customizing our theme to creating an attractive and engaging website.', 'benevolent' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/' . BENEVOLENT_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the knowledge base', 'benevolent' ); ?>" target="_blank"><?php esc_html_e( 'Visit the Knowledge Base', 'benevolent' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->