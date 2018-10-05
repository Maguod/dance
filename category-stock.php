<?php get_header(); ?>
<?php 
$thisCat = get_cat_ID('Акции');
$image_cat = get_term_meta($thisCat, 'id-cat-images', true); ?>

  <div class="main_bg" style="background-image: url(<?php echo wp_get_attachment_image_url($image_cat, 'full'); ?>)">

      <div class="container bg_content">
        <div class="row">
            <div class="col-12">
                <h1><span class="yellow"><?php single_cat_title('', 1); ?></span></h1>
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

  <main class="main main_news">
    <section class="news m-t news_page">
      <div class="container">
       <div class="row">
         <div class="col-12">
            <div class="nav_menu">
            	<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
           </div>
         </div>
       </div>
      </div>
      <div class="wrapper">
        <img src="images/image__block/catalog_bg.png" alt="">
        <div class="container">
          <div class="row">
          	<?php
	          $args = array( 'category_name' => 'stock', 'numberposts' => 4);
	          $myposts = get_posts( $args );
	          foreach( $myposts as $post ){ setup_postdata($post);  ?>

				<div class="col-6 news_block">
					<a href="<?php echo get_permalink($post->ID); ?>">
						<div class="date"><?php echo get_the_date(); ?></div>
						<div class="img_box">
		                <div class="img_bg" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
		                	
		                </div>
	
		                <img src="<?php bloginfo('template_url'); ?>/images/icons_logo/news_instagram.png" alt="" class="abs">
	
		                <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn__yellow">Подробнее</a>
	
		                </div>
		                <div class="content">
		                   <a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a>
		                   <?php echo $post->ID; ?>
		                </div>
		            </a>
				</div>

            <?php }wp_reset_postdata(); ?>
        </div>
        <div class="button no_after">
          <button class="more">Показать eще<span></span></button>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
