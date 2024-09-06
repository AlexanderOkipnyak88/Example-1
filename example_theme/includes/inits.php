<?php
function my_theme_custom_upload_mimes($existing_mimes)
{
	// Add webm to the list of mime types. $existing_mimes['webm'] = 'video/webm';
	// Return the array back to the function with our added mime type.
	$existing_mimes['svg'] = 'image/svg';
	return $existing_mimes;
}
add_filter('upload_mimes', 'my_theme_custom_upload_mimes');

add_action('after_setup_theme', 'lr_setup');
function lr_setup()
{
	load_theme_textdomain('lr', get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('responsive-embeds');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array('search-form', 'navigation-widgets'));
	add_theme_support('woocommerce');

	/***************************
	 * Add custom logo
	 ***************************/
	add_theme_support('custom-logo', array(
		'height'      => 89,
		'width'       => 411
	));
	register_nav_menus(array(
		'main-menu' => esc_html__('Main Menu', 'lr'),
		'footer-menu-1' => esc_html__('Footer Menu 1', 'lr'),
		'footer-menu-2' => esc_html__('Footer Menu 2', 'lr'),
		'bottom-footer-menu' => esc_html__('Botton Footer Menu', 'lr')
	));

	add_image_size("services_tabs", 406, 242, true);
	add_image_size("post_img", 280, 345, true);
	add_image_size("gallery_img", 843, 478, true);
	add_image_size("team_img", 232, 232, true);
	add_image_size("links_img", 624, 320, true);
}


add_filter( 'pre_get_document_title', function( $title ){
    return is_404() ? 'Seite nicht gefunden' : $title;
}, 999, 1 );


add_action('wp_enqueue_scripts', 'custom_scripts');
function custom_scripts()
{
	wp_enqueue_style('custom_style', get_stylesheet_uri());

	//wp_enqueue_style( 'swiper-style', get_template_directory_uri().'/css/swiper-bundle.min.css', false, '1.0', 'all' );
	//wp_enqueue_style( 'likes', get_template_directory_uri().'/css/simple-likes-public.css', false, '1.0', 'all' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '1.0', true);
	wp_enqueue_script('custom-select', get_template_directory_uri() . '/js/custom-select.js', array(), '1.0', true);
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/scripts.js', array(), '1.0', true);
}

function acf_option_init()
{
	if (function_exists('acf_add_options_sub_page')) {

		$parent = acf_add_options_page(array(
			'page_title' => __('Theme Settings'),
			'menu_title' => __('Theme Settings'),
			'menu_slug' => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false,
		));
	}
}
add_action('acf/init', 'acf_option_init');


function lr_schema_type()
{
	$schema = 'https://schema.org/';
	if (is_single()) {
		$type = "Article";
	} elseif (is_author()) {
		$type = 'ProfilePage';
	} elseif (is_search()) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}
	echo 'itemscope itemtype="' . esc_url($schema) . esc_attr($type) . '"';
}

add_action('wp_footer', 'lr_footer');
function lr_footer()
{
?>
	<script>
		jQuery(document).ready(function($) {
			var deviceAgent = navigator.userAgent.toLowerCase();
			if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
				$("html").addClass("ios");
				$("html").addClass("mobile");
			}
			if (deviceAgent.match(/(Android)/)) {
				$("html").addClass("android");
				$("html").addClass("mobile");
			}
			if (navigator.userAgent.search("MSIE") >= 0) {
				$("html").addClass("ie");
			} else if (navigator.userAgent.search("Chrome") >= 0) {
				$("html").addClass("chrome");
			} else if (navigator.userAgent.search("Firefox") >= 0) {
				$("html").addClass("firefox");
			} else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				$("html").addClass("safari");
			} else if (navigator.userAgent.search("Opera") >= 0) {
				$("html").addClass("opera");
			}
		});
	</script>
<?php
}
add_filter('the_content_more_link', 'lr_read_more_link');
function lr_read_more_link()
{
	if (!is_admin()) {
		return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'lr'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
	}
}

add_filter('excerpt_more', 'lr_excerpt_read_more_link');
function lr_excerpt_read_more_link($more)
{
	if (!is_admin()) {
		global $post;
		return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'lr'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
	}
}

add_action('wp_head', 'lr_pingback_header');
function lr_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
	}
}
function acf_init_block_types()
{
	acf_register_block_type(array(
		'name' => 'block-background_image',
		'title' => __('Block Background Image'),
		'description' => __('Block Background Image'),
		'render_template' => 'acf_blocks/block-background_image.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('background image'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-background_image.png',
				),
			),
		),
	));
	acf_register_block_type(array(
		'name' => 'block-text_image',
		'title' => __('Block Text Image'),
		'description' => __('Block Text Image'),
		'render_template' => 'acf_blocks/block-text_image.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('text image'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-text_image.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-services_tabs',
		'title' => __('Block Services Tabs'),
		'description' => __('Block Services Tabs'),
		'render_template' => 'acf_blocks/block-services_tabs.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('services tabs'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-services_tabs.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-columns_with_numbers',
		'title' => __('Block Columns With Nubmers'),
		'description' => __('Block Columns With Nubmers'),
		'render_template' => 'acf_blocks/block-columns_with_numbers.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('columns numbers'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-columns_with_numbers.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-posts_slider',
		'title' => __('Block Posts Slider'),
		'description' => __('Block Posts Slider'),
		'render_template' => 'acf_blocks/block-posts_slider.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('posts slider'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-posts_slider.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-banner',
		'title' => __('Block Banner'),
		'description' => __('Block Banner'),
		'render_template' => 'acf_blocks/block-banner.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('background image banner'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-banner.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-services',
		'title' => __('Block Services'),
		'description' => __('Block Services'),
		'render_template' => 'acf_blocks/block-services.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block service'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-services.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-two_columns',
		'title' => __('Block Two Columns'),
		'description' => __('Block Two Columns'),
		'render_template' => 'acf_blocks/block-two_columns.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block columns'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-two_columns.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-gallery',
		'title' => __('Block Gallery'),
		'description' => __('Block Gallery'),
		'render_template' => 'acf_blocks/block-gallery.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block gallery'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-gallery.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-background_shortcode',
		'title' => __('Block Background Shortcode'),
		'description' => __('Block Background Shortcode'),
		'render_template' => 'acf_blocks/block-background_shortcode.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block background shortcode'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-background_shortcode.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-faq',
		'title' => __('Block FAQ'),
		'description' => __('Block FAQ'),
		'render_template' => 'acf_blocks/block-faq.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block faq'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-faq.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-team',
		'title' => __('Block Team'),
		'description' => __('Block Team'),
		'render_template' => 'acf_blocks/block-team.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block team'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-team.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-image_links',
		'title' => __('Block Image Links'),
		'description' => __('Block Image Links'),
		'render_template' => 'acf_blocks/block-image_links.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block image links'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-image_links.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'flexible-block',
		'title' => __('Flexible Block'),
		'description' => __('Flexible Block'),
		'render_template' => 'acf_blocks/flexible-block.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('flexible'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/flexible-block.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-running_block',
		'title' => __('Block Running Block'),
		'description' => __('Block Running Block'),
		'render_template' => 'acf_blocks/block-running_block.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block running block'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-running_block.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-vacancies',
		'title' => __('Block Vacancies'),
		'description' => __('Block Vacancies'),
		'render_template' => 'acf_blocks/block-vacancies.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block vacancies'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-vacancies.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-contact_image',
		'title' => __('Block Form Image'),
		'description' => __('Block Form Image'),
		'render_template' => 'acf_blocks/block-contact_image.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('text form image'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-contact_image.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-share',
		'title' => __('Block Share'),
		'description' => __('Block Share'),
		'render_template' => 'acf_blocks/block-share.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('text share'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-share.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-two_columns_list',
		'title' => __('Block Two Columns List'),
		'description' => __('Block Two Columns List'),
		'render_template' => 'acf_blocks/block-two_columns_lists.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block columns list'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-two_columns_list.png',
				),
			),
		)
	));
	acf_register_block_type(array(
		'name' => 'block-image_accordion',
		'title' => __('Block Image Accordion'),
		'description' => __('Block Image Accordion'),
		'render_template' => 'acf_blocks/block-image_accordion.php',
		'mode' => 'edit',
		'icon' => 'format-gallery',
		'keywords' => array('block image accordion'),
		'supports' => array('anchor' => true),
		'post_types' => array('post', 'page', 'service', 'vacancy', 'glossary'),
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'gutenberg_preview_image' => get_template_directory_uri() . '/acf_blocks/previews/block-image_accordion.png',
				),
			),
		)
	));
}
add_action('acf/init', 'acf_init_block_types');


/* Editor width */
function gb_gutenberg_admin_styles()
{
	echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: none;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: none;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }	
        </style>
    ';
}
add_action('admin_head', 'gb_gutenberg_admin_styles');

add_filter('navigation_markup_template',  'lr_posts_pagination', 10, 2);
function lr_posts_pagination($template, $class)
{
	global $wp_query;

	$total   = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
	$current = get_query_var('paged') ? (int) get_query_var('paged') : 1;
	$first = $last = '';

	if ($current == 1)
		$first = '<span class="prev inactive"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M10.0596 13.28L5.7129 8.9333C5.19957 8.41997 5.19957 7.57997 5.7129 7.06664L10.0596 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
		</svg></span>';

	if ($current == $total)
		$last = '<span class="next inactive"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5.94043 13.28L10.2871 8.9333C10.8004 8.41997 10.8004 7.57997 10.2871 7.06664L5.94043 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
		</svg></span>';

	$template = '
    <nav class="navigation %1$s" role="navigation" aria-label="%4$s">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">
        ' . $first . '
        %3$s
        ' . $last . '
        </div>
    </nav>';
	return $template;
}
function change_nav()
{
	$page = $_POST['paged'];
	$category = $_POST['cat'];
	echo load_posts($page, $category);
	wp_die();
}
add_action('wp_ajax_change_nav', 'change_nav');
add_action('wp_ajax_nopriv_change_nav', 'change_nav');

function change_search_nav()
{
	$page = $_POST['paged'];
	$s = $_POST['s'];
	echo load_search($page, $s);
	wp_die();
}
add_action('wp_ajax_change_search_nav', 'change_search_nav');
add_action('wp_ajax_nopriv_change_search_nav', 'change_search_nav');

function load_nav()
{
	$category = $_POST['cat'];
	echo load_navigation($category);
	wp_die();
}
add_action('wp_ajax_load_nav', 'load_nav');
add_action('wp_ajax_nopriv_load_nav', 'load_nav');

function load_search_nav()
{
	$s = $_POST['s'];
	echo load_search_navigation($s);
	wp_die();
}
add_action('wp_ajax_load_search_nav', 'load_search_nav');
add_action('wp_ajax_nopriv_load_search_nav', 'load_search_nav');
function load_posts($page, $category)
{
	$posts = get_posts([
		'numberposts' => get_option('posts_per_page'),
		'category'    => $category,
		'offset' => ($page - 1) * get_option('posts_per_page'),
		'orderby'     => 'date',
		'order'       => 'DESC',
		'post_type'   => 'post',
	]);
	$str = '';
	if ($posts) {
		foreach ($posts as $p) {
			setup_postdata($p);
			$str .= '<article id="post-' . $p->ID . '" class="post"><a class="post_lnk" href="' . esc_url(get_the_permalink($p)) . '">';
			if (has_post_thumbnail($p->ID)) :
				$str .= '<div class="img_wrapper">' . get_the_post_thumbnail($p, 'full', array('itemprop' => 'image')) . '</div>';
			endif;
			$str .= '<div class="content_wrapper"><div class="post_meta">';
			$cats = wp_get_post_categories($p->ID);
			if ($cats) :
				$isfirst = true;
				$str .= '<span class="category">';
				foreach ($cats as $cat) {
					if (!$isfirst)
						$str .= ', ';
					$str .= get_the_category_by_ID($cat);
					$isfirst = false;
				}
				$str .= '</span>';
			endif;
			$str .= '<span class="date">' . get_post_time(get_option('date_format'), false, $p) . '</span></div>';
			$str .= '<h4>' . get_the_title($p) . '</h4>';
			$str .= '<div class="text_wrap">' . get_the_excerpt($p) . '</div>';
			$str .= '<div class="more_wrap"><span class="more_btn">' . __('Mehr lesen', 'lr') . '</span></div>';
			$str .= '</div></a></article>';
		}
	}
	return $str;
}
function load_navigation($category)
{
	$str = '';
	$posts = get_posts([
		'numberposts' => -1,
		'category'    => $category,
		'post_type'   => 'post',
	]);
	$pages_count = ceil(count($posts) / get_option('posts_per_page'));
	if ($pages_count > 1) {
		$str .= '<nav class="navigation pagination" role="navigation" aria-label="Posts"><div class="nav-links">';
		$str .= '<a class="prev page-numbers" href="#"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M10.0596 13.28L5.7129 8.9333C5.19957 8.41997 5.19957 7.57997 5.7129 7.06664L10.0596 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg></a>';
		for ($i = 1; $i <= $pages_count; $i++) {
			if ($i == 1)
				$str .= '<a class="page-numbers current page-number-' . $i . '" data-page="' . $i . '" href="#">' . $i . '</a>';
			else
				$str .= '<a class="page-numbers page-number-' . $i . '" data-page="' . $i . '" href="#">' . $i . '</a>';
		}
		$str .= '<a class="next page-numbers" href="#"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5.94043 13.28L10.2871 8.9333C10.8004 8.41997 10.8004 7.57997 10.2871 7.06664L5.94043 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg></a>';
		$str .= '</div></nav>';
	}

	return $str;
}
function load_search($page, $s)
{
	$posts = get_posts([
		'numberposts' => get_option('posts_per_page'),
		'offset' => ($page - 1) * get_option('posts_per_page'),
		'orderby'     => 'date',
		'order'       => 'DESC',
		'post_type'   => 'any',
		's' => $s
	]);
	$str = '';
	if (count($posts) <= 0) {
		return 0;
	}
	if ($posts) {
		foreach ($posts as $p) {
			setup_postdata($p);
			$str .= '<article><a href="' . esc_url(get_the_permalink($p)) . '" class="search_lnk"><div class="content_wrapper">';
			$str .= '<h4>' . get_the_title($p) . '</h4>';
			$str .= '<div class="text_wrap">' . get_the_excerpt($p) . '</div>';
			$str .= '<div class="more_wrap"><span href="" class="more_btn">' . __('Mehr lesen', 'lr') . '</span></div>';
			$str .= '</div></a></article>';
		}
	}
	return $str;
}
function load_search_navigation($s)
{
	$str = '';
	$posts = get_posts([
		'numberposts' => -1,
		'post_type'   => 'any',
		's' => $s
	]);
	$pages_count = ceil(count($posts) / get_option('posts_per_page'));
	$str .= '<nav class="navigation pagination" role="navigation" aria-label="Posts" data-count="' . count($posts) . '">';
	if ($pages_count > 1) {
		$str .= '<div class="nav-links">';
		$str .= '<a class="prev page-numbers" href="#"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M10.0596 13.28L5.7129 8.9333C5.19957 8.41997 5.19957 7.57997 5.7129 7.06664L10.0596 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg></a>';
		for ($i = 1; $i <= $pages_count; $i++) {
			if ($i == 1)
				$str .= '<a class="page-numbers current page-number-' . $i . '" data-page="' . $i . '" href="#">' . $i . '</a>';
			else
				$str .= '<a class="page-numbers page-number-' . $i . '" data-page="' . $i . '" href="#">' . $i . '</a>';
		}
		$str .= '<a class="next page-numbers" href="#"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5.94043 13.28L10.2871 8.9333C10.8004 8.41997 10.8004 7.57997 10.2871 7.06664L5.94043 2.71997" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg></a>';
		$str .= '</div>';
	}
	$str .= '</nav>';
	return $str;
}
