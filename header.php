<!DOCTYPE html>
<html lang="ru" dir="ltr">

<head>
    <title>Dance Effect</title>
    <meta charset="<?php bloginfo('charset'); ?>">
<!--     <meta name="description" content="Содержимое">
    <meta name="keywords" content="ключевые слова"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

 <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="header">
    <div class="header_wrap">
      <div class="main_logo">
          <a href="<?php echo home_url() ?>">
            <img src="<?php bloginfo('template_url'); ?>/images/icons_logo/main_logo.png" alt="logo">
          </a>
      </div>
      <div class="container">
        <div class="row">
            <nav class="header__nav col-xs-10">
                    <?php 
                        $args = array(
                          'menu_class'      => 'menu menu_top',
                          'container'       => '', 
                        );
                        wp_nav_menu($args); ?>
            </nav>
            <div class="header__contact col-xs-2">
                <a href="" class="link_tel">+7 (812) 309-78-38 </a>
                <a href="6" class="link_tel">+7 (952) 203-97-16 </a>
                <a href="mailto:info@danceeffects.ru">info@danceeffects.ru</a>
            </div>
        </div>
      </div>
    </div>
  </div>
 
  