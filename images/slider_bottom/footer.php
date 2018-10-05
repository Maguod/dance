
<div class="footer">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <?php $footer_logo = get_field('footer_logo', 'options'); ?>
                    <img src="<?php echo $footer_logo['url']; ?>" width="<?php echo $footer_logo['width']; ?>" height="<?php echo $footer_logo['height']; ?>" alt="<?php echo $footer_logo['alt']; ?>" />
                </div>
                <div class="catalog-title text-yellow text-center">Каталог:</div>
                <?php wp_nav_menu( array(
                    'items_wrap' => '<ul id="%1$s" class="catalog">%3$s</ul>',
                    'menu' => 'footer-catalog'
                  ));
                ?>
                <div class="catalog-title text-yellow text-center">Инфо:</div>
                <?php wp_nav_menu( array(
                    'items_wrap' => '<ul id="%1$s" class="catalog">%3$s</ul>',
                    'menu' => 'footer-info'
                  ));
                ?>
                <div class="text-center text-yellow">Контакты:</div>
                <div class="text-center text-yellow">Москва:</div>
                <ul class="contacts">
                    <li><?php the_field('office_adres_msk', 'option'); ?></li>
                    <li><a href="<?php the_field('phone_1', 'option'); ?>"><?php the_field('phone_1', 'option'); ?></a></li>
                    <li><a href="<?php the_field('phone_2', 'option'); ?>"><?php the_field('phone_2', 'option'); ?></a></li>
                    <li><a href="<?php the_field('email_spb', 'option'); ?>"><?php the_field('email_spb', 'option'); ?></a></li>
                </ul>

                <div class="text-center text-yellow">Санкт-Петербург:</div>
                <ul class="contacts_sankt">
                    <li><?php the_field('office_adres_spb', 'option'); ?></li>
                    <li><a href=""><?php the_field('phone_3', 'option'); ?></a></li>
                    <li><a href=""><?php the_field('phone_4', 'option'); ?></a></li>
                    <li><a href=""><?php the_field('email_spb', 'option'); ?></a></li>
                </ul>
                <p class="vertical top">Политика конфиденциальности</p>
                <p class="vertical bottom"><?php the_field('copyrights', 'options'); ?></p>
                <div class="social_icons">
                    <?php include( get_stylesheet_directory() . '/templates/global/social.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="button_top btn_show">
    <div class="img_box"><img src="/wp-content/themes/danceeffects/images/icons_logo/button_top.png" alt="To top"></div>
    <div class="button_content">Вернуться наверх</div>
</div>