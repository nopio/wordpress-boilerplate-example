<?php
/**
 * Nopio Master Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Nopio_Master_Theme
 * @since 1.0
 */

/**
 * Nopio Master Theme only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
        require get_template_directory() . '/inc/back-compat.php';
}

include_once dirname( __FILE__ ) . '/inc/admin/options.php';

if ( ! function_exists( 'nopiomaster_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own nopiomaster_setup() function to override in a child theme.
 *
 * @since 1.0
 */
function nopiomaster_setup() {

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
         * Enable support for custom logo.
         *
         *  @since Nopio Master Theme 1.2
         */
        add_theme_support( 'custom-logo', array(
                'height'      => 240,
                'width'       => 240,
                'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 9999 );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
                'primary' => __( 'Primary Menu', 'nopiomaster' ),
                'social'  => __( 'Social Links Menu', 'nopiomaster' ),
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

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'status',
                'audio',
                'chat',
        ) );

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // nopiomaster_setup
add_action( 'after_setup_theme', 'nopiomaster_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since 1.0
 */
function nopiomaster_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'nopiomaster_content_width', 840 );
}
add_action( 'after_setup_theme', 'nopiomaster_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since 1.0
 */
function nopiomaster_widgets_init() {
        register_sidebar( array(
                'name'          => __( 'Sidebar', 'nopiomaster' ),
                'id'            => 'sidebar-1',
                'description'   => __( 'Add widgets here to appear in your sidebar.', 'nopiomaster' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
                'name'          => __( 'Content Bottom 1', 'nopiomaster' ),
                'id'            => 'sidebar-2',
                'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'nopiomaster' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
                'name'          => __( 'Content Bottom 2', 'nopiomaster' ),
                'id'            => 'sidebar-3',
                'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'nopiomaster' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
        ) );
}
add_action( 'widgets_init', 'nopiomaster_widgets_init' );

if ( ! function_exists( 'nopiomaster_fonts_url' ) ) :
/**
 * Register Google fonts for Nopio Master Theme.
 *
 * Create your own nopiomaster_fonts_url() function to override in a child theme.
 *
 * @since 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function nopiomaster_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'nopiomaster' ) ) {
                $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'nopiomaster' ) ) {
                $fonts[] = 'Montserrat:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'nopiomaster' ) ) {
                $fonts[] = 'Inconsolata:400';
        }

        if ( $fonts ) {
                $fonts_url = add_query_arg( array(
                        'family' => urlencode( implode( '|', $fonts ) ),
                        'subset' => urlencode( $subsets ),
                ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0
 */
function nopiomaster_javascript_detection() {
        echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'nopiomaster_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since 1.0
 */
function nopiomaster_scripts() {
        // Add custom fonts, used in the main stylesheet.
        wp_enqueue_style( 'pattenstudio-fonts', nopiomaster_fonts_url(), array(), null );

        // Theme stylesheet.
        wp_enqueue_style( 'pattenstudio-style', get_template_directory_uri() . '/css/style.css' );

        wp_enqueue_script( 'pattenstudio-script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), '20160821', true );

}
add_action( 'wp_enqueue_scripts', 'nopiomaster_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function nopiomaster_body_classes( $classes ) {
        // Adds a class of custom-background-image to sites with a custom background image.
        if ( get_background_image() ) {
                $classes[] = 'custom-background-image';
        }

        // Adds a class of group-blog to sites with more than 1 published author.
        if ( is_multi_author() ) {
                $classes[] = 'group-blog';
        }

        // Adds a class of no-sidebar to sites without active sidebar.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
                $classes[] = 'no-sidebar';
        }

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
                $classes[] = 'hfeed';
        }

        return $classes;
}
add_filter( 'body_class', 'nopiomaster_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function nopiomaster_hex2rgb( $color ) {
        $color = trim( $color, '#' );

        if ( strlen( $color ) === 3 ) {
                $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
                $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
                $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
        } else if ( strlen( $color ) === 6 ) {
                $r = hexdec( substr( $color, 0, 2 ) );
                $g = hexdec( substr( $color, 2, 2 ) );
                $b = hexdec( substr( $color, 4, 2 ) );
        } else {
                return array();
        }

        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function nopiomaster_content_image_sizes_attr( $sizes, $size ) {
        $width = $size[0];

        840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

        if ( 'page' === get_post_type() ) {
                840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
        } else {
                840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
                600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
        }

        return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'nopiomaster_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function nopiomaster_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
        if ( 'post-thumbnail' === $size ) {
                is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
                ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
        }
        return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'nopiomaster_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Nopio Master Theme 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function nopiomaster_widget_tag_cloud_args( $args ) {
        $args['largest'] = 1;
        $args['smallest'] = 1;
        $args['unit'] = 'em';
        return $args;
}
add_filter( 'widget_tag_cloud_args', 'nopiomaster_widget_tag_cloud_args' );
