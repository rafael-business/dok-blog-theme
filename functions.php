<?php
/**
 * DOK Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DOK_Blog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dok_blog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DOK Blog, use a find and replace
		* to change 'dok-blog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'dok-blog', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 362, 376, true );
	add_image_size( 'mais-lidos-thumb', 841, 381, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'dok-blog' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'dok_blog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 36,
			'width'       => 91,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'dok_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dok_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dok_blog_content_width', 1147 );
}
add_action( 'after_setup_theme', 'dok_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dok_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dok-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dok-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dok_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dok_blog_scripts() {
	wp_enqueue_style( 'dok-blog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'dok-blog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'dok-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'dok-blog-hero', get_template_directory_uri() . '/js/hero.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dok_blog_scripts' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


function dok_blog_get_categories( $post_id ){

	$taxonomy = 'category';
	$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
	$separator = ', ';
	
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
	
		$term_ids = implode( ',' , $post_terms );
	
		$terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
	
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		return  $terms;
	}
}

function dok_blog_pagination(){

	?>
	<div class="paging">
		<ul>
		<?php
		global $wp_query;
		$big = 999999999;
		$args = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?page=%#%',
			'total' => $wp_query->max_num_pages,
			'current' => max( 1, get_query_var( 'paged') ),
			'show_all' => false,
			'end_size' => 3,
			'mid_size' => 2,
			'prev_next' => True,
			'prev_text' => __('Previous'),
			'next_text' => __('Next'),
			'type' => 'list',
			);
		echo paginate_links($args);
		?>
		</ul>
	</div>
	<?php
}
