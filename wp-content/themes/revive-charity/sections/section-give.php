<?php
/**
 * Give Section
 * 
 * @package Revive_Charity
 */

$section_title  = get_theme_mod( 'revive_charity_give_section_title' );
$content        = get_theme_mod( 'revive_charity_give_section_content' );
$readmore       = get_theme_mod( 'benevolent_button_text', __( 'Donate Now', 'revive-charity' ) );// From 
$excerpt_option = give_get_option( 'disable_forms_excerpt' );
$form_id = '';
 
$give_query = new WP_Query( array( 
    'post_type'           => 'give_forms',
    'post_status'         => 'publish',
    'posts_per_page'      => -1,
    'ignore_sticky_posts' => true,   
) );

if( $section_title || $content || $give_query->have_posts() ){ ?>
    <div class="container">
        <?php if( $section_title || $content ){ ?>
            <header class="header">
                <?php 
                    if( $section_title ) echo '<h2 class="main-title">' . esc_html( $section_title ) . '</h2>';
                    if( $content ) echo wpautop( wp_kses_post( $content ) );
                ?>
            </header>
        <?php }
        $total_posts = $give_query->found_posts;
        if( $give_query->have_posts() ){ ?>    
            <div class="give-holder">
                <?php 
                    echo ( $total_posts > 3 ) ? '<div class="give-slider owl-carousel">' : '<div class="row">'; 
                    
                    while( $give_query->have_posts() ){
                        $give_query->the_post();
                        $form_id = get_the_ID();

                        echo ( $total_posts > 3 ) ? '<div>' : '<div class="columns-3">'; ?>
                    
                        <div class="post">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'revive-charity-give', array( 'itemprop' => 'image' ) );
                                }else{
                                    benevolent_get_fallback_svg( 'revive-charity-give' );
                                } ?>
                            </a>
                            <div class="text-holder">
                                <header class="entry-header">
                                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </header>
                                <div class="entry-content">
                                    <?php 
                                
                                        the_excerpt();

                                        $goal_stats = give_goal_progress_stats( $form_id );
                                        //Output the goal
                                        $goal_option = get_post_meta( $form_id, '_give_goal_option', true );
                                        $goal_format = get_post_meta( $form_id, '_give_goal_format', true );
                                        $currency_symbol = give_currency_symbol();

                                        if ( $goal_option == 'enabled' ) {

                                            if($goal_format == 'percentage'){
                                                $shortcode = '[give_goal id="' . $form_id . '" show_text="true" ]';
                                                echo do_shortcode( $shortcode );
                                            }
                                            if($goal_stats['raw_actual'] || $goal_stats['raw_goal']){ ?>
                                                <div class="cc-goal-raise">
                                                    <div class="goal-wrapper">
                                                        <div class="cc-goal"><?php echo esc_html__('Goal: ','revive-charity'); ?><span><?php echo esc_html( $currency_symbol . $goal_stats['raw_goal']); ?></span></div>
                                                        <div class="cc-raise"><?php echo esc_html__('Raised: ','revive-charity'); ?><span><?php echo esc_html( $currency_symbol . $goal_stats['raw_actual']); ?></span></div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        
                                        <?php } ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-donate"><?php echo esc_html( $readmore ); ?></a>
                            </div>
                        </div>
                        <?php
                        echo ( $total_posts > 3 ) ? '</div>' : '</div>';
                    }
                    wp_reset_postdata();
                    
                echo ( $total_posts > 3 ) ? '</div>' : '</div>'; 
                ?>
            </div>
        <?php } ?>
    </div> <!-- container -->
<?php }