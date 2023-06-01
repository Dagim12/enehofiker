<?php
/**
 * Displays footer site info
 *
 * @subpackage NGO Charity Donation
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info py-4 text-center">
	<?php

        echo esc_html( get_theme_mod( 'ngo_charity_donation_footer_text' ) );
        printf(
            /* translators: %s: NGO Charity WordPress Theme. */
            esc_html__( ' %s ', 'ngo-charity-donation' ),
            '<a target="_blank" href="' . esc_url( 'https://www.ovationthemes.com/wordpress/free-ngo-charity-wordpress-theme/') . '"> NGO Charity WordPress Theme</a>'
        );
	?>
</div>
