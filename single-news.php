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
   <!-- get_the_post_thumbnail_url( '', 'large' ) -->
        <section class="news_item m-t">
          <div class="container">
            <div class="row ">
              <div class="col-12">
                <div class="nav_menu">
                  <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>
                </div>
              </div>
            </div>
            <div class="col-12">
              <h2>
                <?php echo $post->post_title; ?>
              </h2>
            </div>
            <div class="col-2 offset-2">
              <?php echo get_the_date('j F Y', $post->ID); ?>
            </div>
            <div class="cart_news col-8 offset-2">
                <?php echo get_the_post_thumbnail('', 'full'); ?>
            </div>

              <div class="news_content col-8 offset-2">
                <?php echo $post->post_content; ?>
              </div>  

              </div>
            </div>
          </div>
               
          </div>
        </section>
        <?php get_template_part('inc/consultation'); ?>
        <section class="card_boxs">
          <div class="container">
            <div class="row">
              <?php 
              $my_args = array(
                'cat' => array(21,11,16),
                'posts_per_page' => 6,
                'orderby' => 'rand',
              );
              $query = new WP_Query($my_args);
              // print_r($query);
              if ($query->have_posts()) {
                while ($query->have_posts()) {
                  $query->the_post(); ?>
                    <div class="col-4">
                      <a href="<?php the_permalink($post); ?>">
                      <div class="card_box">
                        <div class="img__box">
                          <img src="<?php the_post_thumbnail_url('full'); ?>" alt="/">
                        </div>
                        <div class="content__box">
                          <div class="text__card">
                              <?php the_title(); ?>
                          </div>
                          <div class="sale">
                            <?php 
                            $meta_values_price = get_post_meta($post->ID, 'Цена', true);
                            $meta_values_arenda = get_post_meta($post->ID, 'Аренда', true);

                            if ($meta_values_price) {
                              echo '<div class="sale twice">
                                <span class="sale_title">Продажа</span> <span class="sale__price">' . $meta_values_price . '<b>&#8381;</b></span> 
                              </div>';
                            }
                            if ($meta_values_arenda) {
                              echo '<div class="sale twice">
                                <span class="sale_title">Аренда</span> <span class="sale__price">' . $meta_values_arenda . '<b>&#8381;</b></span> 
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

                <?php }};
                 wp_reset_postdata(); // сброс
                ?>
            </div>
          </div>
        </section>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
