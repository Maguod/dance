<?php get_header(); ?>
<?php 
  $my_post = wp_get_post_categories( $post->ID, array('fields' => 'all') ); 
  $image_parent_cat = get_term_meta($my_post[0]->term_taxonomy_id, 'id-cat-images', true);
?>
        <div class="main_bg " style="background-image: url(<?php echo wp_get_attachment_image_url( $image_parent_cat, 'full'); ?>)">
            <div class="container bg_content">
              <div class="row">
                  <div class="col-12">
                      <h1><span class="yellow"><?php echo $my_post[0]->name; ?></span></h1>
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

        <section class="card_item">
          <div class="container">
            <div class="row ">
              <div class="col-12">
                <div class="nav_menu">
                  <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                </div>
              </div>
            </div>

                <div class="product__cart row">
                  <div class="cart_img col-5">
                      <?php echo get_the_post_thumbnail('', 'large'); ?>
                  </div>
                  <div class="cart_content col-7">
                    <div class="cart_top">
                      <h2>
                        <?php echo $my_post[0]->name; ?>
                      </h2>
                    </div>
                    <div class="cart_bottom">
                      <h3>Цена в Москве:</h3>
                      <div class="sale left">
                        Продажа <span class="sale__price">100000</span> &#8381;
                      </div>
                      <div class="sale right">
                        Аренда <span class="sale__price">1000</span> &#8381;
                      </div>
                      <div class="btn_block white">
                          <button class="btn btn-default btn_white first" type="button">Заказать в один клик</button>
                          <button class="btn btn-default btn_white second" type="button">Добавить в корзину</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product__cart-info">
                  <ul class="menu">
                    <li>Параметры</li>
                    <li>Доставка / Монтаж</li>
                    <li>Оплата</li>
                  </ul>
                  <div class="product_info show">
                    <ul>
                      <li>Рабочее давление 6 - 8 Атм.</li>
                      <li>Зарядка ресивера: от компрессора</li>
                      <li>Дальность выстрела стадионного серпантина: 35-40 м</li>
                      <li>Дальность выстрела конфетти: 15-20 м</li>
                      <li>Максимальная загрузка до 3 кг</li>
                      <li>Вес: 33 кг</li>
                      <li>Упаковка: транспортировочный кофр 1500х1030х450мм</li>
                      <li>Емкость ресивера: 50 л</li>
                      <li>Диаметр ствола: 80 мм</li>
                    </ul>
                  </div>
                  <div class="product_info">
                    <ul>
                      <li>Рабочее давление 6 - 8 Атм.</li>
                      <li>Зарядка ресивера: от компрессора</li>
                      <li>Вес: 33 кг</li>
                      <li>Упаковка: транспортировочный кофр 1500х1030х450мм</li>
                      <li>Емкость ресивера: 50 л</li>
                      <li>Диаметр ствола: 80 мм</li>
                    </ul>
                  </div>
                  <div class="product_info">
                    <ul>
                      <li>Дальность выстрела стадионного серпантина: 35-40 м</li>
                      <li>Дальность выстрела конфетти: 15-20 м</li>
                      <li>Максимальная загрузка до 3 кг</li>
                      <li>Вес: 33 кг</li>
                      <li>Упаковка: транспортировочный кофр 1500х1030х450мм</li>
                      <li>Емкость ресивера: 50 л</li>
                      <li>Диаметр ствола: 80 мм</li>
                    </ul>
                  </div>
                </div>
          </div>
        </section>
        <?php get_template_part('inc/consultation'); ?>
        <section class="discription_cart">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <?php if(!is_null($my_post[0]->description)) {
                    echo $my_post[0]->description;
                    }
                  // var_dump($my_post); 
                ?>
              </div>
            </div>
          </div>
        </section>

<?php get_footer(); ?>