<?php
/**
 * Theme functions and definitions
 *
 * @package Hellomadxartwork
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_madxartwork_VERSION', '2.4.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_madxartwork_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_madxartwork_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated( 'madxartwork_hello_theme_load_textdomain', [ true ], '2.0', 'hello_madxartwork_load_textdomain' );
		if ( apply_filters( 'hello_madxartwork_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-madxartwork', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'madxartwork_hello_theme_register_menus', [ true ], '2.0', 'hello_madxartwork_register_menus' );
		if ( apply_filters( 'hello_madxartwork_register_menus', $hook_result ) ) {
			register_nav_menus( [ 'menu-1' => __( 'Header', 'hello-madxartwork' ) ] );
			register_nav_menus( [ 'menu-2' => __( 'Footer', 'hello-madxartwork' ) ] );
		}

		$hook_result = apply_filters_deprecated( 'madxartwork_hello_theme_add_theme_support', [ true ], '2.0', 'hello_madxartwork_add_theme_support' );
		if ( apply_filters( 'hello_madxartwork_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'madxartwork_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_madxartwork_add_woocommerce_support' );
			if ( apply_filters( 'hello_madxartwork_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_madxartwork_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_madxartwork_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_madxartwork_VERSION );
	}
}

if ( ! function_exists( 'hello_madxartwork_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_madxartwork_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'madxartwork_hello_theme_enqueue_style', [ true ], '2.0', 'hello_madxartwork_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_madxartwork_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-madxartwork',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_madxartwork_VERSION
			);
		}

		if ( apply_filters( 'hello_madxartwork_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-madxartwork-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_madxartwork_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_madxartwork_scripts_styles' );

if ( ! function_exists( 'hello_madxartwork_register_madxartwork_locations' ) ) {
	/**
	 * Register madxartwork Locations.
	 *
	 * @param madxartworkPro\Modules\ThemeBuilder\Classes\Locations_Manager $madxartwork_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_madxartwork_register_madxartwork_locations( $madxartwork_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'madxartwork_hello_theme_register_madxartwork_locations', [ true ], '2.0', 'hello_madxartwork_register_madxartwork_locations' );
		if ( apply_filters( 'hello_madxartwork_register_madxartwork_locations', $hook_result ) ) {
			$madxartwork_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'madxartwork/theme/register_locations', 'hello_madxartwork_register_madxartwork_locations' );

if ( ! function_exists( 'hello_madxartwork_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_madxartwork_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_madxartwork_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_madxartwork_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If madxartwork is installed and active, we can load the madxartwork-specific Settings & Features
*/

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/madxartwork-functions.php';

/**
 * Include customizer registration functions
*/
function hello_register_customizer_functions() {
	if ( hello_header_footer_experiment_active() && is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_register_customizer_functions' );

if ( ! function_exists( 'hello_madxartwork_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_madxartwork_check_hide_title( $val ) {
		if ( defined( 'madxartwork_VERSION' ) ) {
			$current_doc = madxartwork\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_madxartwork_page_title', 'hello_madxartwork_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_madxartwork_body_open' ) ) {
	function hello_madxartwork_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}



require_once get_template_directory() . '/wp-bootstrap-navwalker.php';
function checkbootnav($theme_location,$depth,$container,$container_class,$container_id, $menu_class, $fallback_cb){
$bootnav = wp_nav_menu( array(
    'theme_location'    => $theme_location,
    'depth'             => $depth,
    'container'         => $container,
    'container_class'   => $container_class,
    'container_id'      => $container_id,
    'menu_class'        => $menu_class,
    'fallback_cb'       => $fallback_cb,
    'walker'            => new WP_Bootstrap_Navwalker(),
	'echo' => false,
) );
return  $bootnav;
}
function bootnav( $atts, $content = null ) {
return checkbootnav($atts['theme_location'],$atts['depth'],$atts['container'],$atts['container_class'],$atts['container_id'], $atts['menu_class'], $atts['fallback_cb']); 
}
//[bootnav theme_location=menu-1 depth=2 container=div container_class="collapse navbar-collapse" container_id="bs-example-navbar-collapse-1" menu_class="nav navbar-nav" fallback_cb='WP_Bootstrap_Navwalker::fallback'][/bootnav]
add_shortcode( 'bootnav', 'bootnav' );

