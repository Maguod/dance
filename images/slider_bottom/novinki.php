<?php
/**
 * The Template for displaying 'new' tag
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<!-- novinki -->
<section class="popular also_order">
  <div class="wrap">
    <img src="/wp-content/themes/danceeffects/images/image__block/catalog_bg.png" alt="">
    <h2>Новинки</h2>
    <div class="container">
        <div class="row">
            <?php

                $post_type = 'product';
                $tag = "new";
                $start_count = 3;
                $count = 6;

                $args = array(
					'post_type' => $post_type,
					'posts_per_page' => $start_count,
                    'paged' => get_query_var( 'paged' ),
                    "product_tag" => $tag,
                );
                $pargs = array(
					'post_type' => $post_type,
					'posts_per_page' => $count,
                    'paged' => get_query_var( 'paged' ),
                    "product_tag" => $tag,
                );
                
                $products = new WP_Query( $args );

                $pages = new WP_Query( $pargs );
                
            ?>

            <?php if ( $products->have_posts() ) : while ( $products->have_posts() ) : $products->the_post();

                global $product;
                
				$p_link = get_permalink();
				$link = esc_url( $product->add_to_cart_url() );
				$btn_add_to_cart = apply_filters('add_to_cart_text', __('В корзину', 'woocommerce'));
                
            ?>

                <div class="col-xs-4">
                    <div class="popular_card">
                        <div class="img__box">
                            <a href="<?php echo $p_link; ?>" rel="nofollow">
                                <?php the_post_thumbnail('shop_cats', array("alt" => get_the_title(), "class" => '')); ?>
                            </a>
                        </div>
                        <div class="content__box">

                            <a href="<?php echo $p_link; ?>" class="text__card"><?php the_title(); ?></a>

                            <div class="price-wrapper">
                                <?php include( get_stylesheet_directory() . '/woocommerce/inc/card-price.php'); ?>
                            </div>

                            <div class="btn_block white">
                                <?php include( get_stylesheet_directory() . '/woocommerce/inc/add-to-cart.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php endwhile; ?>
            
            <div class="<?php echo $post_type; ?>-<?php echo $tag; ?>-container"></div>
            
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
      </div>
    </div>
    <div class="button more-link">
        <button class="more load-more" 
            data-action="get_<?php echo $post_type; ?>s" 
            data-type="<?php echo $post_type; ?>"
            data-tag="<?php echo $tag; ?>"
            data-startoffset="<?php echo $start_count; ?>"
            data-offset="<?php echo $start_count; ?>"
            data-count="<?php echo $count; ?>"
            data-target="<?php echo $post_type; ?>-<?php echo $tag; ?>-container"
            data-pages="<?php echo $pages->max_num_pages; ?>"
            data-page="1"
        >Показать ещё<span></span></button>
    </div>
  </div>
</section>
<!--/ end novinki -->