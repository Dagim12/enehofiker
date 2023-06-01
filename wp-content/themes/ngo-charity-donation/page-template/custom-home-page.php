<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
    <section id="slider">
      <span class="design-right"></span>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <?php
          for ( $ngo_charity_donation_i = 1; $ngo_charity_donation_i <= 4; $ngo_charity_donation_i++ ) {
            $ngo_charity_donation_mod =  get_theme_mod( 'ngo_charity_donation_post_setting' . $ngo_charity_donation_i );
            if ( 'page-none-selected' != $ngo_charity_donation_mod ) {
              $ngo_charity_donation_slide_post[] = $ngo_charity_donation_mod;
            }
          }
           if( !empty($ngo_charity_donation_slide_post) ) :
          $ngo_charity_donation_args = array(
            'post_type' =>array('post'),
            'post__in' => $ngo_charity_donation_slide_post
          );
          $ngo_charity_donation_query = new WP_Query( $ngo_charity_donation_args );
          if ( $ngo_charity_donation_query->have_posts() ) :
            $ngo_charity_donation_i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $ngo_charity_donation_query->have_posts() ) : $ngo_charity_donation_query->the_post(); ?>
          <div <?php if($ngo_charity_donation_i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
            <div class="carousel-caption text-center text-md-left text-sm-left">
              <h2 class="slider-title"><?php the_title();?></h2>
              <p class="mb-0"><?php echo esc_html(wp_trim_words(get_the_content(),'20') );?></p>
              <div class="home-btn text-center text-md-left text-sm-left my-4">
                <a class="py-3 px-4" href="<?php the_permalink(); ?>"><i class="fas fa-heart mr-2"></i><?php echo esc_html('DONATE NOW','ngo-charity-donation'); ?></a>
              </div>
            </div>
          </div>
          <?php $ngo_charity_donation_i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>

  <section id="volunteer" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 align-self-center">
          <?php if( get_theme_mod('ngo_charity_donation_volunteer_title') != '' ){ ?>
            <h3 class="mb-4 text-center text-md-left"><?php echo esc_html(get_theme_mod('ngo_charity_donation_volunteer_title','')); ?></h3>
          <?php }?>
          <?php if( get_theme_mod('ngo_charity_donation_volunteer_btn_link') != '' || get_theme_mod('ngo_charity_donation_volunteer_btn_text') != ''){ ?>
            <p class="donate_btn mb-md-0 text-center text-md-left"><a href="<?php echo esc_url(get_theme_mod('ngo_charity_donation_volunteer_btn_link','')); ?>"><i class="fas fa-heart mr-2"></i><?php echo esc_html(get_theme_mod('ngo_charity_donation_volunteer_btn_text','')); ?></i></a></p>
          <?php }?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 align-self-center">
          <div class="row">

            <?php $ngo_charity_donation_volunteer = get_theme_mod('ngo_charity_donation_volunteer_increament');

            for ($ngo_charity_donation_i=1; $ngo_charity_donation_i <= $ngo_charity_donation_volunteer; $ngo_charity_donation_i++) { ?>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="volunteer-box mb-3">
                  <div class="volunteer-inner-box text-center text-md-left">
                    <?php if( get_theme_mod('ngo_charity_donation_volunteer_box_icon'.$ngo_charity_donation_i) != '' ){ ?>
                      <i class="<?php echo esc_html(get_theme_mod('ngo_charity_donation_volunteer_box_icon'.$ngo_charity_donation_i)); ?> mb-3 mt-5"></i>
                    <?php }?>
                    <?php if( get_theme_mod('ngo_charity_donation_volunteer_box_number'.$ngo_charity_donation_i) != '' ){ ?>
                      <p><?php echo esc_html(get_theme_mod('ngo_charity_donation_volunteer_box_number'.$ngo_charity_donation_i)); ?></p>
                    <?php }?>
                    <?php if( get_theme_mod('ngo_charity_donation_volunteer_box_title'.$ngo_charity_donation_i) != '' ){ ?>
                      <h4><?php echo esc_html(get_theme_mod('ngo_charity_donation_volunteer_box_title'.$ngo_charity_donation_i)); ?></h4>
                    <?php }?>
                  </div>
                </div>
              </div>

            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
