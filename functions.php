<?php
/**
 * Designhelsinki functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package designhelsinki
 */


if ( ! function_exists( 'designhelsinki_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function designhelsinki_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on designhelsinki, use a find and replace
		 * to change 'designhelsinki' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designhelsinki', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'designhelsinki' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'designhelsinki_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'designhelsinki_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designhelsinki_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'designhelsinki_content_width', 640 );
}
add_action( 'after_setup_theme', 'designhelsinki_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designhelsinki_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'designhelsinki' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'designhelsinki' ),
		'before_widget' => '<section id="%1$s" class="menu %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<p class="menu-label">',
		'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'designhelsinki_widgets_init' );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function designhel_setup() {
	  // Add support for editor styles.
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-spacing');

	add_image_size( 'hero-image size', 1440, 400 );

	// Enqueue editor styles.
	add_editor_style( get_stylesheet_directory_uri() . '/dist/editor.min.css' );
}
add_action( 'after_setup_theme', 'designhel_setup' );


/**
 * Enqueue scripts and styles.
 */
function designhelsinki_scripts() {

	$scriptVersion = filemtime( get_stylesheet_directory() . '/dist/theme.min.js' );
	$styleVersion = filemtime( get_stylesheet_directory() . '/dist/main.min.css' );

	wp_enqueue_style( 'helsinkidesign-style', get_template_directory_uri() . '/dist/main.min.css', $styleVersion );
	wp_enqueue_script( 'helsinkidesign-scipts', get_template_directory_uri() . '/dist/theme.min.js', array('jquery'), $scriptVersion, true );

	wp_enqueue_style( 'owl-styles', get_stylesheet_directory_uri() . '/src/owlcarousel/owl.carousel.min.css', '2.3.4');
	wp_enqueue_style( 'owl-styles-default', get_stylesheet_directory_uri() . '/src/owlcarousel/owl.theme.default.min.css', array(''), '2.3.4', true );
	wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/src/owlcarousel/owl.carousel.min.js', array('jquery'), '2.3.4');
	wp_enqueue_script( 'designhelsinki-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'designhelsinki_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Load designhelsinki functions */
require get_template_directory() .'/functions/designhelsinki-nav-walker.php';


function comment_form_designhelsinki_fields ($fields) {
	$fields["author"] = '<div class="comment-form-author field"><label for="author" class="label">' . __( 'Name', 'domainreference' ) .
	( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
	'<input id="author" name="author" type="text" class="input" value="' . esc_attr( $commenter['comment_author'] ) .
	'" size="30"' . $aria_req . ' /></div>';

	$fields["email"] = '<div class="comment-form-email field"><label for="email" class="label">' . __( 'Email', 'domainreference' ) .
	( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
	'<input id="email" name="email" type="text" class="input" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	'" size="30"' . $aria_req . ' /></div>';

	$fields["url"] = '<div class="comment-form-url field"><label for="url" class="label">' . __( 'Website', 'domainreference' ) . '</label>' .
	'<input id="url" name="url" type="text" class="input" value="' . esc_attr( $commenter['comment_author_url'] ) .
	'" size="30" /></div>';
	return $fields;
}
add_filter('comment_form_default_fields','comment_form_designhelsinki_fields');


add_filter( 'get_custom_logo', 'designhelsinki_custom_logo' );
function designhelsinki_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html = sprintf( '<a href="%1$s" class="navbar-item" rel="home" itemprop="url">%2$s</a>',
		esc_url( '/' ),
		wp_get_attachment_image( $custom_logo_id, 'full', false, array(
			'class'    => 'custom-logo',
		) )
	);
	return $html;   
} 


function block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'custom-blocks',
				'title' => 'Custom Blocks',
			),
		)
	);
}
add_filter( 'block_categories', 'block_category', 10, 2);



add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
	if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
		acf_register_block_type(array(
			'name'              => 'hero',
			'title'             => __('Hero'),
			'description'       => __('Frontpage Hero block.'),
			'render_template'   => 'template-parts/blocks/hero.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'image-cta',
			'title'             => __('Image CTA'),
			'description'       => __('Image CTA with overlay text content.'),
			'render_template'   => 'template-parts/blocks/image-cta.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'category-news',
			'title'             => __('Category News'),
			'description'       => __('Select category to show 3 latest news on front page'),
			'render_template'   => 'template-parts/blocks/category-news.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'select-news',
			'title'             => __('Select News'),
			'description'       => __('Select posts manaually'),
			'render_template'   => 'template-parts/blocks/select-news.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'helsinki-news',
			'title'             => __('Helsinki API News'),
			'description'       => __('Imported Helsinki news from API'),
			'render_template'   => 'template-parts/blocks/helsinki-news.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'editor-card',
			'title'             => __('Editor Card'),
			'description'       => __('Card element in content editor'),
			'render_template'   => 'template-parts/blocks/editor-card.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'wide',
			'icon'              => 'admin-comments',
		));

		acf_register_block_type(array(
			'name'              => 'editor-slider',
			'title'             => __('Editor Slider'),
			'description'       => __('Slider with thumbnails'),
			'render_template'   => 'template-parts/blocks/editor-slider.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));


		acf_register_block_type(array(
			'name'              => 'contacts',
			'title'             => __('Contacts Block'),
			'description'       => __('Repeater for adding contacts'),
			'render_template'   => 'template-parts/blocks/contacts.php',
			'category'          => 'custom-blocks',
			'mode' 							=> 'edit',
			'align' 						=> 'full',
			'icon'              => 'admin-comments',
		));


		register_block_style(
			"core/quote",
			array(
				'name'         => 'wide-quote',
				'label'        => 'Wide Quote',
				'style_handle' => 'widequote-style',
			)
		);
	}
}

// Add custom options page for example to edit footer links
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Teeman asetukset',
		'menu_title'	=> 'Teeman asetukset',
		'menu_slug' 	=> 'teeman-asetukset',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


// Register Custom Post Type
function events_post_type() {

	$labels = array(
		'name'                  => _x( 'Tapahtumat', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Tapahtuma', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Tapahtumat', 'text_domain' ),
		'name_admin_bar'        => __( 'Tapahtumat', 'text_domain' ),
		'add_new'               => __( 'Lisää uusi', 'text_domain' ),
		'new_item'              => __( 'Uusi tapahtuma', 'text_domain' ),
		'edit_item'             => __( 'Muokkaa tapahtumaa', 'text_domain' ),
		'update_item'           => __( 'Päivitä tapahtumaa', 'text_domain' ),
		'view_item'             => __( 'Katso tapahtuma', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Tapahtuma', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'tapahtumat', $args );

}
add_action( 'init', 'events_post_type', 0 );

/**
 * Display Post Blocks 
 *
 */
// function display_post_blocks() {
// 	global $post;
// 	print_r( esc_html( $post->post_content ) );
// }
// add_action( 'wp_footer', 'display_post_blocks' );




// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4 );

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
	echo '<style type="text/css">
	.attachment-266x266, .thumbnail img {
		width: 100% !important;
		height: auto !important;
	}
	</style>';
}
add_action( 'admin_head', 'fix_svg' );

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}

	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return $excerpt;
}


function designhelsinki_translates() {

   // register our translatable strings 

	if ( function_exists( 'pll_register_string' ) ) {

		pll_register_string( 'Ajankohtaista', 'Ajankohtaista', 'designhelsinki', false );
		pll_register_string( 'Tapahtumat', 'Tapahtumat', 'designhelsinki', false );
		pll_register_string( 'Lue lisää', 'Lue lisää', 'designhelsinki', false );
		pll_register_string( 'Lataa lisää', 'Lataa lisää', 'designhelsinki', false );
		pll_register_string( 'Kaikki uutiset', 'Kaikki uutiset', 'designhelsinki', false );
		pll_register_string( 'Yhteystiedot', 'Yhteystiedot', 'designhelsinki', false );
		pll_register_string( 'Hae yhteystietoja', 'Hae yhteystietoja', 'designhelsinki', false );
		pll_register_string( 'Siirry sisältöön', 'Siirry sisältöön', 'designhelsinki', false );
		pll_register_string( 'Hae', 'Hae', 'designhelsinki', false );
		pll_register_string( 'Hakutulokset', 'Hakutulokset', 'designhelsinki', false );
		pll_register_string( 'Haku', 'Haku', 'designhelsinki', false );
		pll_register_string( 'Asiasanat', 'Asiasanat', 'designhelsinki', false );
		pll_register_string( 'Sinua voisi kiinnostaa', 'Sinua voisi kiinnostaa', 'designhelsinki', false );
		pll_register_string( 'Helsingin kaupunki', 'Helsingin kaupunki', 'designhelsinki', false );

	}
}
add_action( 'after_setup_theme', 'designhelsinki_translates' );


/*
*
* Walker for the main menu 
*
*/
add_filter( 'walker_nav_menu_start_el', 'add_arrow',10,4);
function add_arrow( $output, $item, $depth, $args ){

//Only add class to 'top level' items on the 'primary' menu.
	if('primary' == $args->theme_location && $depth === 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<button class="menu-toggle" aria-expanded="false" aria-label="Avaa alavalikko" tabindex="0"><div class="inner-button hds-icon hds-icon--size-m hds-icon--angle-down closed"></div></button>';
		}
	}
	return $output;
}


function designhelsinki_multilang_logo( $value ) {
	if ( function_exists( 'pll_current_language' ) ) {
		$logos = array(
			'fi' => get_stylesheet_directory_uri() . '/images/helsinki-fi.svg',
			'en' => get_stylesheet_directory_uri() . '/images/helsinki-fi.svg',
			'se' => get_stylesheet_directory_uri() . '/images/helsinki-fi.svg',
		);
		$default_logo = $logos['fi'];
		$current_lang = pll_current_language();
		if ( isset( $logos[ $current_lang ] ) )
			$value = $logos[ $current_lang ];
		else
			$value = $default_logo;
	}
	$html = sprintf( '<a href="%1$s" title="Etusivulle" class="navbar-item" rel="home" itemprop="url"><img alt="Helsinki Design Logo" class="custom-logo" src="'.$value.'" /></a>',
		esc_url( home_url( '/' ) ),
		$value
	);
	return $html;
}
add_filter( 'get_custom_logo', 'designhelsinki_multilang_logo' );


add_filter( 'pre_get_posts', 'designhelsinki_exclude_pages_search' );
function designhelsinki_exclude_pages_search($query) {
	if ( $query->is_search )
		$query->set( 'post__not_in', array( 133, 1237, 1239, ) ); 

	return $query;
}


function stripAccents($str) {
	return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}


function theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'theme_archive_title' );


function add_ajax_script() {
	wp_localize_script( 'helsinkidesign-scipts', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'add_ajax_script' );


function loadmore_ajax_handler() {
	$post_category_name = $_POST['catName'];
	$excluded_posts = $_POST['uutisetItemsVisible'];
	$amount = $_POST['amount'];
	$args['post_status'] = 'publish';
	$args['offset'] = intval($excluded_posts);
	$args['category_name'] = $post_category_name;

	$args['showposts'] = intval($amount);

	$posts = query_posts( $args );
	global $wp_query;
	$postCount = $wp_query->post_count;
	$posts_per_page = get_option( 'posts_per_page' );
	$maxPages = $wp_query->max_num_pages;
	if($postCount < 1) :

	else:

		if( have_posts() ) :
			while( have_posts() ): the_post();
				get_template_part( 'template-parts/blocks/category-news', 'content' ); 
			endwhile;
		endif;
	endif;
	die;
}


add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

