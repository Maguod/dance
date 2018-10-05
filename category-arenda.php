 <?php get_header(); ?>
<?php 
  $thisCat = get_category( get_query_var('cat') );
  // echo print_r($thisCat);
  $image_cat = get_term_meta($thisCat->term_id, 'id-cat-images', true);

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
                      if( $sub_cats ){
                        foreach( $sub_cats as $cat ){
                        $image_id = get_term_meta($cat->term_id, 'id-cat-images', true);
                       echo ' <div class="col-6 catalog_card">
                               <div class="img__box">'
                                .wp_get_attachment_image($image_id, 'full').
                              '</div>
                              <div class="box__content"> 
                              <h2>'.$cat->name.'</h2>
                              <h3>'.$thisCat->name.'</h3>
                              <a href="'. get_category_link($cat->term_id) .'" class="btn btn__yellow">Подробнее</a>
                              </div></div>' ;

                            }

                        wp_reset_postdata(); // сбрасываем глобальную переменную пост
                      }
                      /*Было так, вывод картинки без БГ 
                      if( $sub_cats ){
                        foreach( $sub_cats as $cat ){
                        $image_id = get_term_meta($cat->term_id, 'id-cat-images', true);
                       echo ' <div class="col-6 catalog_card">
                               <div class="img__box">'
                                .wp_get_attachment_image($image_id, 'full').
                              '</div>
                              <div class="box__content"> 
                              <h2>'.$cat->name.'</h2>
                              <h3>'.$thisCat->name.'</h3>
                              <a href="'. get_permalink() .'" class="btn btn__yellow">Подробнее</a>
                              </div></div>' ;

                    }

                        wp_reset_postdata(); */
                    ?>
               
              </div>
              <div class="button no_after">
                <button class="more">Показать еще<span></span></button>
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
                  <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-1.jpg" alt=""></div>
                  <div class="info_img-box"><img src="<?php bloginfo('template_url'); ?>/images/image__block/more_info-2.jpg" alt=""></div>
              </div>
              <div class="col-7 offset-1">
                <h2>Подробнее о декорациях</h2>
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
<?php get_footer(); ?>