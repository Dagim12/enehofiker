<?php
/**
 * Displays footer site info
 *
 * @subpackage Fundraising Charity Campaign
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info py-4 text-center">
    <?php

      echo esc_html( get_theme_mod( 'ngo_charity_donation_footer_text' ) );
      printf(
          /* translators: %s: Charity Campaign WordPress Theme. */
          esc_html__( ' %s ', 'fundraising-charity-campaign' ),
          '<a target="_blank" href="' . esc_url( 'https://www.ovationthemes.com/wordpress/free-fundraising-wordpress-theme/') . '"> Charity Campaign WordPress Theme</a>'
      );
      ?>
</div>
