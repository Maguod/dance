<?php 

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails');
add_theme_support( 'widgets' );
add_theme_support('post-formats', array('aside', 'gallery'));

function theme_register_nav_menu() {
	register_nav_menu( 'top', 'Top_Menu' );
}
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function theme_name_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'style-bootstrap', get_template_directory_uri() . '/css/bootstrap_4.css' );
	wp_enqueue_style( 'style-flickity', get_template_directory_uri() . '/css/flickity.css' );
	wp_enqueue_style( 'style-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'style-my', get_template_directory_uri() . '/css/style.css' );

	// wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.js', array('jquery321'), '1.0.0', true );
	wp_enqueue_script( 'jquery321', get_template_directory_uri() . '/js/jquery321.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'fancy', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery321'), '1.0.0', true );
	// wp_enqueue_script( 'slider', get_template_directory_uri() . '/js/slider.js', array('jquery321'), '1.0.0', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery321'), '1.0.0', true );
}
/*для главной подключаю сладеры. Надо добавить еще галерею.*/
add_action('wp', 'add_my_script_where_it_necessery');
function add_my_script_where_it_necessery(){
	if( is_front_page())
		add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
}
function my_scripts_method() {
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.js', array('jquery321'), '1.0.0', true );
	wp_enqueue_script( 'slider', get_template_directory_uri() . '/js/slider.js', array('jquery321'), '1.0.0', true );
}



/**************************************
						Хлебные крошки
***************************************/
function kama_breadcrumbs( $sep = '  /  ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
										   // или можно указать свой массив разметки:
										   // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
									  // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
									  // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
									  // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="kama_breadcrumbs">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		// ну, с богом...
		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );                     
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num )
					$home_after = sprintf( $this->arg->title_patt, $pt_title );
				// singular, paged post_type_archive, tax
				else{
					$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

					$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

/**
 * Изменения:
 * 3.3 - новые хуки: attachment_tax_crumbs, post_tax_crumbs, term_tax_crumbs. Позволяют дополнить крошки таксономий.
 * 3.2 - баг с разделителем, с отключенным 'show_term_title'. Стабилизировал логику.
 * 3.1 - баг с esc_html() для заголовка терминов - с тегами получалось криво...
 * 3.0 - Обернул в класс. Добавил опции: 'title_patt', 'last_sep'. Доработал код. Добавил пагинацию для постов.
 * 2.5 - ADD: Опция 'show_term_title'
 * 2.4 - Мелкие правки кода
 * 2.3 - ADD: Страница записей, когда для главной установлена отделенная страница.
 * 2.2 - ADD: Link to post type archive on taxonomies page
 * 2.1 - ADD: $sep, $loc, $args params to hooks
 * 2.0 - ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 * 1.9 - ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 * 1.8 - FIX: заметки, когда в рубрике нет записей
 * 1.7 - Улучшена работа с приоритетными таксономиями.
 */

/*конец хлебные крошки*/


/****************************************
									Изменяем редактор рубрик \ категорий

!!!!!!!!!!!! Примечание! Для Woocomerce используйте хук product_cat_edit_form_fields.!!!!!!!!!!!!!!!!!!!!!!!!

******************************************/
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

function mayak_category_description($container = ''){
	$content = is_object($container) && isset($container->description) ? html_entity_decode($container->description) : '';
	$editor_id = 'tag_description';
	$settings = 'description';		
	?>
    <tr class="form-field">
	<th scope="row" valign="top"><label for="description">Описание</label></th>
	<td><?php wp_editor($content, $editor_id, array(
				'textarea_name' => $settings,
				'editor_css' => '<style>.html-active .wp-editor-area{border:0;}</style>',
	)); ?><br />
	<span class="description">Описание по умолчанию не отображается, однако некоторые темы могут его показывать.</span></td>
    </tr>
    <?php	
}
add_filter('edit_category_form_fields', 'mayak_category_description');
add_filter('edit_tag_form_fields', 'mayak_category_description');

/************
убираем стандартный редактор рубрик
**********/
function mayak_remove_category_description(){
	// $max_description;
 //    global $max_description;
 //    if ( $max_description->id == 'edit-category' or 'edit-tag' ){
    ?>
        <script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });
        </script>
    <?php
    // }
}
add_action('admin_head', 'mayak_remove_category_description');



/**********************************************
										Картинки для категорий === рубрик
***********************************************/
add_action( 'category_edit_form_fields', 'mayak_update_category_image' , 10, 2 ); 
function mayak_update_category_image ( $term, $taxonomy ) { 
?>
   <style>
   img{border:3px solid #ccc;}
   .term-group-wrap p{float:left;}
   .term-group-wrap input{font-size:18px;font-weight:bold;width:40px;}
   #bitton_images{font-size:18px;}
   #bitton_images_remove{font-size:18px;margin:5px 5px 0 0;}
   </style>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="id-cat-images">Изображение</label>
     </th>
     <td>
	   <p><input type="button" class="button bitton_images" id="bitton_images" name="bitton_images" value="+" /></br>
	   <input type="button" class="button bitton_images_remove" id="bitton_images_remove" name="bitton_images_remove" value="&ndash;" /></p>
       <?php $id_images = get_term_meta ( $term -> term_id, 'id-cat-images', true ); ?>
       <input type="hidden" id="id-cat-images" name="id-cat-images" value="<?php echo $id_images; ?>">
       <div id="cat-image-miniature">
         <?php if (empty($id_images )) { ?>
		 <img src="<?php bloginfo('template_url'); ?>/images/image__block/wp_logo.png" alt="WP_logo" width="84" height="89"/>
		 <?php } else {?>
           <?php echo wp_get_attachment_image ( $id_images, 'large' ); ?>
         <?php } ?>
       </div>
     </td>
   </tr>
<?php
}

if(preg_match("#tag_ID=([0-9.]+)#", $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']))
add_action( 'admin_footer', 'mayak_loader'  );
function mayak_loader() { ?>
   <script>
     jQuery(document).ready( function($) {
       function mayak_image_upload(button_class) {
         var mm = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var mb = '#'+$(this).attr('id');
           var mt = $(mb);
           mm = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if (mm) {
               $('#id-cat-images').val(attachment.id);
               $('#cat-image-miniature').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#cat-image-miniature .custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( mb, [props, attachment] );
             }
            }
         wp.media.editor.open(mt);
         return false;
       });
     }
     mayak_image_upload('.bitton_images.button'); 
     $('body').on('click','.bitton_images_remove',function(){
       $('#id-cat-images').val('');
       $('#cat-image-miniature').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     $(document).ajaxComplete(function(event, xhr, settings) {
       var mk = settings.data.split('&');
       if( $.inArray('action=add-tag', mk) !== -1 ){
         var mh = xhr.responseXML;
         $mr = $(mh).find('term_id').text();
         if($mr!=""){
           $('#cat-image-miniature').html('');
         }
       }
     });
   });
</script>
<?php }
/**********Заносим изменения в БД******************/
add_action( 'edited_category','mayak_updated_category_image' , 10, 2 );
function mayak_updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['id-cat-images'] ) && '' !== $_POST['id-cat-images'] ){
     $image = $_POST['id-cat-images'];
     update_term_meta ( $term_id, 'id-cat-images', $image );
   } else {
     update_term_meta ( $term_id, 'id-cat-images', '' );
   }
}

/*Для вывода */
function mayak_cats_images(){
$ags = array(
'taxonomy'=>'category',
'parent' => get_query_var('cat'),
'meta_query' => array(array('key' => 'id-cat-images',)),
);
$terms = get_terms($ags);
 $count = count($terms);
 if($count > 0){
	 echo '<div class="cat-thumbnail"><ul>';
	 foreach ($terms as $term) {
	 $term_taxonomy_id = $term->term_taxonomy_id;
	 $image_id = get_term_meta ( $term_taxonomy_id, 'id-cat-images', true );
	   echo '<li>
	   <a href="'.get_category_link($term_taxonomy_id).'">'.wp_get_attachment_image ( $image_id, 'thumbnail' ).'</a>
	   <a href="'.get_category_link($term_taxonomy_id).'">'.$term->name.'</a>
	   </li>';
	 }
	 echo '</ul></div>';
 }
}
/***************конец картинки для рубрик**********************/

/************************
 						*Выбираю шаблон для сингл страницы по категории. Шикарное решение!!!!!!!!!!!!!!!!!11*
 * **********************/
add_filter('single_template', 'my_single_template');

function my_single_template($single)
{
	global $wp_query, $post;
	foreach ((array)get_the_category() as $cat) {
		if (file_exists(get_template_directory() . '/single-' . $cat->slug . '.php')) {
			return get_template_directory() . '/single-' . $cat->slug . '.php';
		} elseif (file_exists('/single-' . $cat->term_id . '.php')) {
			return get_template_directory() . '/single-' . $cat->term_id . '.php';
		}
	}
	return $single;
}
/******************
					Задаю размер картинкам что бы использовать при выводе если нужно
*************************/
add_image_size( '540-300_thumb', 300, 540, false );

/****************************
							Shortcodes
********************************/

// add_shortcode( 'youtubeframe', 'my_iframe' );
// function my_iframe( $atts ){
// 	// белый список параметров и значения по умолчанию
// 	$atts = shortcode_atts( array(
// 		'width' => '560',
// 		'height' => '315',
// 		'id' => 'T9IYj2CBOuU'
// 	), $atts );

// 	return '<iframe width="'.$atts['width'].'px" height="'.$atts['height'].'px" src="https://www.youtube.com/embed/'.$atts['id'].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
// }



// использование: [iframe href="http://www.exmaple.com" height="480" width="640"]

/*Создаю свои тип записи галерея  и таксономию под нее*/

// add_action('init', 'my_custom_init');

// add_action('init', 'my_custom_init');
// function my_custom_init(){
// 	register_post_type('my_galary', array(
// 		'labels'             => array(
// 			'name'               => 'Галерея', // Основное название типа записи
// 			'singular_name'      => 'Галерея', // отдельное название записи типа Book
// 			'add_new'            => 'Добавить картинку',
// 			'add_new_item'       => 'Добавить картинку',
// 			'edit_item'          => 'Редактировать картинку',
// 			'new_item'           => 'Новая картинка',
// 			'view_item'          => 'Посмотреть картинку',
// 			'search_items'       => 'Найти картинку',
// 			'not_found'          =>  'Картинок не найдено',
// 			'not_found_in_trash' => 'В корзине картинок не найдено',
// 			'parent_item_colon'  => '',
// 			'menu_name'          => 'Галерея'
// 		  ),
// 		'public'             => true,
// 		'publicly_queryable' => true,
// 		'show_ui'            => true,
// 		'show_in_menu'       => true,
// 		'show_in_nav_menus'	 => true,
// 		'query_var'          => true,
// 		'rewrite'            => true,
// 		'capability_type'    => 'page',
// 		'has_archive'        => true,
// 		'hierarchical'       => true,
// 		'menu_position'      => 30,
// 		'supports'           => array('title','editor','thumbnail','excerpt')
		
// 	) );
// }


// хук для регистрации
// add_action('init', 'create_taxonomy');
// function create_taxonomy(){
	// список параметров: http://wp-kama.ru/function/get_taxonomy_labels
	// сама функция https://wp-kama.ru/function/register_taxonomy
	// register_taxonomy('category_my_galary', array('my_galary'), array(
	// 	'label'                 => '', // определяется параметром $labels->name
		// 'labels'                => array(
		// 	'name'              => 'Категории галереи',
		// 	'singular_name'     => 'Категория галереи',
		// 	'search_items'      => 'Поиск Каегории галереи',
		// 	'all_items'         => 'Все галереи',
		// 	'view_item '        => 'Просмотр Категория галереи',
		// 	'parent_item'       => 'Родительская Категория галереи',
		// 	'parent_item_colon' => 'Родительская Категория галереи:',
		// 	'edit_item'         => 'Редактировать Категория галереи',
		// 	'update_item'       => 'Обновить Категория галереи',
		// 	'add_new_item'      => 'Добавить новую Категория галереи',
		// 	'new_item_name'     => 'Новое имя Категория галереи',
		// 	'menu_name'         => 'Категория галереи',
		// ),
// 		'description'           => '', // описание таксономии
// 		'public'                => true,
// 		'publicly_queryable'    => true, // равен аргументу public
// 		'show_in_nav_menus'     => true, // равен аргументу public
// 		'show_ui'               => true, // равен аргументу public
// 		'show_in_menu'          => true, // равен аргументу show_ui
// 		'show_tagcloud'         => true, // равен аргументу show_ui
// 		// 'show_in_rest'          => true, // добавить в REST API
// 		// 'rest_base'             => true, // $taxonomy
// 		'hierarchical'          => true,
// 		'update_count_callback' => '',
// 		'rewrite'               => true,
// 		// 'query_var'             => $taxonomy, // название параметра запроса
// 		'capabilities'          => array(),
// 		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
// 		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
// 		'_builtin'              => false,
// 		'show_in_quick_edit'    => 'show_ui' // по умолчанию значение show_ui
// 	) );
// }
