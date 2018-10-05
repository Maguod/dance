 <?php get_header(); ?>
<?php 
  $thisCat = get_category( get_query_var('cat') );
 
  $image_cat = get_term_meta($thisCat->term_id, 'id-cat-images', true);
  $count = 0;

    $sub_cats = get_categories( array(
        'child_of' => $thisCat->term_id,
        'hide_empty' => true,
        'hierarchical' => 1,
        'number'        => 4,
        'orderby'   => 'id',
        'parent' => $thisCat->term_id /*Вот то что искал - параметр вложенности потомков, только
                                              надо было текуший ID указать*/
      ) ); 
  ?>
        <div class="main_bg " style="background-image: url(<?php echo wp_get_attachment_image_url( $image_cat, 'full'); ?>)">
            <div class="container bg_content">
              <div class="row">
                  <div class="col-12">
                      <h1><span class="yellow"><?php single_cat_title( '', 1); ?></span></h1>
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

       <section class="main__catalog catalog m-t">
          <!-- <?php  echo print_r($thisCat); ?> -->
          <div class="wrapper">

            <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
            <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
            <div class="container">
              <div class="row ">
                <div class="col-12">
                  <div class="nav_menu">
            	      <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                 <?php 
                 if( have_posts() ){ while( have_posts() && $count < 6 ){ the_post(); ?>
                  <div class="col-4">
                    <a href="<?php echo get_permalink(); ?>">
                      <div class="card_box">
                        <div class="img__box">
                          <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="/">
                        </div>
                        <div class="content__box">
                            <div class="text__card">
                                <?php the_title(); ?>
                            </div>
                            <div class="sale">
                                <span class="sale_title">Аренда</span> <span class="sale__price">10000 <b>&#8381;</b></span> 
                            </div>
                            <div class="btn_block white">
                                <button class="btn btn-default btn_white first" type="button">В один клик</button>
                                <button class="btn btn-default btn_white second" type="button">В корзину</button>
                            </div>
                             <?php echo $count  ?>
                        </div>
                      </div>
                    </a>
                  </div>
                 <?php $count += 1; wp_reset_postdata(); } } ?>
              </div>
            </div> 
          </div>
        </section>


      <?php get_template_part('inc/consultation'); ?>
      <section class="more_info">
        <div class="container">
          <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
          <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
          <div class="row">
            <div class="col-4">
            <div class="img_wrap">
              <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-1.jpg" alt=""></div>
              <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-2.jpg" alt=""></div>
            </div>  
                
            </div>
            <div class="col-7 offset-1">
              <div class="text_content gray-block">
                  <?php echo category_description($thisCat->term_id); ?>
                <p class="text">
                  <span class="bold">Условия доставки мебели в аренду</span>
                  Предлагаем два варианта получения арендуемого оборудования:
                </p>
                <ul>
                  <li>Доставка нашими силами.</li>
                  <li>Самовывоз.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7">
              <h2>Подробнее о спецэффектах</h2>
              <div class="text_content">
                <p class="text">
                  <span class="bold">DanceEffects</span> - это компания опытных, образованных, энергичных профессионалов. За нашими плечами годы работы над техническим оформлением мероприятий самых разных масштабов и сложности, с российскими и зарубежными заказчиками и артистами, в Москве, Санкт-Петербурге и других городах России. 
                  Объединив в одну команду первоклассных специалистов, мы разработали новую систему стандартов качества в работе над проектами. Продуманные технические решения сложных задач, реализуемые Backstage, а также наше внимание к деталям, позволяют поднять мероприятие на новый, европейский, уровень в глазах клиентов, зрителей и участников события.
                </p>
                <p class="text">
                  <span class="bold">Условия доставки мебели в аренду</span>
                  Предлагаем два варианта получения арендуемого оборудования:
                </p>
                <ul>
                  <li>Доставка нашими силами.</li>
                  <li>Самовывоз.</li>
                </ul>
              </div>
            </div>
            <div class="col-4 offset-1 img_block">
              <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-3.jpg" alt=""></div>
              <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-4.jpg" alt=""></div>
            </div>
          </div>
        </div>
      </section>
      <section class="child_caterogy">
        <div class="container">
          <div class="row">
              <div class="col-12">
                <div class="subcateg">
                    <?php
                    if (count(get_categories('child_of='.$cat)))
                    if (is_category()) {
                    $current_cat=get_query_var('cat');
                    
                    wp_list_categories('child_of='.$current_cat.'&title_li=&show_count=1');} ?>
                </div>
              </div>
          </div>
          
        </div>
      </section>
<?php get_footer(); ?>