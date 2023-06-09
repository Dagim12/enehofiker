<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revive_Charity
 */
$read_more      = get_theme_mod( 'benevolent_give_button_label', __( 'Donate Now', 'revive-charity' ) );
$excerpt_option = give_get_option( 'disable_forms_excerpt' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
    <?php 
        if( has_post_thumbnail() ){
            echo '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">';
            the_post_thumbnail( 'revive-charity-donation-post', array( 'itemprop' => 'image' ) );
            echo '</a>' ; 
        }
    ?>    
    <div class="text-holder">
        <header class="entry-header">
            <?php the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php 
            if( $excerpt_option !== 'on' ){
                if( has_excerpt() ){
                    the_excerpt();    
                }else{
                    //Output the content
                    $content_option = get_post_meta( get_the_ID(), '_give_content_option', true );
                    if ( $content_option != 'none' ) {
                        $content = get_post_meta( get_the_ID(), '_give_form_content', true );
                        echo wpautop( wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 20, '&hellip;' ) ) );
                    }
                }
            }?>
        </div>
        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="btn-donate"><?php echo esc_html( $read_more ); ?></a>
        </footer><!-- .entry-footer -->        
    </div>
</article><!-- #post-## -->