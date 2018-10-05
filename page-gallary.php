<?php 
/* Template Name: Галерея */ 
?>

<?php get_header(); ?>

        <div class="main_bg " style="background-image: url(<?php echo get_the_post_thumbnail_url( 326, 'full' ); ?>)">
          <div class="container bg_content">
              <div class="row">
                  <div class="col-12">
                      <h1><span class="yellow"><?php wp_title('', true); ?></span></h1>
                  </div>
              </div>
            </div>
            <div class="icon_top">
            <div class="container ">
              <div class="social__icon-top">
                <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/vk.png" alt="VK"></a>
                <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/youtube.png" alt="youtube"></a>
                <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/instagram.png" alt="instagram"></a>
              </div>
              <div class="bag_top">
                  <img src="<?php bloginfo('template_url'); ?>/images/icons_logo/shopping-cart.png" alt="">
                  <span class="price_box">(<span>0</span>)</span>
              </div>
            </div>
          </div>
        </div>
    <section class="gallaty_block m-t">
      <div class="container">
        <div class="row ">
          <div class="col-12">
            <div class="nav_menu">
              <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
            </div>
          </div>
        </div>

        <div class="row">
          <ul class="col-4 gallary_theme">
            <li class="menu_gallary">Все категории
              <ul class="drop_gallary">
                <li><a href="">Генераторы конфетти</a></li>
                <li><a href="">Пневматические пушки конфетти</a></li>
                <li><a href="">Криоэффекты</a></li>
                <li><a href="">Генераторы мыльных пузырей</a></li>
                <li><a href="">Генераторы дыма</a></li>
                <li><a href="">Ветродуи, сценические вентиляторы</a></li>
                <li><a href="">Генераторы снега</a></li>
                <li><a href="">Генераторы пены</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="wrapper">
        <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
        <div class="container fancybox">
          <div class="row imglist">
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/bgImage/stock_bg.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img1.jpg" alt=""></a>
            </div>
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/bgImage/speceffect.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img2.jpg" alt=""></a>
            </div>
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/bgImage/gallary_bg.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img3.jpg" alt=""></a>
            </div>
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img2.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img1.jpg" alt=""></a>
            </div>
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img3.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img2.jpg" alt=""></a>
            </div>
            <div class="col-4">
              <a href="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img1.jpg" data-fancybox="images"><img src="<?php bloginfo('template_url'); ?>/images/image__block/gallaty_img3.jpg" alt=""></a>
            </div>
          </div>
<!--           <div class="button no_after"><button class="more fancybox">Показать еще <span></span></button></div> -->
        </div>
      </div>
    </section>

<?php get_footer(); ?>