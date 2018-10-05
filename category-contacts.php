<?php get_header(); ?>
  <!-- block contact information -->
    <section class="contact_block m-t">
      <div class="container">
        <div class="row">
          <div class="col-12">
             <div class="nav_menu">
              <a href="index.html">Главная </a> / <span>Контакты </span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h1>Контакты</h1>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <h2><span>Москва</span> :</h2>
          </div>
          
          <div class="col-2 offset-1">
            <div class="contact_content">
              <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact1.png" alt=""></span>телефон</p>
              <p class="text">+7 (499) 350-55-36</p>
            </div>
          </div>
          <div class="col-2 offset-2">
              <div class="contact_content">
                <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact2.png" alt=""></span>e-mail:</p>
                <p class="text"><a href="mailto:msk@danceeffects.ru" class="text">msk@danceeffects.ru</a></p>
              </div>
          </div>
          <div class="col-3 offset-2">
            <div class="contact_content">
              <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact3.png" alt=""></span>Адрес:</p>
              <p class="text">Остаповский проезд, д.15</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h2><span>Санкт-Петербург</span>:</h2>
          </div>
          
          <div class="col-2 offset-1">
            <div class="contact_content">
              <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact1.png" alt=""></span>телефон</p>
              <p class="text">+7 (812) 309-78-38</p>
              <p class="text">+7 (952) 203-97-16</p>
            </div>
          </div>
          <div class="col-2 offset-2">
            <div class="contact_content">
              <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact2.png" alt=""></span>e-mail:</p>
              <p class="text"><a href="mailto:info@danceeffects.ru" class="text">info@danceeffects.ru</a></p>
            </div>
          </div>
          <div class="col-3 offset-2">
            <div class="contact_content">
              <p class="contact_top"><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact3.png" alt=""></span>Адрес:</p>
              <p class="text">Транспортный пер, д.6 (м. Лиговский проспект)</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="social__icon-contact">
              <h4><span class="icon"><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/contact_social.png" alt=""></span>соцсети:</h4>
              <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/vk.png" alt="VK"></a>
              <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/youtube.png" alt="youtube"></a>
              <a href=""><img src="<?php bloginfo('template_url'); ?>/images/icons_logo/instagram.png" alt="instagram"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <sec class="the_content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php echo category_description(); ?>
          </div>
        </div>
      </div>
    </sec>
  <!-- / block contact information -->

  <!-- map section  -->
    <div class="map-section">
      <ul class="region_links">
        <li  class="target"><a href="">Санкт - Петербург</a></li>
        <li><a href="" class="tab">Москва</a></li>
      </ul>
      <div class="map-region spb visible-block"></div>
      <div class="map-region msk"></div>
    </div>
  <!-- / map section  -->

  <?php get_footer(); ?>