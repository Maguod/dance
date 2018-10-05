<?php
/*
Template Name: Home_page

*/
?>
<?php get_header(); ?>
    <div class="top-carousel-wrapper">
        <div class="carousel top_carousel">
            <div class="carousel-cell">

                <img src="<?php bloginfo('template_url'); ?>/images/bgImage/main_katalog_bg.jpg" alt="">

                <div class="overlay_block"></div>

                <div class="slider__content">
                <h1><span class="yellow">Спец</span>эффекты</h1>
                <div class="main_bg-text"><span class="yellow">Профессиональные спецэффекты для мероприятий и праздников</span></div>
                <a href="" class="btn btn__white">Подробнее</a>
                </div>

            </div>
            <div class="carousel-cell">

                <img src="<?php bloginfo('template_url'); ?>/images/bgImage/main_katalog_bg.jpg" alt="">

                <div class="overlay_block"></div>

                <div class="slider__content">
                <h2><span class="yellow">Спец</span>эффекты</h2>
                <div class="main_bg-text"><span class="yellow">Профессиональные спецэффекты для мероприятий и праздников</span></div>
                <a href="" class="btn btn__white">Подробнее</a>
                </div>

            </div>
            <div class="carousel-cell">

                <img src="<?php bloginfo('template_url'); ?>/images/bgImage/main_katalog_bg.jpg" alt="">

                <div class="overlay_block"></div>

                <div class="slider__content">
                    <h2><span class="yellow">Спец</span>эффекты</h2>
                    <div class="main_bg-text"><span class="yellow">Профессиональные спецэффекты для мероприятий и праздников</span></div>
                    <a href="" class="btn btn__white">Подробнее</a>
                </div>
                
            </div>
        </div>
        <div class="icon_top">
            <div class="container clearfix">
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
        <div class="icon_top-mouse">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/mouse_top.png" alt=""></a>
        </div>
    </div>

	<main class="main_content">
    <section class="main__catalog catalog_group">
      <div class="wrapper">
          <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
          <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <h2>Каталог</h2>
              </div> 
            </div>
            <div class="row">
                <?php $thisCat = get_category(get_query_var('cat'));
                $sub_cats = get_categories(array(
                    'child_of' => '33',
                    'hide_empty' => true,
                    'hierarchical' => true,
                    'number' => 4,
                    'orderby' => 'ID'
                ));
                if ($sub_cats) {
                    foreach ($sub_cats as $cat) {
                        $image_id = get_term_meta($cat->term_id, 'id-cat-images', true);
                        echo ' <div class="col-6 catalog_card">
                               <div class="img__box" style="background-image: url(' . wp_get_attachment_image_url($image_id, ' full ') . ')">
                                </div>
                                <div class="box__content"> 
                                <h2>' . $cat->name . '</h2>
                                <a href="' . get_category_link($cat->term_id) . '" class="btn btn__yellow">Подробнее</a>
                              </div></div>';

                    }

                    wp_reset_postdata(); 
                }
                ?>
            </div>
          </div>
          <div class="button no_after">
            <button class="more">Показать еще<span></span></button>
          </div>
      </div>
    </section>
    <section class="card_boxs novelties">
      <div class="wrapper line_yellow">
        <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2><span>Новинки</span></h2>
            </div>
          </div>
          <div class="row">
           <?php  $args = array( 
            'numberposts' => 3, 
            'orderby'=> 'date',
            'category'  => 29,
            'order'  => 'DESC',
            'post_type'   => 'post',
            'suppress_filters' => true);

            $myposts = get_posts( $args );
            global $post;
            // var_dump($myposts);
            foreach( $myposts as $post ){ setup_postdata($post);  ?>
            <div class="col-4">

               <a href="<?php the_permalink( $post ); ?>"> <div class="card_box">
                     <div class="img__box">
                       <img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="/">
                     </div>
                     <div class="content__box">
                         <div class="text__card">
                             <?php the_title(); ?>
                         </div>
                         <div class="sale">
                           <?php 
                             $meta_values_price = get_post_meta( $post->ID, 'Цена', true);
                             $meta_values_arenda = get_post_meta( $post->ID, 'Аренда', true);
                          
                           if($meta_values_price) {
                             echo '<div class="sale twice">
                               <span class="sale_title">Продажа</span> <span class="sale__price">'.$meta_values_price .'<b>&#8381;</b></span> 
                             </div>';
                           }
                           if($meta_values_arenda) {
                             echo '<div class="sale twice">
                               <span class="sale_title">Аренда</span> <span class="sale__price">'.$meta_values_arenda .'<b>&#8381;</b></span> 
                             </div>';
                           } ?>
                         </div>
                         <div class="btn_block">
                             <button class="btn btn_white first" type="button">В один клик</button>
                             <button class="btn btn_white second" type="button">В корзину</button>
                         </div>
                     </div>
                 </div>
               </a>
            </div>
           <?php } wp_reset_postdata(); ?>
          </div>
          <div class="button">
            <button class="more">Показать еще<span></span></button>
          </div>
        </div>
      </div>
    </section>
    <section class="card_boxs popular">
      <div class="wrapper line_yellow">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2><span>Популярное</span></h2>
            </div>
          </div>
          <div class="row">
           <?php  $args = array( 
            'numberposts' => 3, 
            'orderby'=> 'date',
            'category'  => [31, 10],
            'order'  => 'DESC',
            'post_type'   => 'post',
            'suppress_filters' => true);

            $myposts = get_posts( $args );
            global $post;
            // var_dump($myposts);
            foreach( $myposts as $post ){ setup_postdata($post);  ?>
            <div class="col-4">
              <a href="<?php the_permalink( $post ); ?>"> <div class="card_box">
              <div class="img__box">
                <img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="/">
                <div class="sale_stock">Акция</div>
              </div>
              <div class="content__box">
                   <div class="text__card">
                       <?php the_title(); ?>
                   </div>
                   <div class="sale">
                     <?php 
                       $meta_values_price = get_post_meta( $post->ID, 'Цена', true);
                       $meta_values_arenda = get_post_meta( $post->ID, 'Аренда', true);
                    
                     if($meta_values_price) {
                       echo '<div class="sale twice">
                         <span class="sale_title">Продажа</span> <span class="sale__price">'.$meta_values_price .'<b>&#8381;</b></span> 
                       </div>';
                     }
                     if($meta_values_arenda) {
                       echo '<div class="sale twice">
                         <span class="sale_title">Аренда</span> <span class="sale__price">'.$meta_values_arenda .'<b>&#8381;</b></span> 
                       </div>';
                     } ?>
                   </div>
                   <!-- <div><?php $n = CFS()->get('Цена'); echo $n; ?></div> -->
                   <div class="btn_block">
                       <button class="btn btn_white first" type="button">В один клик</button>
                       <button class="btn btn_white second" type="button">В корзину</button>
                   </div>
                  </div>
                </div>
              </a>
            </div>
           <?php } wp_reset_postdata(); ?>
          </div>

          </div>
          <div class="button">
            <button class="more">Показать еще<span></span></button>
          </div>
        </div>
    </section>
    <?php get_template_part('inc/consultation'); ?>
    <section class="about">
        <div class="about_wrap">
            <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="img_box">
                            <img src="<?php bloginfo('template_url'); ?>/images/image__block/about.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-7 offset-1">
                        <h2>О компании</h2>
                        <div class="text_content">
                            <p class="text">
                                <span class="bold">DanceEffects</span> - это компания опытных, образованных, энергичных профессионалов. За нашими плечами годы работы над техническим оформлением мероприятий самых разных масштабов и сложности, с российскими и зарубежными заказчиками и артистами, в Москве, Санкт-Петербурге и других городах России. Объединив в одну команду первоклассных специалистов, мы разработали новую систему стандартов качества в работе над проектами. Продуманные технические решения сложных задач, реализуемые Backstage, а также наше внимание к деталям, позволяют поднять мероприятие на новый, европейский, уровень в глазах клиентов, зрителей и участников события.
                            </p>
                            <p class="text">
                                <span class="bold">Условия доставки мебели в аренду</span> Предлагаем два варианта получения арендуемого оборудования: • Доставка нашими силами. • Самовывоз. В первом случае арендованную мебель по Москве и области привозим и забираем мы. Во втором — вы забираете со склада в Москве, при этом необходимо будет внести залог, его сумма зависит от объема арендуемого оборудования. Работаем в Москве и Санкт-Петербурге.
                            </p>
                            <p class="text">
                                Стоимость доставки Доставка текстиля и легковесной мебели и оборудования по Москве на легковом автомобиле стоит от 1000 рублей, грузовая доставка — от 2500 рублей. Цена зависит от общего объема и веса, места доставки, рассчитывается после оформления заказа, оплачивается в обе стороны. Стоимость разгрузочно-погрузочных работ не включена в стоимость доставки и оплачивается отдельно. Простой по вине заказчика оплачивается дополнительно. Стоимость разгрузочно-погрузочных работ зависит от общего объема и веса заказанного оборудования, дальности проносов, необходимости подъема на этаж и расчитывается после оформления заказа на сайте. Стоимость работы 1 грузчика составит от 1250 руб. Стоимость монтажа текстиля составляет 30% от стоимости проката за первые сутки. Стоимость отпаривание не включена в стоимость монтажа. Скидки на аренду мебели На прокат мебели действуют скидки: При длительной аренде — скидка от 50% цены проката мебели на вторые и последующие сутки. Цены на аренду более 5 суток обсуждаются индивидуально. Постоянным клиентам, крупным заказчикам и event-агентствам — специальные условия, скидки и бонусы.
                            </p>
                        </div>
                        <button class="more no_after">Развернуть<span></span></button>
                    </div>
                </div>
            </div>
            <!-- скрытый блок для кнопки -->
            <div class="container hidden-block">
                <div class="row">
                    <div class="col-4">
                        <div class="img_box">
                            <img src="<?php bloginfo('template_url'); ?>/images/image__block/about.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-7 col-offset-1">
                        <h2>О компании</h2>
                        <div class="text_content">
                            <p class="text">
                                <span class="bold">DanceEffects</span> - это компания опытных, образованных, энергичных профессионалов. За нашими плечами годы работы над техническим оформлением мероприятий самых разных масштабов и сложности, с российскими и зарубежными заказчиками и артистами, в Москве, Санкт-Петербурге и других городах России. Объединив в одну команду первоклассных специалистов, мы разработали новую систему стандартов качества в работе над проектами. Продуманные технические решения сложных задач, реализуемые Backstage, а также наше внимание к деталям, позволяют поднять мероприятие на новый, европейский, уровень в глазах клиентов, зрителей и участников события.
                            </p>
                            <p class="text">
                                <span class="bold">Условия доставки мебели в аренду</span> Предлагаем два варианта получения арендуемого оборудования: • Доставка нашими силами. • Самовывоз. В первом случае арендованную мебель по Москве и области привозим и забираем мы. Во втором — вы забираете со склада в Москве, при этом необходимо будет внести залог, его сумма зависит от объема арендуемого оборудования. Работаем в Москве и Санкт-Петербурге.
                            </p>
                            <p class="text">
                                Стоимость доставки Доставка текстиля и легковесной мебели и оборудования по Москве на легковом автомобиле стоит от 1000 рублей, грузовая доставка — от 2500 рублей. Цена зависит от общего объема и веса, места доставки, рассчитывается после оформления заказа, оплачивается в обе стороны. Стоимость разгрузочно-погрузочных работ не включена в стоимость доставки и оплачивается отдельно. Простой по вине заказчика оплачивается дополнительно. Стоимость разгрузочно-погрузочных работ зависит от общего объема и веса заказанного оборудования, дальности проносов, необходимости подъема на этаж и расчитывается после оформления заказа на сайте. Стоимость работы 1 грузчика составит от 1250 руб. Стоимость монтажа текстиля составляет 30% от стоимости проката за первые сутки. Стоимость отпаривание не включена в стоимость монтажа. Скидки на аренду мебели На прокат мебели действуют скидки: При длительной аренде — скидка от 50% цены проката мебели на вторые и последующие сутки. Цены на аренду более 5 суток обсуждаются индивидуально. Постоянным клиентам, крупным заказчикам и event-агентствам — специальные условия, скидки и бонусы.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /скрытый блок для кнопки -->
    <div class="map">
        <div class="map_block-yellow">
            <div class="content_map">
                <div class="logo"><a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/main_logo_black.png" alt=""></a></div>
                <div class="map_contact">
                    <ul class="contacts">
                        <li>Москва:</li>
                        <li>Остаповский проезд, д.15</li>
                        <li><a href="" class="link_tel">+7 (499) 350-55-36</a></li>
                        <li><a href="mailto:msk@danceeffects.ru">msk@danceeffects.ru</a></li>
                    </ul>
                    <ul class="contacts_sankt">
                        <li>Санкт-Петербург:</li>
                        <li>Транспортный пер, д.6 (м. Лиговский проспект)</li>
                        <li><a href="" class="link_tel">+7 (812) 309 78 38</a></li>
                        <li><a href="" class="link_tel">+7 (952) 203-97-16</a></li>
                        <li><a href="mailto:info@danceeffects.ru">info@danceeffects.ru</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-carousel-bottom">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2>Наши клиенты</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="carousel_bottom">
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/alfaromeo.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/2.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/3.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/4.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/5.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/6.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/alfaromeo.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/2.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/3.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/4.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/5.png" alt=""></div>
              <div class="carousel-cell"><img src="<?php bloginfo('template_url'); ?>/images/slider_bottom/6.png" alt=""></div>
            </div>
          </div>
        </div>
    </div>
    <section class="news">
        <div class="wrapper">
            <img src="<?php bloginfo('template_url'); ?>/images/image__block/catalog_bg.png" alt="">
            <div class="container">
              <div class="row">
                <?php 
                global $post;
                $news_cat = get_category(4); 
                $posts_news = get_posts( array(
                  'numberposts' => 2,
                  'category_name'    => 'news',
                  'orderby'     => 'date',
                  'order'       => 'DESC',
                  'include'     => array(),
                  'exclude'     => array(),
                  'meta_key'    => '',
                  'meta_value'  =>'',
                  'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) ); 

                echo '<div class="col-12">
                  <h2><span>'. $news_cat->name .'</span></h2></div>';

                  
                foreach( $posts_news as $post ){ setup_postdata($post);   ?>
                <div class="col-6 news_block">
                  <div class="date"><?php echo get_the_date('j F Y ', $post->ID); ?></div>
                  <div class="img_box">
                    <div class="img_bg">
                      <?php echo get_the_post_thumbnail( $post->ID, 'large'); ?>
                    </div>
                    <img src="<?php bloginfo('template_url'); ?>/images/icons_logo/news_instagram.png" alt="" class="abs">
                    <a href="<?php the_permalink( $post ); ?>" class="btn btn__yellow">Подробнее</a>
                  </div>
                  <div class="content">
                    <a href="<?php the_permalink( $post ); ?>">TELECOM&amp;MEDIA 2018 BIG WINE DAY MOSCOW</a>
                  </div>
                </div>


                <?php } wp_reset_postdata(); // сброс ?>
                
              </div>
            </div>
        </div>
    </section>
    <div class="button_to_top">
        <div class="img_box"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/button_top.png" alt="To top"></div>
        <div class="button_content">Вернуться наверх</div>
    </div>
  </main>


<?php get_footer(); ?>
	